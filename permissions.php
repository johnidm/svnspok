<?php 

require_once 'core/Build.php';
require_once 'source/Permissions.php';

$twig = Build::initTwig(); 

$template = $twig->loadTemplate('permissions.twig');

$permissions = new Permissions('');

echo $template->render( array( 'permissions' => $permissions->listPermissions() ) );

?>