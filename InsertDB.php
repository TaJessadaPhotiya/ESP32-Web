<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";    // Database server host (e.g., localhost)
$username = "root";           // Database username
$password = "";               // Database password
$dbname = "nodemcu_esp32";      // Database name

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}

// รับข้อมูลจาก ESP32
if (!empty($_POST['dsvalue']) && !empty($_POST['ultvalue']) && !empty($_POST['phvalue'])) {
    $dsValue = $_POST['dsvalue'];
    $ultValue = $_POST['ultvalue'];
    $phValue = $_POST['phvalue'];

    // ประมวลผลข้อมูลที่ได้รับและดำเนินการที่จำเป็น

    // ใส่ข้อมูลลงในฐานข้อมูล
    date_default_timezone_set('Asia/Bangkok'); // ตั้งค่าโซนเวลาเป็นกรุงเทพ
    $date = date("Y-m-d"); // เปลี่ยนรูปแบบวันที่เป็น 'd-m-Y'
    $time = date("H:i:s");

    $sql = "INSERT INTO nodemcu_esp32_table (Ds, Ult, Ph, Date, Time) VALUES ('$dsValue', '$ultValue', '$phValue', '$date', '$time')";

    if ($conn->query($sql) === TRUE) {
        echo "Data Inserted Successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "No Data Received";
}

$conn->close();
?>
