<?php

	require("../process/process.movimentacoes.php");

	include("configs.php");

	$mp = new MovimentacoesProcess();

	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
			$mp->doGet($_GET);
			break;

		case "POST":
			$mp->doPost($_POST);
			break;

		case "PUT":
			$mp->doPut($_PUT);
			break;

		case "DELETE":
			$mp->doDelete($_DELETE);
			break;
	}