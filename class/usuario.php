<?php 

class Usuario {

	private $usuarioid;
	private $deslogin;
	private $dessenhas;
	private $dtcadastro;

	public function getUsuarioid(){

		return $this->usuarioid;

	}

	public function getDeslogin(){

		return $this->deslogin;

	}

	public function getDessenhas(){

		return $this->dessenhas;

	}

	public function getDtcadastro(){

		return $this->dtcadastro;

	}

	public function setUsuarioid($usuarioid){

		$this->usuarioid = $usuarioid;

	}

	public function setDeslogin($deslogin){

		$this->deslogin = $deslogin;

	}

	public function setDessenhas($dessenhas){

		$this->dessenhas = $dessenhas;

	}

	public function setDtcadastro($dtcadastro){

		$this->dtcadastro = $dtcadastro;
	}

	public function loadByID($id) {

		$sql = new sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE usuarioID = :ID", array(
			":ID"=>$id

		));

		if (count($results[0]) > 0) {

			$row = $results[0];

			$this->setUsuarioID($row['usuarioID']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenhas($row['dessenhas']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
	}

	public function __toString(){

		return json_encode(array(
			"usuarioid"=>$this->getUsuarioid(),
			"deslogin"=>$this->getDeslogin(),
			"dessenhas"=>$this->getDessenhas(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y  H:i:s")

		));	
	}
}

 ?>