<?php 

class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $email;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setIdusuario($idusuario){
		$this->idusuario = $idusuario;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($deslogin){
		$this->deslogin = $deslogin;
	}

	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($dessenha){
		$this->dessenha = $dessenha;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setDtcadastro($dtcadastro){
		$this->dtcadastro = $dtcadastro;
	}

	public function loadById($id) {

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios where idusuario = :ID", array(
			":ID"=>$id

		));

		if (count($results) > 0 ) {
 
 			$row = $results[0];

 			$this->setIdusuario($row['idusuario']);
 			$this->setDeslogin($row['deslogin']);
 			$this->setDessenha($row['dessenha']);
 			$this->setEmail($row['email']);
 			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}


	}

	 // faz uma listagem de uma lista de usuarios

	public static function getList(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	// busca uma lista de usuarios pelo login 

	public static function search($login) {

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
		));
	}

	// metodo que autentica os dados dos usuarios 

	public function login($login, $password) {

			$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios where deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password

		));

		if (count($results) > 0 ) {
 
 			$row = $results[0];

 			$this->setIdusuario($row['idusuario']);
 			$this->setDeslogin($row['deslogin']);
 			$this->setDessenha($row['dessenha']);
 			$this->setEmail($row['email']);
 			$this->setDtcadastro(new DateTime($row['dtcadastro']));

 			// caso o usuario nao seja autenticado temos um else responsavel por mostrar ao usuario

		}else {
			throw new Exception("Login ou Senha incorreto");
			
		}


	}

	public function __toString() {

		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"email"=>$this->getEmail(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
	));

	}

}



 ?>