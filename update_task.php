<?php
include('connection.php');

if (isset($_POST["task_id"])) {
    $task_id = $_POST["task_id"];
    $query = "SELECT task_status FROM task_list WHERE task_id = ?";

    if ($statement = $connect->prepare($query)) {
        $statement->bind_param('i', $task_id);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        // Toggle task_status between 'yes' and 'no'
        $new_status = ($row["task_status"] == 'yes') ? 'no' : 'yes';

        // Update the status in the database
        $update_query = "UPDATE task_list SET task_status = ? WHERE task_id = ?";
        if ($update_statement = $connect->prepare($update_query)) {
            $update_statement->bind_param('si', $new_status, $task_id);
            if ($update_statement->execute()) {
                // Redirect back to the index page to refresh the tasks
                header('Location: index.php');
                exit();
            } else {
                echo 'Error updating task';
            }
        }
    }
}
?>
