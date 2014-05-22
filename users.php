<?php 

require_once 'core/Build.php';
require_once 'source/Users.php';

$twig = Build::initTwig(); 
$users = new Users('config/users');

$operation = '';
if (isset($_POST['operation']))	
	$operation = $_POST['operation'];

switch ($operation) {
	case 'insert':
			
			if (isset($_POST['user']))	
				$user = $_POST['user'];

			if (isset($_POST['password']))
				$password = $_POST['password'];

			if (isset($_POST['login']))
				$login = $_POST['login'] == 'true';
			else
				$login = false;

			if ( (!empty($user)) and (!empty($password)) ) {		
				$users->addUser($user, $password, $login);
			}		

		break;
	
	case 'delete':
			if (isset($_POST['user']))	
				$user = $_POST['user'];

			if (!empty($user)) {		
				$users->removeUser($user);
			}	
		
		break;
}

$template = $twig->loadTemplate('users.twig');
echo $template->render( array( 'users' => $users->listUsers() ) );

?>