<?php
// เชื่อมต่อฐานข้อมูล
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "nodemcu_esp32";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ดึงข้อมูลจากฐานข้อมูล
$table = mysqli_query($conn, "SELECT No, Ds, Ult, Ph, Date, Time FROM nodemcu_esp32_table ORDER BY No DESC");

// อ่านข้อมูลและเก็บในตัวแปร
$data = array();
if ($row = mysqli_fetch_array($table)) {
    $data['Ds'] = $row["Ds"];
    $data['Ult'] = $row["Ult"];
    $data['Ph'] = $row["Ph"];
    $data['Date'] = $row["Date"];
    $data['Time'] = $row["Time"];
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
mysqli_close($conn);

// ส่งข้อมูลในรูปแบบ JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
