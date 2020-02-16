<?php 

 // metodo que verifica o nome da classe

spl_autoload_register(function($class_name) {

	 // diretorio onde a classe se localiza e o nome do mesmo

	$filename = "class" . DIRECTORY_SEPARATOR . $class_name. ".php";


	// o if verifica se o arquivo existe e se sim faz um require do mesmo

	if (file_exists(($filename))) {
		require_once($filename);
	}


});


 ?>