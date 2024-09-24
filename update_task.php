<?php
include('connection.php');

if (isset($_POST["task_id"])) {

    // Prepare the SQL query using placeholders
    $query = "UPDATE task_list SET task_status = ? WHERE task_id = ?";

    // Prepare the statement using mysqli
    if ($statement = $connect->prepare($query)) {

        // Set the values you want to bind
        $task_status = 'yes'; // Mark the task as completed
        $task_id = $_POST["task_id"];

        // Bind the values to the placeholders (s for string, i for integer)
        $statement->bind_param('si', $task_status, $task_id);

        // Execute the statement
        if ($statement->execute()) {
            echo 'done';
        } else {
            echo 'Error updating task';
        }
    } else {
        echo 'Failed to prepare the statement';
    }
}
?>
