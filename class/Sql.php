<?php 

class Sql extends PDO {

	private $conn;

	//conexao usando metodo construtor para conectar automaticamente

	public function __construct(){

		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");

	}

	private function setParams($statment , $parameters = array()) {

		// pecorre os resultados via interacao

		foreach ($parameters as $key => $value) {
			
			$this->setParam($statment ,$key, $value);
		}
	}

	private function setParam($statment, $key, $value) {

		$statment->bindParam($key, $value);
	}

	//executa um comando no banco usando o metodo abaixo, rawquery e uma query bruta

	public function query($rawQuery, $params = array()) {

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;


	}

	public function select($rawQuery, $params = array()) :array {

		$stmt = $this->query($rawQuery , $params);

		//PDO::FETCH_ASSOC retorna um array indexado pelo nome da coluna

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


}

 ?>