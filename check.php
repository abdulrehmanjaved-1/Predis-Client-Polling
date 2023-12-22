<?php
require("config.php");

if (!empty($_POST['btnSubmit'])) {
    // Sanitize and validate your input
    $poll = mysqli_real_escape_string($conn, $_POST["poll"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $answer_options = mysqli_real_escape_string($conn, $_POST["answer_options"]);
    $start_date_time = mysqli_real_escape_string($conn, $_POST["start_date_time"]);
    $end_date_time = mysqli_real_escape_string($conn, $_POST["end_date_time"]);

    // Check if the input validation is successful

    // Insert data into the database
    $query = "INSERT INTO poll (pol, description, answer_options, start_date_time, end_date_time) VALUES ('$poll', '$description', '$answer_options', '$start_date_time', '$end_date_time')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Poll added successfully'); window.location = 'manage_project.php';</script>";
    } else {
        // Handle the error more gracefully, e.g., log the error or display a user-friendly message
        echo "<script>alert('Error adding poll'); window.location = 'manage_project.php';</script>";
    }
}
?>
