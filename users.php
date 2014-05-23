<?php 

require_once 'core/Build.php';
require_once 'source/Users.php';

$twig = Build::initTwig(); 
$users = new Users('config/users');


if (isset($_POST['insert']))	{
	//$users->addUser("johni", "123", true);
	echo "Gravar";
} else if (isset($_POST['edit']))	{
	echo "Edicao";
} else if (isset($_POST['delete']))	{
	echo "Excluir";
	//$users->removeUser($user);
}

		

$template = $twig->loadTemplate('users.twig');
echo $template->render( array( 'users' => $users->listUsers() ) );

?>