<?php
// Assuming you have a database connection
include('index.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['studentName'];
    $course = $_POST['studentCourse'];
    $age = $_POST['studentAge'];
    $address = $_POST['studentAddress'];

    // Prepare and execute SQL statement to insert the data into your database
    $sql = "INSERT INTO students (name, course, age, address) VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $name, $course, $age, $address);  // 's' for string, 'i' for integer
    if ($stmt->execute()) {
        echo "New student added successfully!";
        header("Location: index.php"); // Redirect to the same page after successful insert
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>


