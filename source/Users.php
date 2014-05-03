<?php 
	
//namespace Source;

class Users 
{
	const FILE_USERS_LOGIN =  '../config/userslogin';
	
	const TWO_POINTS = ':';

	private $users = array();
	private $loginUsers = array();

	function __construct($file) 
	{
		$this->readUsersInFile($file);

	}

	private function readUsersInFile($file)
	{	
		if (file_exists(self::FILE_USERS_LOGIN)) {
			$this->loginUsers = explode(PHP_EOL, file_get_contents(self::FILE_USERS_LOGIN) );		
		};		

		if (file_exists($file)) 
		{
			$users = explode(PHP_EOL, file_get_contents($file) );					

			foreach($users as $index=>$user): 

				if (!empty($user)) {
					$line = explode(self::TWO_POINTS, $user);
					
		  			$arr = array('name' => $line[0], 'password' => $line[1], 'login' => in_array($line[0], $this->loginUsers)) ;
		  			
		  			array_push( $this->users, $arr );
		  		};
			endforeach;				
			
		}
	}

	public function count()
	{
		return count($this->users);
	}

	public function countUsersLogin() {
		return count($this->loginUsers);
	}

	public function userExists($name) 
	{
		
		$array = array_filter($this->users, 
			function($arr) use ($name) {
				return $arr['name'] == $name;						
			} );

 		return count($array) != 0;
	}

	public function listUsers()
	{
		return $this->users;
	}

}
