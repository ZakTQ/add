<?php

class Database
{
	// private $host,
	// 	$db_name,
	// 	$user_name,
	// 	$user_pass;

	static function connect()
	{
		try {
			$conn = new PDO("mysql:host=localhost;dbname=api_db", 'root', null);
		} catch (PDOException $e) {
			$e->getMessage();
			die();
		}

		return $conn;
	}
}
