<?php
session_start();
include('index.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $course = $_POST['course'];
    $address = $_POST['address'];

    $sql = "INSERT INTO students (first_name, middle_name, last_name, age, course, address) VALUES ('$firstname',
    '$middlename','$lastname','$age','$course','$address')";

    if (mysqli_query($conn, $sql)) {
        $SESSION['status'] = "created";   
    } else {
        $SESSION['status'] = "error";
    }

    mysqli_close($conn);
    header("Location: ../dashboard.php");
    exit();
}

?>