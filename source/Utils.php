<?php 

	function post_data_in_file($file, $data) 
	{	
		file_put_contents($file, $data, FILE_APPEND);
	}


		

?>	