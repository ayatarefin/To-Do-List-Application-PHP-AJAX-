<?php
include('connection.php');

// Use prepared statements to avoid SQL injection
$query = "SELECT * FROM task_list WHERE user_id = ? ORDER BY task_id DESC";

if ($statement = $connect->prepare($query)) {
    $statement->bind_param("i", $_SESSION["user_id"]);
    $statement->execute();
    $result = $statement->get_result();
} else {
    die("SQL query failed");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO-DO List by PHP using Ajax</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Comic Sans MS';
        }

        .list-group-item {
            font-size: 26px;
        }

        .completed-task {
            text-decoration: line-through;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 align="center">This To-do list is developed by PHP using Ajax</h1>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-9">
                        <h3 class="panel-title">My To-Do List</h3>
                    </div>
                    <div class="col-md-3">
                        <!-- Optionally you can add a filter or sorting buttons here -->
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form method="post" id="to_do_form">
                    <span id="message"></span>
                    <div class="input-group">
                        <input type="text" name="task_name" id="task_name" class="form-control input-lg" autocomplete="off" placeholder="Title..." />
                        <div class="input-group-btn">
                            <button type="submit" name="submit" id="submit" class="btn btn-success btn-lg">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </div>
                    </div>
                </form>
                <br />
                <div class="list-group">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        // Apply the 'completed-task' class if the task is marked as completed
                        $class = ($row["task_status"] == 'yes') ? 'completed-task' : '';
                        echo '<a href="#" class="list-group-item ' . $class . '" id="list-group-item-' . htmlspecialchars($row["task_id"]) . '" data-id="' . htmlspecialchars($row["task_id"]) . '">'
                            . htmlspecialchars($row["task_details"]) . ' <span class="badge" data-id="' . htmlspecialchars($row["task_id"]) . '">X</span></a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="custom.js"></script>
</body>

</html>
