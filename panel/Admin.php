<?php
session_start();
class Admin
{
    public function index()
    {
        $admin = array();
        require_once './Conn.php';
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $adminsql = "SELECT * FROM `admins` WHERE `username` = '$username'";
            $adminresult = $connclass->conn->query($adminsql);
            if ($adminresult->num_rows > 0) {
                while ($adminrow = $adminresult->fetch_assoc()) {
                    $admin[] = $adminrow;
                }
            }
        }
        echo json_encode($admin);
    }

    public function login()
    {
        require_once './Conn.php';
        $postdata = json_decode(file_get_contents("php://input"), true);
        $username = $postdata['username'];
        $password = md5($postdata['password']);
        $loginsql = "SELECT * FROM `admins` WHERE `username` = '$username' AND `password` = '$password'";
        $loginresult = $connclass->conn->query($loginsql);
        if ($loginresult->num_rows === 1) {
            $_SESSION['username'] = $username;
        } else {
            echo "იუზერნეიმი ან/და პაროლი არასწორია.";
        }
    }
}

$adminclass = new Admin();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    return $adminclass->index();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    return $adminclass->login();
}
