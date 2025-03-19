<?php
// Assuming you have a database connection here
include('db_connection.php');

// Get the data from the POST request
$data = json_decode(file_get_contents("php://input"));

// Check if the student data is provided
if (isset($data->id) && isset($data->name) && isset($data->course) && isset($data->age) && isset($data->address)) {
    $studentId = $data->id;
    $name = $data->name;
    $course = $data->course;
    $age = $data->age;
    $address = $data->address;

    // SQL query to update student
    $query = "UPDATE students SET name = ?, course = ?, age = ?, address = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssisi", $name, $course, $age, $address, $studentId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Incomplete data']);
}
?>
