<?php

	require("../../domain/connection.php");
	require("../../domain/movimentacoes.php");

	class MovimentacoesProcess {
		var $md;

		function doGet($arr){
			$md = new MovimentacoesDAO();
			$result = $md->read();
			http_response_code(200);
			echo json_encode($result);
		}


		function doPost($arr){
			$md = new MovimentacoesDAO();
			$m = new Movimentacoes();

			$data = json_decode(file_get_contents("php://input"), false);

			$m->setId_conteiner($data->id_conteiner);
			$m->setTipo($data->tipo);

			$result = $md->create($m);
			http_response_code(200);
			echo json_encode($result);
		}


		function doPut($arr){
			$md = new MovimentacoesDAO();

			$data = json_decode(file_get_contents("php://input"), false);

			$id = $data->id;

			$result = $md->update($id);
			http_response_code(200);
			echo json_encode($result);
		}


		function doDelete($arr){
			$md = new MovimentacoesDAO();

			$data = json_decode(file_get_contents("php://input"), false);

			$id = $data->id;

			$result = $md->delete($id);
			http_response_code(200);
			echo json_encode($result);
		}
	}