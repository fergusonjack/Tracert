<!DOCTYPE html>
<html lang="en">
<head>

    <?php
        $title = "Tracert plotter";
    ?>

    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/mainJack.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><?php echo $title; ?></a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
        </ul>
    </div>
</nav>

<div>

    <div class="jumbotron" id="padder">
        <h1><?php
            ini_set('max_execution_time', 300);
            exec("java -jar target/Tracert-0.0.1-SNAPSHOT-jar-with-dependencies.jar google.com", $output);
            ?></h1>
        <h1><?php foreach ($output as $result) {
                echo $result;
                echo "<br>";
            }  ?></h1>
    </div>

</div>


<div class="container">
    <div class="center">&copy <?php echo date("Y"); ?> Jack Ferguson</div>
</div>

</body>

<script src="js/mainJack.js"></script>

</html>
