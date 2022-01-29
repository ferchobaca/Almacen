
<?php
        $mysqli = new mysqli("localhost","root","","warehousemuni");
        $salida = "";
        $query = "SELECT * FROM stockdetail ORDER BY stockCount asc";
        if(isset($_POST['consulta'])){
                $q = $mysqli ->real_escape_string($_POST['consulta']);
                $query = "SELECT ean, stockDate, prodName, suppName, stockCount FROM stockdetail WHERE ean = $q OR prodName LIKE '%".$q."%'";
        }
        $result = $mysqli->query($query);

        if($result -> num_rows > 0){
            $salida.="<table class='table table-dark table-striped'>
                        <thead>
                            <tr>
                                <td>EAN</td>
                                <td>Ultima fecha de stock</td>
                                <td>Nombre del producto</td>
                                <td>Cantidad</td>
                            </tr>
                        </thead>
                        <tbody>";
            while ($fila = $result->fetch_assoc()){
                $salida.="<tr>
                             <td>".$fila['ean']."</td>
                             <td>".$fila['stockDate']."</td>
                             <td>".$fila['prodName']."</td>
                             <td>".$fila['stockCount']."</td>
                          </tr>";
            }
            $salida.="</tbody></table>";
        }else{
            $salida.="No hay datos";
        }
            echo $salida;
            $mysqli->close();

    ?>
