<?php

	// AQUI NO LOCALHOST
	$DB_HOST = 'localhost';
	$DB_USER = 'root';
	$DB_PASS = '';
	$DB_NAME = 'sisfestas';

	// AQUI NO SERVIDOR DE HOSPEDAGEM
	// $DB_HOST = 'localhost';
	// $DB_USER = 'openbe48_vegadv';
	// $DB_PASS = '{K1s6yuznQ7p';
	// $DB_NAME = 'openbe48_vegadv';
	
	try{
		$pdo = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	
