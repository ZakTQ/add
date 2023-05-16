<?php
include_once "../../Database.php";

var_dump($_POST);

$id = $_POST['delete_id'];

$db = new Database();
$conn = $db::connect();

$sql = "DELETE FROM `users` WHERE `id` = :id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

header('Location: /');