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

if ($_GET['exam'] == '1') {
    $query = "SELECT * FROM restaurants";  # Adjust the table name and column accordingly
    $result = mysqli_query($conn, $query);

    $jobs = [];

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $jobs[] = $row;
            }
        }
        echo json_encode([
            //"query" => $query,  // Return the SQL query
            "data" => $jobs
        ]);
    } else {
        # If query failed, send error information
        echo json_encode([
            "error" => "SQL error: " . mysqli_error($conn),
            "query" => $query  # Also return the failed query
        ]);
    }

    # Close the connection
    mysqli_close($conn);
}

// if ($_GET['exam'] == '2') {
//     $query = "SELECT employees.first_name, employees.last_name, departments.department_name FROM employees 
//                         JOIN departments ON employees.department_id = departments.department_id 
//                         WHERE salary <= 5000";  # Adjust the table name and column accordingly
//     $result = mysqli_query($conn, $query);

//     $jobs = [];

//     if ($result) {
//         if (mysqli_num_rows($result) > 0) {
//             while ($row = mysqli_fetch_assoc($result)) {
//                 $jobs[] = $row;
//             }
//         }
//         echo json_encode([
//             "query" => $query,  // Return the SQL query
//             "data" => $jobs
//         ]);
//     } else {
//         # If query failed, send error information
//         echo json_encode([
//             "error" => "SQL error: " . mysqli_error($conn),
//             "query" => $query  # Also return the failed query
//         ]);
//     }

//     # Close the connection
//     mysqli_close($conn);
// }

// if ($_GET['exam'] == '6') {
//     $zipcode = $_GET['zip_code'];
//     $query = "SELECT
// 	locations.city, 
// 	regions.region_name, 
// 	countries.country_name, 
// 	locations.postal_code
// FROM
// 	locations
// 	INNER JOIN
// 	countries
// 	ON 
// 		locations.country_id = countries.country_id
// 	INNER JOIN
// 	regions
// 	ON 
// 		countries.region_id = regions.region_id
// WHERE
// 	locations.postal_code = '$zipcode'";
//     $result = mysqli_query($conn, $query);
//     $address = [];
//     if ($result) {
//         if (mysqli_num_rows($result) > 0) {
//             while ($row = mysqli_fetch_assoc($result)) {
//                 $address[] = $row;
//             }
//         }
//         echo json_encode([
//             "query" => $query,  // Return the SQL query
//             "data" => $address
//         ]);
//     } else {
//         # If query failed, send error information
//         echo json_encode([
//             "error" => "SQL error: " . mysqli_error($conn),
//             "query" => $query  # Also return the failed query
//         ]);
//     }
// }

if ($_GET['exam'] == 'view_menu') {
    $id = $_GET['id'];
    $query = "SELECT * FROM menuitems WHERE restaurant_id = $id";  # Adjust the table name and column accordingly
    $result = mysqli_query($conn, $query);

    $data = [];
    //next
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        echo json_encode([
            "query" => $query,  // Return the SQL query
            "data" => $data
        ]);
    } else {
        # If query failed, send error information
        echo json_encode([
            "error" => "SQL error: " . mysqli_error($conn),
            "query" => $query  # Also return the failed query
        ]);
    }
}
?>