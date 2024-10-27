<?php
# Connect to MySQL
$host = "nattavipolbo.ddns.net:3306";
$user = "root";
$pass = "Riwji5588";
$db = "lab_db_10";

$conn = mysqli_connect($host, $user, $pass, $db);

# Check the connection
if (!$conn) {
    echo json_encode(["error" => "Connection failed: " . mysqli_connect_error()]);
    exit();
}

    $job_id = $_POST['job_id'];
    $job_title = $_POST['job_title'];
    $min_salary = $_POST['min_salary'];
    $max_salary = $_POST['max_salary'];
    $query = "INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES ('$job_id', '$job_title', '$min_salary', '$max_salary')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo json_encode([
            "status" => true,
            "message" => "Data inserted successfully",
            "job_id" => $job_id,
            "job_title" => $job_title,
            "min_salary" => $min_salary,
            "max_salary" => $max_salary
        ]);
        
    } else {
        echo json_encode([
            "error" => "SQL error: " . mysqli_error($conn),
            "query" => $query
        ]);
    }
    
    mysqli_close($conn);

?>