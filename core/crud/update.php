<?php
include_once "../../Database.php";

echo "<pre>";
var_dump($_POST);
echo "</pre>";

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$types = ["image/jpeg", "image/png"];
$image = $_FILES["avatar"];

function avatarDelete($id)
{

    $db = new Database();
    $conn = $db::connect();
    $sql = "SELECT `avatar` FROM `users` WHERE `id` = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $deleteFile = $stmt->fetch(PDO::FETCH_ASSOC);
    if($deleteFile['avatar']){
        $path = "../../uploads/";
        $result = $path . $deleteFile['avatar'];
        unlink($result);
    }else{
    }

}


if (!in_array($image["type"], $types)) {
    die('Incorrect file type');
}

$fileSize = $image["size"] / 1000000;
$maxSize = 1;

if ($fileSize > $maxSize) {
    die('Incorrect file size');
}

avatarDelete($id);

// if (!is_dir('uploads')) {
//     mkdir('..\..\uploads', 0777, true);
// }

$extension = pathinfo($image["name"], PATHINFO_EXTENSION);
$fileName = time() . $image["name"];

move_uploaded_file($image["tmp_name"], "../../uploads/" . $fileName);


//найти все обьекты с itemID =id
$db = new Database();
$conn = $db::connect();

$sql = "UPDATE `users` SET `name`= :name,`email`= :email,`password`= :password,`avatar` = :filename WHERE `id` = :id";


$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);
$stmt->bindParam(':filename', $fileName, PDO::PARAM_STR);
$stmt->execute();

header('Location: /');
