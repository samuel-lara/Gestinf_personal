<?php

$db_host="mariadb"; //contenedor, nom de la maquina o IP
//$port="3306";
$db="gestinf"; //nom base de dades
$user="root"; //root //usuari
$pass="rootpwd";//"clauusuari" //contrasenya


$conn = mysqli_connect($db_host, $user, $pass, $db); //mysql_connect és una funció php, en aquest cas li estem demanant els parametres entre parantesis per a fer la connexio a la base de dades

?>