<?php

require_once '/../source/Users.php';

class UsersTest extends PHPUnit_Framework_TestCase 
{

	private $file_users = 'usuarios.txt';
	private $users;

	protected function setUp() {}

	protected function tearDown()
	{		
		unlink($this->file_users);	
	}

	public function testCountUsers() 
	{					
		$str = 	'johni:123456' .  PHP_EOL .
				'marangon:321654' .  PHP_EOL;	
	
		file_put_contents($this->file_users, $str);

		$users = new Users($this->file_users);
		$this->assertEquals($users->count(), 2 );	
		$this->assertEquals($users->countUsersLogin(), 0 );	

	}


	public function testFindUser() 
	{				
		
		$str = 	'johni:123456' .  PHP_EOL .
				'marangon:321654' .  PHP_EOL;	

		file_put_contents($this->file_users, $str);

		$users = new Users($this->file_users);

		$this->assertEquals($users->userExists('johni'), true);
		$this->assertEquals($users->userExists('douglas'), false);
		$this->assertEquals($users->userExists('marangon'), true);
	}	



	public function testListUsers()
	{		
		$str = 	'johni:123456' .  PHP_EOL .
				'marangon:321654' .  PHP_EOL;		
		file_put_contents($this->file_users, $str);
		
		file_put_contents('../config/userslogin', 'johni');

		$users = new Users($this->file_users);

		$arr = array(
			0 => array('name' => 'johni', 'password' => '123456', 'login' => true),
			1 => array('name' => 'marangon', 'password' => '321654', 'login' => false) );

		$this->assertEquals($users->listUsers(), $arr );
		$this->assertEquals($users->countUsersLogin(), 1 );	

		unlink('../config/userslogin');
	}
}

