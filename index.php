<?php
include('connection.php');
$query = "SELECT * FROM task_list 
WHERE user_id = '" . $_SESSION["user_id"] . "'
ORDER BY task_id DESC";

$result = mysqli_query($connect, $query) or die("SQL query failed");

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

                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form method="post" id="to_do_form">
                    <span id="message"></span>
                    <div class="input-group">
                        <input type="text" name="task_name" id="task_name" class="form-control input-lg" autocomplete="off" placeholder="Title..." />
                        <div class="input-group-btn">
                            <button type="submit" name="submit" id="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span></button>
                        </div>
                    </div>
                </form>
                <br />
                <div class="list-group">
                    <?php
                    foreach ($result as $row) {
                        $style = '';
                        if ($row["task_status"] == 'yes') {
                            $style = 'text-decoration: line-through';
                        }
                        echo '<a href="#" style="' . $style . '" class="list-group-item" id="list-group-item-' . $row["task_id"] . '" data-id="' . $row["task_id"] . '">' . $row["task_details"] . ' <span class="badge" data-id="' . $row["task_id"] . '">X</span></a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>