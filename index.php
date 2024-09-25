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
    <title>Beautiful To-Do List with PHP and Ajax</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Date Card in the Upper Middle -->
        <div class="date-container">
            <div class="date-card" id="current-date"></div>
        </div>
        
        <h1 align="center">To-Do List with PHP and Ajax</h1>

        <br />

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-9">
                        <h3 class="panel-title">My To-Do List</h3>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <form method="post" id="to_do_form">
                    <span id="message"></span>
                    <div class="input-group">
                        <input type="text" name="task_name" id="task_name" class="form-control input-lg" autocomplete="off" placeholder="Enter your task..." />
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
                    foreach ($result as $row) {
                        $style = '';
                        if ($row["task_status"] == 'yes') {
                            $style = 'completed-task';
                        }
                        echo '<a href="#" class="list-group-item ' . $style . '" id="list-group-item-' . $row["task_id"] . '" data-id="' . $row["task_id"] . '">'
                            . htmlspecialchars($row["task_details"]) . ' <span class="badge" data-id="' . $row["task_id"] . '">X</span></a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="custom.js"></script>
</body>
</html>
