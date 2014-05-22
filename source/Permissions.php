<?php 

/*http://fabien.potencier.org/article/34/templating-engines-in-php*/

class Permissions
{
	
	function __construct($file) {}


	public function listPermissions()
	{

		$vet = array ( array('projet' => 'project one', 'users' => array( 'name' => 'johni' ) ), array ('projet' => 'project two', 'users' => array(  'name' => 'marangon'  )));
			

		return $vet; 
	}
	


}



?>