<?php
include_once "Database.php";
$db = new Database();
require_once "core/header.php";
?>


<div class="container">
    <form class="form-reg" action="core/crud/create.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Почтовый адрес</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>
<div>
    <div class="container">
        <div class="d-flex flex-row flex-wrap mt-3">
            <?php
            //тут выводим все итемы из USERS вывести надо этот код отдельно!!!
            $conn = $db::connect();
            $stmt = $conn->prepare("SELECT * FROM `users`");

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
            ?>
                <div>
                    <form class="m-2" action="edit.php" method="post">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                            <?php
                            if (!$row['avatar']) {
                            ?>
                                <img src="uploads/001.jpg" class="card-img-top" alt="...">
                            <?php
                            } else {
                            ?>
                                <img src="<?php echo "uploads/" . $row['avatar'] ?>" class="card-img-top" alt="...">
                            <?php
                            }
                            ?>
                                <h5 class="card-title">Пользователь id: <?php echo $row['id'] ?></h5>
                                <p class="card-text">Админ</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">name: <?php echo $row['name'] ?></li>
                                <li class="list-group-item">email: <?php echo $row['email'] ?></li>
                                <li class="list-group-item">password: <?php echo $row['password'] ?></li>
                            </ul>
                            <div class="card-body">
                                <!-- <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a> -->
                                <input type="hidden" name="itemID" value="<?php echo $row['id'] ?>">
                                <input type="submit" value="Изменить">

                            </div>
                        </div>
                    </form>
                    <form class="m-2" action="core/crud/delete.php" method="post">
                        <div class="card" style="width: 18rem;">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
                            <input type="submit" value="Удалить">
                        </div>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php
require_once "core/footer.php";
?>