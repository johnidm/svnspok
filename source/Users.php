<?php 
	
//namespace Source;

require_once 'Utils.php';

define ('FILE_USERS_LOGIN', __DIR__ . '\..\config\userslogin');

class Users 
{	

	private $users = array();
	private $loginUsers = array(); /* usuarios que tem permissao de login na area administrativa */
	private $file;

	function __construct($file) 
	{
		$this->file = $file;
		$this->readUsersInFile($this->file);

	}


	private function postUser($user, $passwod, $login)
	{
		$arr = array('name' => $user, 'password' => $passwod, 'login' => $login ) ;
		  			
		array_push( $this->users, $arr );
	}

	private function persistUsersInFile()
	{

		if (file_exists($this->file))
			unlink($this->file);

		if (file_exists(FILE_USERS_LOGIN))
			unlink(FILE_USERS_LOGIN);

 		foreach($this->users as $user): 
		
			$data = $user['name'] . ':' . $user['password'] . PHP_EOL;
			post_data_in_file($this->file, $data);

			if ( $user['login'] ) 
			{
				post_data_in_file(FILE_USERS_LOGIN, $user['name']);	
			}

		endforeach;		
	}

	private function readUsersInFile($file)
	{	

		$this->users = array();
		$this->loginUsers = array();


		if (file_exists(FILE_USERS_LOGIN)) {
			$this->loginUsers = explode(PHP_EOL, file_get_contents( FILE_USERS_LOGIN) );		
		};		

		if (file_exists($file)) 
		{
			$users = explode(PHP_EOL, file_get_contents($file) );					

			foreach($users as $index=>$user): 

				if (!empty($user)) {

					$line = explode( ':' , $user);					  		

		  			$this->postUser($line[0], $line[1], in_array($line[0], $this->loginUsers));

		  		};

			endforeach;				
			
		}
	}

	public function countUsers()
	{
		return count($this->users);
	}

	public function countUsersLogin() {
		return count($this->loginUsers);
	}

	public function existUsers() {
		return $this->countUsers() != 0;
	}

	private function filterUser($name)
	{
		$array = array_filter($this->users, 
			function($arr) use ($name) {
				return $arr['name'] == $name;						
			} );

 		return $array;		
	}

	public function existUser($name) 
	{
		return count($this->filterUser($name)) != 0;
	}

	public function listUsers()
	{				
		return $this->users;
	}

	public function addUser($user, $password, $login) 
	{				
		$this->postUser($user, $password, $login);

		$this->persistUsersInFile();
	}

	public function removeUser($user)
	{
		
		$array = $this->filterUser($user);
				
		foreach ($array as $i => $value):   		    		
    		unset($this->users[$i]);    		
		endforeach;


		$this->persistUsersInFile();
	}


}
