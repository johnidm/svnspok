<?php

require_once '/../vendor/twig/twig/lib/Twig/Autoloader.php';

class Build
{		
	public static function initTwig()
	{

		Twig_Autoloader::register();

		$loader = new Twig_Loader_Filesystem('view');

		$twig = new Twig_Environment($loader);

		return $twig;
	}

} 

?>