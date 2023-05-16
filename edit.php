<?php
require_once "core/header.php";
include_once "Database.php";

$id = $_POST['itemID'];

//найти все обьекты с itemID =id
$db = new Database();
$conn = $db::connect();

$sql = "SELECT * FROM `users` WHERE `id` = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<form class="form-reg" method="POST" action="core/crud/update.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $result['id'] ?>">
    <?php
    if (!$result['avatar']) {
    ?>
    <img src="uploads/001.jpg" class="card-img-top" alt="...">
    <?php
    } else {
    ?>
    <img src="<?php echo $result['avatar'] ?>" class="card-img-top" alt="...">
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
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            value="<?= $result['email'] ?>">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" name="password" class="form-control" value="<?= $result['password'] ?>"
            id="exampleInputPassword1">
    </div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>

<?php
require_once "core/footer.php";
?>