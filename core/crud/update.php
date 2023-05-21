<?php
include_once "../../Database.php";

/*
файл получает по ПОСТ методу с файла EDIT.PHP данные и обновляет их
а так же файл ищет файл предыдущего аватара если он был и удаляетт его. Заменяя новым файлом
в аватарах при NULL ставиться стандартная картинка
*/

echo "<pre>";
var_dump($_POST);
echo "</pre>";

//получаю данные о карточке
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$types = ["image/jpeg", "image/png"];
$image = $_FILES["avatar"];

//функция для удаления предыдущего аватара записанного в БД
function avatarDelete($id)
{
    //соединение с БД
    $db = new Database();
    $conn = $db::connect();
    //подготовка запроса
    $sql = "SELECT `avatar` FROM `users` WHERE `id` = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    //получаю массив с именем файла из БД
    $deleteFile = $stmt->fetch(PDO::FETCH_ASSOC);
    if($deleteFile['avatar']){
        //получаю полный путь к старому аватару
        $path = "../../uploads/";
        $result = $path . $deleteFile['avatar'];
        //удаляю аватар
        unlink($result);
    }else{
        //тут возращает ничего. надо проработать код нормально
    }

}

//проверка размера файла
if (!in_array($image["type"], $types)) {
    die('Incorrect file type');
}

$fileSize = $image["size"] / 1000000;
$maxSize = 1;

if ($fileSize > $maxSize) {
    die('Incorrect file size');
}
//запуск функции удаления старого аватара
avatarDelete($id);

//проверка существует ли папка. я его отключил. выдавало ошибку. что то с путем к файлу
// if (!is_dir('uploads')) {
//     mkdir('..\..\uploads', 0777, true);
// }

//задаю новое имя и путь к файлу
$extension = pathinfo($image["name"], PATHINFO_EXTENSION);
$fileName = time() . $image["name"];
//загрузка файла в папку
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
