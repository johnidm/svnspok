<?php

require_once 'core/Build.php';
require_once 'source/Configuration.php';

$twig = Build::initTwig(); 

/*
$configuration = new Configuration();

if (!($configuration->isFilesConfigured() ))  {
	echo $twig->render('instalation.twig', 
		array( 	"FilePermissions" => $configuration->isFilePermissionsConfigured , 
				"FileUsers" => $configuration->isFileUsersConfigured ) );
} else {

	$user = new Users();

	if (!($user->existUsers())) and  {

	}
}
*/

echo $twig->render('index.twig', array());
	


?>