<?php

require_once 'core/Autoload.php';
require_once 'core/Build.php';

$twig = Build::initTwig(); 

//echo $twig->render('index.html', array('nome' => 'Douglas'));

echo $twig->render('instalacao.html', array('nome' => 'Douglas'));

?>