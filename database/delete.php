<?php
// Assuming you have a database connection here
include('db_connection.php');

// Get the data from the POST request
$data = json_decode(file_get_contents("php://input"));

// Check if the student ID is provided
if (isset($data->id)) {
    $studentId = $data->id;

    // SQL query to delete student
    $query = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $studentId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No student ID provided']);
}
?>
