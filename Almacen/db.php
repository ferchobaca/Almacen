<?php
function con(){
    $hostname = "localhost";
    $usuariodb = "root";
    $password = "";
    $dbname = "warehousemuni";
    $conectar = mysqli_connect($hostname,$usuariodb,$password,$dbname);
    return $conectar;
}