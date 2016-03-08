<?php

//Ukljucivanje start.php fajla iz app foldera sa svim postavkama za pokretanje aplikacije

require_once '../app/start.php';

//Pokretanje Slim2 aplikacije

$app->run();

?>