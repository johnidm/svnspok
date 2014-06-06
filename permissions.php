<?php 

require_once 'core/Build.php';
require_once 'source/Permissions.php';

$twig = Build::initTwig(); 

$template = $twig->loadTemplate('permissions.twig');

$permissions = new Permissions('config/projects');

echo $template->render( array( 'permissions' => $permissions->listPermissions() ) );

?>