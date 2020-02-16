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
 
 			$this->setData($results[0]);

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
 
 			$this->setData($results[0]);

 			

 			// caso o usuario nao seja autenticado temos um else responsavel por mostrar ao usuario

		}else {
			throw new Exception("Login ou Senha incorreto");
			
		}


	}

	public function setData($data) {

		$this->setIdusuario($data['idusuario']);
 		$this->setDeslogin($data['deslogin']);
 		$this->setDessenha($data['dessenha']);
 		$this->setEmail($data['email']);
 		$this->setDtcadastro(new DateTime($data['dtcadastro']));


	}

	// metodo insert para inserir um novo usuario

	public function insert() {

		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD, :EMAIL)",array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha(),
			':EMAIL'=>$this->getEmail()
		));

			if (count($results) > 0) {
				$this->setData($results[0]);

			}

	}

	// metodo que atualiza dados da tabela

	public function update ($login, $password , $email) {

		$this->setDeslogin($login);
		$this->setDessenha($password);
		$this->setEmail($email);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN , dessenha = :PASSWORD , email = :EMAIL WHERE idusuario = :ID", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha(),
			':EMAIL'=>$this->getEmail(),
			':ID'=>$this->getIdusuario()


		));
	}

	public function __construct($login = "", $password = "" , $email = "") {

		$this->setDeslogin($login);
		$this->setDessenha($password);
		$this->setEmail($email);
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