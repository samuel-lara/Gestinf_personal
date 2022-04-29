<?php
//A aquest arxiu de logout podrem tancar la sessió de l'alume o del professor, aquest arxiu estrà enllaçat amb el botó de tancar sessió dels documents mitjançant l'atribut href a l'etiqueta

// Iniciem la sessió
session_start();

//Destruïm la sessió
session_destroy();

//EN AQUEST PUNT GUARDA LES DADES DE TANCAR LA SESSIÓ A LA TAULA LOGS


header("Location: index.html"); //ens dirigirà a index.html un cop hem destruit la sessió
die();
?>