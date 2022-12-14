<?php
class Products
{
    public function index()
    {
        $products = array();
        require_once "./Conn.php";
        $productssql = "SELECT * FROM `products`  ORDER BY `id` DESC";
        $productsresult = $connclass->conn->query($productssql);
        if ($productsresult->num_rows > 0) {
            while ($productsrow = $productsresult->fetch_assoc()) {
                $products[] = $productsrow;
            }
        }
        echo json_encode($products);
    }

    public function delete()
    {
        require_once './Conn.php';
        $postdata = json_decode(file_get_contents("php://input"), true);
        $id = json_encode($postdata["id"]);
        $productssql = "SELECT * FROM `products` WHERE `id` = '$id'";
        $productsresult = $connclass->conn->query($productssql);
        if ($productsresult->num_rows === 1) {
            while ($productsrow = $productsresult->fetch_assoc()) {
                unlink("../images/" . $productsrow["imagename"]);
                $deleteproduct = "DELETE FROM `products` WHERE `id` = '$id'";
                if ($connclass->conn->query($deleteproduct) === TRUE) {;
                } else {
                    die($connclass->conn->error);
                }
            }
        }
    }
}

$productsclass = new Products();
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    return $productsclass->index();
}
