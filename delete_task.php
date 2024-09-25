<?php

// delete_task.php

include('connection.php');

// Check if task_id is set
if (isset($_POST["task_id"])) {
    // Prepare the delete query using a ? placeholder
    $query = "DELETE FROM task_list WHERE task_id = ?";

    // Prepare the statement
    if ($statement = $connect->prepare($query)) {
        // Bind the task_id parameter (i for integer)
        $statement->bind_param('i', $_POST['task_id']);

        // Execute the query
        if ($statement->execute()) {
            echo 'done';
        } else {
            echo 'Error executing query';
        }

        // Close the statement
        $statement->close();
    } else {
        echo 'Error preparing statement';
    }
} else {
    echo 'Task ID is not set';
}

// Close the database connection
$connect->close();

?>
