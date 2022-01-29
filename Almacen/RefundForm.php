<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Formulario de entrada</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
          rel="stylesheet" type="text/css"/>
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet"/>
</head>
<body id="page-top">
<nav class="navbar navbar-dark bg-dark">
    <!-- Navbar content -->
    <div class="container px-4 px-lg-5" >
        <a class="navbar-brand" href="../index.html">Inventario</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link" href="../EntryForm.php">Entrada</a></li>
                <li class="nav-item"><a class="nav-link" href="../Out.php">Salida</a></li>
                <li class="nav-item"><a class="nav-link" href="../MermageForm.php">Merma</a></li>
                <li class="nav-item"><a class="nav-link" href="../RefundForm.php">Devolución</a></li>
                <li class="nav-item"><a class="nav-link" href="../dataWarehouse.php">Inventario.</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="row" >
    <div  style="padding-right: 500px; padding-left: 500px; padding-top: 200px; padding-bottom: 450px">
        <form action="EntryForm.php" method="post">
            <div class="form-group">
                <h4>Devolución</h4>
                <label for="eanCode">EAN/Codigo de Barras</label>
                <input type="text" class="form-control" name="eanCode" id="eanCode"
                       placeholder="Codigo de barras">
            </div>
            <div style="padding-left: 820px">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['eanCode'])){
    $ean = $_POST['eanCode'];


    $mysqli = new mysqli("localhost", "root", "", "warehousemuni");
    if (mysqli_connect_errno()) {
        printf("Falló la conexión failed: %s\n", $mysqli->connect_error);
        exit();
    }
    $count = "SELECT * FROM stockdetail WHERE ean = '$ean'";
    $countRes = $mysqli->query($count);
    $rowCount = $countRes->fetch_array(MYSQLI_ASSOC);
    $stockCount = $rowCount["stockCount"]+1;

    $query = "SELECT * FROM product WHERE ean = '$ean'";
    $result = $mysqli->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $idSupplier = $row["idSupplier"];
    $suppName = $row["suppName"];
    $prodName = $row["prodName"];
    $date = date("y-m-d");
    $sql="INSERT INTO prodstate(idProdState, ean, prodName, idSupplier, suppName, state, date) VALUES('', '$ean','$prodName','$idSupplier','$suppName','O','$date')";
    $sqlCount = "UPDATE stockdetail SET  stockCount=$stockCount WHERE ean = $ean";
    $resultCount = $mysqli->query($sqlCount);
    $result = $mysqli->query($sql);
    $mysqli -> close();
}
?>
<footer class="bg-light py-5">
    <div class="container px-4 px-lg-5">
        <div class="small text-center text-muted">Powered By BRZyro</div>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- SimpleLightbox plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>


