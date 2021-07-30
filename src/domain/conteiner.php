<?php

	class Conteiner {
		var $id;
		var $id_cliente;
		var $conteiner;
		var $tipo;
		var $status;
		var $categoria;

		function getId(){
			return $this->id;
		}
		function setId($id){
			$this->id = $id;
		}

		function getId_cliente(){
			return $this->id_cliente;
		}
		function setId_cliente($id_cliente){
			$this->id_cliente = $id_cliente;
		}

		function getConteiner(){
			return $this->conteiner;
		}
		function setConteiner($conteiner){
			$this->conteiner = $conteiner;
		}

		function getTipo(){
			return $this->tipo;
		}
		function setTipo($tipo){
			$this->tipo = $tipo;
		}

		function getStatus(){
			return $this->status;
		}
		function setStatus($status){
			$this->status = $status;
		}

		function getCategoria(){
			return $this->categoria;
		}
		function setCategoria($categoria){
			$this->categoria = $categoria;
		}
	}

	class ConteinerDAO {
		function create($conteiner) {
			$result = array();

			$cliente = $conteiner->getId_cliente();
			$cont = $conteiner->getConteiner();
			$tipo = $conteiner->getTipo();
			$status = $conteiner->getStatus();
			$categoria = $conteiner->getCategoria();

			try {
				$query = "INSERT INTO conteiner VALUES (DEFAULT, $cliente, '$cont', $tipo, '$status', '$categoria')";

				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$id = Connection::getInstance()->lastInsertId();
					$conteiner->setId($id);
					$result[] = $conteiner;
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function read() {
			$result = array();

			try {
				$query = "SELECT * FROM conteiner";

				$con = new Connection();

				$resultSet = Connection::getInstance()->query($query);

				while($row = $resultSet->fetchObject()){
					$result[] = $row;
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function update($conteiner) {
			$result = array();

			$id = $conteiner->getId();
			$cliente = $conteiner->getId_cliente();
			$cont = $conteiner->getConteiner();
			$tipo = $conteiner->getTipo();
			$status = $conteiner->getStatus();
			$categoria = $conteiner->getCategoria();

			try {
				$query = "UPDATE conteiner SET cliente = $cliente, conteiner = '$cont', tipo = $tipo, status = '$status', categoria = '$categoria' WHERE id = $id";

				$con = new Connection();

				$status = Connection::getInstance()->prepare($query);

				if($status->execute()){
					$result[] = $conteiner;
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function delete($id) {
			$result = array();

			try {
				$query = "DELETE FROM conteiner WHERE id = $id";

				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$return[] = $id;
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}
	}
