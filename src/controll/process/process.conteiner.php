<?php

	require("../../domain/connection.php");
	require("../../domain/conteiner.php");

	class ConteinerProcess {
		var $cd;

		function doGet($arr){
			$cd = new ConteinerDAO();
			$result = $cd->read();
			http_response_code(200);
			echo json_encode($result);
		}


		function doPost($arr){
			$cd = new ConteinerDAO();
			$conteiner = new Conteiner();

			$data = json_decode(file_get_contents('php://input'), false);

			$conteiner->setId_cliente($data->cliente);
			$conteiner->setConteiner($data->conteiner);
			$conteiner->setTipo($data->tipo);
			$conteiner->setStatus($data->status);
			$conteiner->setCategoria($data->categoria);

			$result = $cd->create($conteiner);
			http_response_code(200);
			echo json_encode($result);
		}


		function doPut($arr){
			$cd = new ConteinerDAO();
			$conteiner = new Conteiner();

			$data = json_decode(file_get_contents('php://input'), false);

			$conteiner->setId($data->id);
			$conteiner->setId_cliente($data->cliente);
			$conteiner->setConteiner($data->conteiner);
			$conteiner->setTipo($data->tipo);
			$conteiner->setStatus($data->status);
			$conteiner->setCategoria($data->categoria);

			$result = $cd->update($conteiner);
			http_response_code(200);
			echo json_encode($result);
		}


		function doDelete($arr){
			$cd = new ConteinerDAO();

			$data = json_decode(file_get_contents('php://input'), false);

			$id = $data->id;

			$result = $cd->delete($id);
			http_response_code(200);
			echo json_encode($result);
		}
	}