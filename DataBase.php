<?php

namespace MySQL;

use \PDO;

/*
* Class DataBase
* Permet de se connecter et d'exécuter des requettes SQL dans une base de données MySQL en utilisant le PDO 
*/
class DataBase {
	
	/*
	* @var string Nom de la base de données
	*/
	private $db_name;

	/*
	* @var string Nom d'utilisateur pour se connecter à la base de données
	*/
	private $db_user;

	/*
	* @var string Mot de passe pour se connecter à la base de données
	*/
	private $db_pass;

	/*
	* @var string L'hôte de connexion à la base de données
	*/
	private $db_host;

	/*
	* @var int Port de connexion à la base de données
	*/
	private $db_port;

	/*
	* @var PDO Stockage du PDO, connexion base de données
	*/
	private $pdo;

	/*
	* @param string $db_name Nom de la base de données
	* @param string $db_user Nom d'utilisateur pour se connecter à la base de données
	* @param string $db_pass Mot de passe pour se connecter à la base de données
	* @param string $db_host L'hôte de connexion à la base de données
	*/
	function __construct($db_name, $db_port = 3306, $db_user = 'root', $db_pass = 'root', $db_host = 'localhost'){
		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_host = $db_host;
		$this->db_port = $db_port;	
	}

	/*
	* @return PDO
	*/
	private function getPDO(){
		if ($this->pdo === null) {
			try {
				$pdo = new PDO('mysql:dbname='.$this->db_name.';host='.$this->db_host.':'.$this->db_port, $this->db_user, $this->db_pass);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (Exception $e) {

				die('Une erreur est survenue lors de la connexion à la base de données.');
			}
			$this->pdo = $pdo;
		}
		return $this->pdo;
	}

	/*
	* @param string $statement La requette SQL à exécuter
	* @param array $values Si la requette comporte des valeurs en '?' (ou autre), ce sont ces valeurs qui sont entrées dans ce tableau, dans l'ordre des '?' (ou autre) de la requette SQL.
	* @param boolean $returns Retourne oui ou non des choses
	* @return array
	*/
	public function prepare($statement, $values = array(), $returns = false){
		$req = $this->getPDO()->prepare($statement);
		$req->execute($values);

		if ($returns === true) {
			$data = $req->fetchAll();
			$rowCount = $req->rowCount();
			$fetch = $req->fetch();

		
			$newdata['fetchAll'] = $data;
			$newdata['rowCount'] = $rowCount;
			$newdata['fetch'] = $fetch;

			return $newdata;
		} else {
			return true;
		}
	}
}