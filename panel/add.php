<?php
require_once './Conn.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_FILES['image']['name'] !== '' && $_POST['header'] !== '' && $_POST['description'] !== '' && $_POST['price'] !== '') {
        $filename = $_FILES['image']['name'];
        $filetmp = $_FILES['image']['tmp_name'];
        $newname = "XMARKET_" . date("YmdHis") . rand(0, 999999) . '.' . pathinfo($filename, PATHINFO_EXTENSION);
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $header = $_POST['header'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        if (move_uploaded_file($filetmp, $target_dir . $newname)) {
            $makepost = "INSERT INTO `products`(`imagename`,`header`,`description`,`price`)VALUES('$newname','$header','$description','$price')";
            if ($connclass->conn->query($makepost) === TRUE) {
                header("location: ./index.html");
            } else {
                die($connclass->conn->error);
            }
        } else {
            die("ფოტო არ აიტვირთა");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XMARKET</title>
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" id="stylecss">
</head>

<body>
    <!-- Start the navbar -->
    <nav class="navbar navbar-expand-lg bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">XMARKET</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="../">მთავარი</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="./add.php">დამატება</a>
                    </li>
                </ul>
                <a class="nav-link active" href="./Logout.php">გასვლა</a>
            </div>
        </div>
    </nav>
    <!-- End the navbar -->

    <div class="formarea">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="image" class="form-label">ფოტო</label>
                <input type="file" class="form-control" name="image" id="image" accept=".jpg, .jpeg, .png">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($_FILES['image']['name'] == '') {
                ?>
                        <b class="text-danger">ფოტოს ატვირთვა სავალდებულოა.</b>
                <?php
                    }
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="header" class="form-label">სათაური</label>
                <textarea name="header" id="header" rows="10" class="form-control"></textarea>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['header'] === '') {
                ?>
                    <b class="text-danger">სათაურის შევსება სავალდებულოა</b>
                <?php
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">აღწერა</label>
                <textarea name="description" id="description" rows="10" class="form-control"></textarea>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['description'] === '') {
                ?>
                    <b class="text-danger">აღწერის შევსება სავალდებულოა</b>
                <?php
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">ფასი</label>
                <input type="number" name="price" id="price" class="form-control">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['price'] === '') {
                ?>
                    <b class="text-danger">ფასის შევსება სავალდებულოა</b>
                <?php
                }
                ?>
            </div>
            <div class="mb-3">
                <button class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>

    <!-- Javascript -->
    <script>
        function deleteFunction(id) {
            fetch("./Products.php", {
                method: "POST",
                body: JSON.stringify({
                    id: id
                })
            }).then(response => response.text()).then(data => {
                if (data === '') {
                    document.location.reload()
                } else {
                    console.log(data)
                }
            }).catch(error => console.log(error))
        }
    </script>
    <script id="paneljs"></script>
    <script src="./js/query.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>