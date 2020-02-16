<?php 

require_once("config.php");

//$sql = new sql();
//$usuarios = $sql->select("SELECT * FROM tb_usuarios");

//echo json_encode($usuarios);

//Carrega um usuario
//$lailson = new Usuario();
//$lailson->loadbyId(7);
//echo $lailson;

//Carrega uma lista de usuarios

//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuarios pelo login

//$search = Usuario::search("la");
//echo json_encode($search);

//carrega um usuario  usando o login e a senha
$usuario = new Usuario();
$usuario->login("45lailson","0123456");

echo $usuario;

 ?>