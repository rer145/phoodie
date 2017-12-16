<?php 

    include_once('models/food.php');

    $db_host = "mysql5006.site4now.net";
    $db_username = "9bc3ef_foodie";
    $db_password = "foodie123";
    $db_name = "db_9bc3ef_foodie";

    $conn = new PDO(
        'mysql:host='. $db_host . ';dbname=' . $db_name,
        $db_username,
        $db_password
    );

    $conn->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );


    $method = $_GET['method'];
    
    if ($method == 'get_food') {
        try {
            $stmt = $conn->prepare('
                SELECT *
                FROM food
            ');
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Food');
            $food = $stmt->fetchAll();

            echo json_encode($food);
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }