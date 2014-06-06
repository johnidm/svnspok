<?php 

/*http://fabien.potencier.org/article/34/templating-engines-in-php*/

class Permissions
{
	
	private $projects = array();
	private $file;

	function __construct($file) {
		$this->file = $file;

		$this->readProjectInFile();
	}

	private function isProject($project) {
 
			// Identifica o padrao projeto:/			
			$pattern = '/^[-_a-z0-9A-Z]+:\/$/';	
			
			if (preg_match($pattern, ($project)))  {						
				return true;
			}
			return false;
		}

	private function nameProject($project) {
 
			// Retorna o que vem antes do padrao ":/"
			$pattern = '/:\//';
			$word = preg_split( $pattern, $project); 	
 
			if (!empty($word[0])) {
				return $word[0];		
			} 
			return "";
		}	

	private function isWrite($permission) {

		if (stripos($permission, 'w') === false) {
			return false;
		} 		
		return true;
	}

	private function isRead($permission) {
		if(stripos($permission, 'r')  === false ) {
			return false;
		} 		
		return true;
	}

	private function getUsersInProject($users) {
		$array = array();

		foreach ( $users as $user => $permissions ) :			

			array_push($array, array('name' => $user, 
				'read'  => $this->isRead($permissions), 
				'write' => $this->isWrite($permissions)));
		
		endforeach;
		
		return $array;
	}

	private function readProjectInFile() {

		$projects = parse_ini_file( $this->file , true );
 
		foreach ($projects as $project => $users):
			
			if ( $this->isProject($project) ) {
				$name =  $this->nameProject($project);	

				// colocar mais informações do projeto
				/*
				if (!empty($name)) { 
					throw new Exception('Nome do projeto está em branco');
				}
				*/

				$array = array('projet' => $name, 
					'users' => $this->getUsersInProject($users) ) ;
				

				array_push($this->projects, $array );


			} else {
				// projeto não está obedecendo a sequinte márcara 
				// [projeto:/]
			}			
 
		endforeach;	
	}

	public function listPermissions()
	{
		return $this->projects; 
	}

}



?>