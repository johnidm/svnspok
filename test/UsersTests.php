<?php

require_once '/../source/Users.php';

class UsersTest extends PHPUnit_Framework_TestCase 
{


	private $file_users = 'usuarios.txt';
	private $users;

	protected function setUp() {}

	protected function tearDown()
	{		
		if (file_exists($this->file_users))	
		{
			unlink($this->file_users);
		}
		
	}

	public function testCountUsers() 
	{					
		$str = 	'johni:123456' .  "\n" .
				'marangon:321654' . "\n";	
	
		file_put_contents($this->file_users, $str);

		$users = new Users($this->file_users);
		$this->assertEquals($users->countUsers(), 2 );	
		$this->assertEquals($users->countUsersLogin(), 0 );	

	}


	public function testExistUser() 
	{				
		
		$str = 	'johni:123456' .  "\n" .
				'marangon:321654' .  "\n";	

		file_put_contents($this->file_users, $str);

		$users = new Users($this->file_users);

		$this->assertEquals($users->existUser('johni'), true);
		$this->assertEquals($users->existUser('douglas'), false);
		$this->assertEquals($users->existUser('marangon'), true);

	}	



	public function testListUsers()
	{		
		$str = 	'johni:123456' . "\n" .
				'marangon:321654' . "\n";		
		file_put_contents($this->file_users, $str);
		
		file_put_contents( FILE_USERS_LOGIN, 'johni');

		$users = new Users($this->file_users);

		$arr = array(
			0 => array('name' => 'johni', 'password' => '123456', 'login' => true),
			1 => array('name' => 'marangon', 'password' => '321654', 'login' => false) );

		$this->assertEquals($users->listUsers(), $arr );
		$this->assertEquals($users->countUsersLogin(), 1 );	

		unlink( FILE_USERS_LOGIN);
		
	}


	public function testAddUser() 
	{

		if (file_exists($this->file_users))	{
			unlink($this->file_users);
		}

		$users = new Users($this->file_users);
		
		$users->addUser('johni', '123456', true);
		$users->addUser('marangon', '321654', false);

		$arr = array(
			0 => array('name' => 'johni', 'password' => '123456', 'login' => true),
			1 => array('name' => 'marangon', 'password' => '321654', 'login' => false) );

		$this->assertEquals($users->listUsers(), $arr );

		unlink( FILE_USERS_LOGIN);

	}

	public function testAddHimSelfUser() 
	{

		if (file_exists($this->file_users))	{
			unlink($this->file_users);
		}

		$users = new Users($this->file_users);
		
		$users->addUser('johni', '123456', true);
		$users->addUser('johni', '9999', true);
		$users->addUser('marangon', '321654', false);
		

		$arr = array(			
			1 => array('name' => 'johni', 'password' => '9999', 'login' => true), 
			2 => array('name' => 'marangon', 'password' => '321654', 'login' => false) );

		$this->assertEquals($users->listUsers(), $arr );

		unlink( FILE_USERS_LOGIN);

	}


	public function testRemoveUser()
	{

		$str = 	'johni:123456' .  "\n" .
				'marangon:321654' .  "\n";	

		file_put_contents($this->file_users, $str);

		$users = new Users($this->file_users);

		$users->addUser('douglas', '321654', false);
		$users->removeUser('douglas');

		$this->assertEquals($users->existUser('johni'), true);
		$this->assertEquals($users->existUser('marangon'), true);
		$this->assertEquals($users->existUser('douglas'), false);
	}

	public function testFindDataUser()
	{

		$str = 	'johni:123456' .  "\n";	

		file_put_contents($this->file_users, $str);

		$users = new Users($this->file_users);

		$users->addUser('douglas', '321654', false);
		
		$find = $users->findDataUser('johni');

		$this->assertEquals($find['name'], 'johni');
		$this->assertEquals($find['password'], 123456);
		$this->assertEquals($find['login'], false);
	}


	public function findDataUser($username) {
		$array = $this->filterUser($username);

		foreach($array as $user): 		
			return $this->mountArray($user['name'], $user['password'], $user['login']);		
		endforeach;

	}
}

