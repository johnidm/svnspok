<?php 

require_once 'core/Build.php';
require_once 'source/Users.php';

$twig = Build::initTwig(); 
$users = new Users('config/users');
$template = $twig->loadTemplate('users.twig');

if (isset($_POST['insert']))	{
	$user = $_POST['user'];
	$password = $_POST['password'];
	$login = $_POST['login'] == 'true' ? true : false;

	// está editando o registro	
	if (isset($_POST['user-edit'] )) { 
		$users->removeUser($_POST['user-edit']);
	}

	$users->addUser($user, $password, $login);	
	echo $template->render( array( 'users' => $users->listUsers() ) );

} else if (isset($_POST['edit']))	{

	$user = $users->findDataUser( $_POST['user'] );

	echo $template->render( array( 
			'edit' => true,
			'user' => $user['name'],
			'password' => $user['password'],
			'login' => $user['login'] ) );	
	
} else if (isset($_POST['delete']))	{
	$user = $_POST['user'];

	$users->removeUser($user);
	echo $template->render( array( 'users' => $users->listUsers() ) );

} else {
	echo $template->render( array( 'users' => $users->listUsers() ) );
}

?>