<?php
include_once "../../Database.php";

// берем пост массив
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];


// создал обьек класса дата-базы
$db = new Database();
//коннект через функцию конект
$conn = $db::connect();
//добавил наме в базу юзер
$stmt = $conn->prepare("INSERT INTO `users` (`name`, `email`, `password`) VALUES (:name, :email, :password)");

// INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES (NULL, '1', '2', '3');

//бинд параметра
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);
$stmt->execute();

// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Location: /');

/*
PDO::FETCH_ASSOC (int)
Указывает, что метод, осуществляющий выборку данных, должен возвращать каждую строку результирующего набора в виде ассоциативного массива, индексы которого соответствуют именам столбцов результата выборки. Если в результирующем наборе несколько столбцов с одинаковыми именами, PDO::FETCH_ASSOC будет возвращать по одному значению для каждого столбца. Значения дублирующихся столбцов будут утеряны.
*/