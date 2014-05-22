<?php 

class PermissionsTests
{
	
	private $file_permissions = 'permissoes.txt';

	public function testReadProject() {
		
		$data = 
			'[projeto:]'.  PHP_EOL .
			'user01=rw' .  PHP_EOL .
			'user02=r'  .  PHP_EOL .
			'user03=w'  .  PHP_EOL .
			'user04=wr' .  PHP_EOL .
			'user05='   .  PHP_EOL .
			'user06=aw' .  PHP_EOL .
			'user05=wr' .  PHP_EOL .
			'user06=ar' .  PHP_EOL .
			'user05=ra' .  PHP_EOL .
			'user06=zz' .  PHP_EOL;
		
		file_put_contents($this->file_permissions, data);

		$permissions = new Permissions($this->file_permissions);

		$this->assertEquals(0, 1);
	}
	
}

?>