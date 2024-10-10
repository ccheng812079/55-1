<?php
header("Content-Type:application/json");
include 'db.php';

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"), true);

switch ($method) {
    case 'POST':
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $content = $data['content'];
        $num = $data['num']; // 添加 num 欄位

        $sql = "INSERT INTO web01 (name, email, phone, content, num) VALUES ('$name', '$email', '$phone', '$content', '$num')";
        $pdo->exec($sql);
        echo json_encode(["message" => "web01 entry added"]);
        break;

    case 'GET':
        $sql = "SELECT * FROM web01";
        $stmt = $pdo->query($sql);
        $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($entries);
        break;

    case 'PUT':
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $content = $data['content'];
        $num = $data['num']; // 添加 num 欄位

        $sql = "UPDATE web01 SET name='$name', email='$email', phone='$phone', content='$content', num='$num' WHERE id=$id";
        $pdo->exec($sql);
        echo json_encode(["message" => "web01 entry updated"]);
        break;

    case 'DELETE':
        $id = $data['id'];
        $sql = "DELETE FROM web01 WHERE id=$id";
        $pdo->exec($sql);
        echo json_encode(["message" => "web01 entry deleted"]);
        break;

    default:
        echo json_encode(["message" => "Invalid request method"]);
        break;
}

$pdo = null;
?>
