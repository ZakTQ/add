<?php

require_once "Database.php";
require_once "core/header.php";

?>

<div class="container">
    <div class="d-flex flex-row flex-wrap mt-3">
        <?php
        $db = new Database();
        $conn = $db->connect();

        $sql = "SELECT * FROM `categories`";
        $stmt = $conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
        ?>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/uploads/001.jpg" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['name'] ?></h5>
                            <p class="card-text"><?= $row['description'] ?></p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
                <!-- d-flex flex-row-reverse вставил это чтобы передвинуть кнопку вправо -->
                <div class="card-body d-flex flex-row-reverse">
                    <a href="#" class="btn btn-primary">Купить</a>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
</div>


<?php
require_once "core/footer.php";
