<?php 

session_start(); //creem un inici de sessió que ha de anar com a primer pas del codi php

if(isset($_SESSION['correu_sessio'])){ //compara que la variable está definida
    echo '<script>alert("Benvingut professor '.$_SESSION['correu_sessio'].'")</script>'; //mostra una alerta per pantalla amb el correu de l'usuari que ha iniciat sessió abans de entrar al dashboard
  //per a entrar al dashboard alumnes que es aquesta mateix document no cal ficar cap header amb location
} else {
  header("Location: ../index.html"); //si el resultat de la condició del if es fals llavors ens dirigirà a index.html
  die();
}

?>






<!doctype html>
<html lang="en">
  <head>

    <!--Include de la part del head, les metadades modular-->
    <?php include "../headerFooterHTML/head.html" ?>

    <title>Dashboard Professors</title>
  </head>

  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">

  <!--Include de la part del header modular-->
  <?php include "../headerFooterHTML/header.html" ?>
</header>

<div class="container-fluid">
  <div class="row">

  <!--Include de la part del menú lateral dels professors modular-->
  <?php include "../headerFooterHTML/menuProfessors.html" ?>

      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard Professors</h1>
      </div>





      <!--CODI HTML I PHP PER A MOSTRAR LES TAULES, ZONA DEL MAIN-->


          <?php 
            include_once '../configdb.php'; //cridem a l'arxiu configdb per a fer la connexió a la base de dades

            $sqlMostrar = "SELECT Correu_usuari, Contrasenya_usuari, GrupClasse_usuari FROM Usuaris WHERE Tipus_usuari = 'Alumne'"; //fem la consulta de les dades que volem extraure i la guardem a la variable
            $resultadoMostrar = mysqli_query($conn, $sqlMostrar); //utilitzem la funció mysqli_query per a fer la connexio i la consulta anterior a la base de dades i guardem el resultat a la variable $resultadoMostrar

            $conn -> close(); //tanquem la connexio per a evitar problemes de seguretat ja que tenim el resultat guardat a la variable anterior

            if($resultadoMostrar->num_rows > 0){ //estructura de control que valida si han resultats o no depenent de les files que mostri
                echo "<div class=\"table-responsive\"><table class=\"table table-striped table-sm\"><thead><tr><th scope=\"col\">Correu Electronic</th><th scope=\"col\">Contrasenya</th><th scope=\"col\">Grup Classe</th></tr></thead>";
              while($mostrar=mysqli_fetch_array($resultadoMostrar)){ //ja que tenim varies files de resultats creem un bucle a on la condició será que cree un array a on guardi cada fila
                echo "<tbody><tr><td>".$mostrar['Correu_usuari']."</td><td>".$mostrar['Contrasenya_usuari']."</td><td>".$mostrar['GrupClasse_usuari']."</td></tr></tbody>"; //aqui mostra cada final per pantalla
              }
              echo "</table>"; //etiqueta que tanca la taula
            } else{
              echo "<h2>SENSE RESULTATS</h2>"; //missatge que mostrarà per pantalla si no hi troba cap resultat
            }
          ?>
      </div>




    </main>
  </div>
</div>

<!--Include de la part dels scripts de JS modular-->
<?php include "../headerFooterHTML/scriptsJSDashboard.html" ?>  
  </body>
</html>
