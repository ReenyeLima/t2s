<?php

	class Movimentacoes {
		var $id;
		var $id_conteiner;
		var $tipo;
		var $inicio;
		var $fim;

		function getId(){
			return $this->id;
		}
		function setId($id){
			$this->id = $id;
		}

		function getId_conteiner(){
			return $this->id_conteiner;
		}
		function setId_conteiner($id_conteiner){
			$this->id_conteiner = $id_conteiner;
		}

		function getTipo(){
			return $this->tipo;
		}
		function setTipo($tipo){
			$this->tipo = $tipo;
		}

		function getInicio(){
			return $this->inicio;
		}
		function setInicio($inicio){
			$this->inicio = $inicio;
		}

		function getFim(){
			return $this->fim;
		}
		function setFim($fim){
			$this->fim = $fim;
		}
	}

	class MovimentacoesDAO {
		function create($movimentacoes) {
			$result = array();

			$id = $movimentacoes->getId_conteiner();
			$tipo = $movimentacoes->getTipo();

			try {
				$query = "INSERT INTO movimentacoes VALUES (DEFAULT, $id, '$tipo', DEFAULT, DEFAULT)";

				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$id = Connection::getInstance()->lastInsertId();
					$movimentacoes->setId($id);
					$result[] = $movimentacoes;
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
				$query = "SELECT movimentacoes.tipo, movimentacoes.inicio, movimentacoes.fim, conteiner.cliente, conteiner.conteiner FROM movimentacoes
									INNER JOIN conteiner
									ON movimentacoes.id_conteiner = conteiner.id
									ORDER BY conteiner.cliente, movimentacoes.tipo";

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

		function update($id) {
			$result = array();

			try {
				$query = "UPDATE movimentacoes SET fim = CURRENT_TIMESTAMP WHERE id = $id";

				$con = new Connection();

				$status = Connection::getInstance()->prepare($query);

				if($status->execute()){
					$result[] = $id;
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
				$query = "DELETE FROM movimentacoes WHERE id = $id";

				$con = new Connection();

				if(Connection::getInstance()->exec($query) >= 1){
					$result[] = $id;
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}
	}
