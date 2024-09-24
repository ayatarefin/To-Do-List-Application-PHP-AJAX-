<?php
include('connection.php'); // Ensure your DB connection is included

// Check if task_name is set and not empty
if (isset($_POST["task_name"]) && !empty(trim($_POST["task_name"]))) {

    // Prepare the SQL query using question mark placeholders
    $query = "INSERT INTO task_list (user_id, task_details, task_status) VALUES (?, ?, ?)";

    // Prepare the statement using mysqli
    if ($statement = $connect->prepare($query)) {

        // Bind parameters to the prepared statement (3 parameters: user_id, task_name, task_status)
        $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
        $task_details = trim($_POST["task_name"]); // Clean up the task name
        $task_status = 'no'; // Default task status

        // Bind the values to the placeholders (i for integer, s for string)
        $statement->bind_param('iss', $user_id, $task_details, $task_status);

        // Execute the statement
        if ($statement->execute()) {
            // Get the ID of the last inserted task
            $task_id = $connect->insert_id;

            // Return the task as an HTML element with the task ID
            echo '<a href="#" class="list-group-item" id="list-group-item-'.$task_id.'" data-id="'.$task_id.'">'
                . htmlspecialchars($_POST["task_name"]) . ' <span class="badge" data-id="'.$task_id.'">X</span></a>';
        } else {
            echo 'Error: Could not execute query.';
        }

        // Close the statement
        $statement->close();
    } else {
        echo 'Error: Could not prepare the statement.';
    }

    // Close the database connection
    $connect->close();
} else {
    echo 'Error: Task name is required.';
}
?>
