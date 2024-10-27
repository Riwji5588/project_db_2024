<?php
# Connect to MySQL
$host = "nattavipolbo.ddns.net:3306";
$user = "root";
$pass = "Riwji5588";
$db = "project_db";

$conn = mysqli_connect($host, $user, $pass, $db);

# Check the connection
if (!$conn) {
    echo json_encode(["error" => "Connection failed: " . mysqli_connect_error()]);
    exit();
}

// $job_id = $_POST['job_id'];
$Restaurant_Name = $_POST['Restaurant_Name'];
$Restaurant_address = $_POST['Restaurant_address'];
$Restaurant_phone_number = $_POST['Restaurant_phone_number'];
$query = "INSERT INTO restaurants (user_id ,name, address, phone_number , status , rating) VALUES (1 ,'$Restaurant_Name', '$Restaurant_address', '$Restaurant_phone_number' , 1 , 0)";
$result = mysqli_query($conn, $query);
if ($result) {
    echo json_encode([
        "status" => true,
        "message" => "Data inserted successfully",
    ]);

} else {
    echo json_encode([
        "error" => "SQL error: " . mysqli_error($conn),
        "query" => $query
    ]);
}

mysqli_close($conn);

?>