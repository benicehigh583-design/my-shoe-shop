<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);
    $mail->CharSet = "UTF-8"; 
    $mail->Encoding = "base64";
    // รับค่าจากฟอร์ม
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $product = $_POST["product"];
    $quantity = $_POST["quantity"];

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'benicehigh583@gmail.com';   
        $mail->Password = 'xocwfspxtjuktvmz';    
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('yourgmail@gmail.com', 'ร้านขายรองเท้า');
        $mail->addAddress('yourgmail@gmail.com'); // ใส่อีเมลผู้รับ

        $mail->isHTML(true);
        $mail->Subject = "📩 คำสั่งซื้อใหม่จากเว็บไซต์";
        $mail->Body = "
            <h3>รายละเอียดคำสั่งซื้อ:</h3>
            <p><strong>ชื่อ:</strong> $name</p>
            <p><strong>เบอร์:</strong> $phone</p>
            <p><strong>ที่อยู่:</strong> $address</p>
            <p><strong>สินค้า:</strong> $product</p>
            <p><strong>จำนวน:</strong> $quantity</p>
        ";

        $mail->send();
        header("Location: contact.html?status=success");
        exit;
    } catch (Exception $e) {
        header("Location: contact.html?status=error");
        exit;
    }
} else {
    header("Location: contact.html");
    exit;
}
?>
