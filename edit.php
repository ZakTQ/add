<?php
require_once "Database.php";
require_once "core/header.php";
//сделал отдельно метод READ который пока читает строку из БД по ID и отдает массив
require_once "core/crud/read.php";
//получаю ID методом пост
$id = $_POST['itemID'];
//ищу в БД по ID строку и вытаскиваб массив
$read = new Read();
//сделал переменную для выбора таблицы
$item = "users";

$result = $read->select($item, $id);

?>

<form class="form-reg" method="POST" action="core/crud/update.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $result['id'] ?>">
    <?php
    //задаю путь до аватара используя массив с ИД полученый с БД
    $imgAvatar = "uploads/" . $result['avatar'];
    //если файла аватара нет в ДБ и оно нулл то вставляю стандартную картинку
    if (!$result['avatar']) {
    ?>
        <img src="uploads/001.jpg" class="card-img-top" alt="...">
    <?php
    } else {
    ?>
        <img src="<?php echo $imgAvatar ?>" class="card-img-top" alt="...">
    <?php
    }
    ?>

    <div class="mb-3">
        <label for="avatar" class="form-label">Аватар</label>
        <input type="file" name="avatar" class="form-control">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Имя</label>
        <input type="text" name="name" class="form-control" value="<?= $result['name'] ?>">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Почтовый адрес</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $result['email'] ?>">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" name="password" class="form-control" value="<?= $result['password'] ?>" id="exampleInputPassword1">
    </div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>

<?php
require_once "core/footer.php";
?>