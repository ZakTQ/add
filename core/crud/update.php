<?php
include_once "../../Database.php";

echo "<pre>";
var_dump($_POST);
echo "</pre>";

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

print_r($_FILES);

$avatar = $_FILES["avatar"];

// $avatar = $_FILES["avatar"];

//найти все обьекты с itemID =id
$db = new Database();
$conn = $db::connect();

$sql = "UPDATE `users` SET `name`= :name,`email`= :email,`password`= :password WHERE `id` = :id";

// $sql = "SELECT * FROM `users` WHERE `id` = :id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);
$stmt->execute();

// header('Location: /');
