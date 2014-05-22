<?php 


class Configuration {


	public function isFileUsersConfigured()
	{
		return true;
	}

	public function isFilePermissionsConfigured()
	{
		return true;
	}

	public function isFilesConfigured()
	{
		return $this->isFileUsersConfigured() and $this->isFilePermissionsConfigured();
	}

}	
		

?>	