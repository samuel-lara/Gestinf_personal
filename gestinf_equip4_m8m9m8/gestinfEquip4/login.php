<?php
include_once 'configdb.php';
session_start(); //creem un inici de sessió que ha de anar com a primer pas del codi php

if (isset($_POST["correu-entra"]) && isset($_POST["pass-entra"])) { //comprova si les dades entren en post i mitjançant els inputs de index.html

  
  //Comprovar si les dades estan a la BBDD

  //creem dos variables amb el metode de petició post que estarà enllaçat amb 
  //l'etiqueta input de tipus mail i una altra etiqueta input de tipus password
  //del nostre arxiu index.html, així que les dades que s'introdueixin s'emmagatzemaran
  //en les variables $correuEntra i $passEntra
  $correuEntra = $_POST["correu-entra"];
  $passEntra = $_POST["pass-entra"];
  $_SESSION['correu_sessio'] = $correuEntra; //es guarda a la variable global $_SESSION el correu de l'usuari, entre els claudators fiquem el nom de la variable

  
  


  $sql = "SELECT Correu_usuari, Contrasenya_usuari, Tipus_usuari FROM Usuaris WHERE Correu_usuari='$correuEntra' AND Contrasenya_usuari='$passEntra'";
          //SELECT d'exemple, ajustar-lo als parametres de la nostra base de dades.
          //com a exemple tenim una variable tipus
          //
  
  //$conn = mysqli_connect($db_host, $user, $pass, $db); //mysql_connect és una funció php, en aquest cas li estem demanant els parametres entre parantesis
  //per fer-ho amb hard code podem possar-ho entre cometes ex: $db_host = "mariadb"




  $result = mysqli_query($conn, $sql); //la funcio query executa la consulta i ens tornara el resultat d'aquesta. Amb query podem fer, selects, inserts,i tal.
  //entre parentesis seguit del query introduim la consulta, en aquesta ocasió hi ha una variable que contindra la consulta

  
  //echo $contrasenyaEncriptada;
  


  if ($result -> num_rows > 0){ //si resultat torna més de 0 línies entrará al if, si no va al else
      //echo $result;

      $row = $result -> fetch_assoc(); //guardem a la variable $row un array de la variable $result
      $correu_db = $row['Correu_usuari'];
      $contra_db = $row["Contrasenya_usuari"];
      //utilitzem la funció password_hash i li passarem dos parametres, la variable de la contrasenya sense encriptar i PASSWORD_DEFAULT que la seva funció serà la de generar la contrasenya encriptada
      $contrasenyaEncriptada = password_hash($passEntra, PASSWORD_BCRYPT); //utilitzem la funció password_hash per a encriptar la contrasenya
      //echo $contrasenyaEncriptada;
      
      //print_r($row);

      
      


      
      //if($nom . password_verify($contrasenya, $contra_db) == $nom_db . password_verify($contra_db, $contrasenya)){
      if(password_verify($passEntra, $contrasenyaEncriptada) && ($correuEntra == $correu_db)){ //desencripta la contrasenya 
        if($row["Tipus_usuari"]=="Alumne"){ //si el tipus es Alumne ens dirigira a el dashboard alumnes




        //EN AQUEST PUNT GUARDA LES DADES D'INICI DE SESSIÓ A LA TAULA LOGS



        header("Location: alumnesUnificatPHP/dashboardAlumnes.php");
        die(); //el die acaba amb l'execució del codi

      } else {
        header("Location: professorsUnificatPHP/dash.Professors.php"); //si el tipus es Professor ens dirigira a el dashboard Professors
        die();

      }
      
      } else {
        //redirecció a l'index perque no s'han ficat els camps necessaris
        header("Location: index.html");
        die();
      }


      //$print_r($result);

  } else {
    //redirecció a l'index perque no s'han ficat els camps necessaris
    header("Location: index.html");
    die();
  }

  $conn -> close(); //tanquem la connexió a la base de dades per a evitar problemes de seguretat, en aquest punt la consulta o query ja está assignada com a valor a la variable $result que és amb la que treballarem

} else{
  //redirecció a l'index perque no s'han ficat els camps necessaris
  header("Location: index.html");
  die();
}
?>