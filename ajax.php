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

    if ($method == 'add_to_cart') {
        try {
            //vars
            //save current cart id in session
            //update other fields later

            $stmt = $this->connection->prepare('
                INSERT INTO cart (name, franchise_id, sequence_no)
                VALUES (:name, :franchise_id, :sequence_no)
            ');
            $stmt->bindParam(':name', $class->name);
            $stmt->bindParam(':franchise_id', $class->franchise_id);
            $stmt->bindParam(':sequence_no', $class->sequence_no);
            $stmt->execute();

            $id = $this->connection->lastInsertId();
            return $this->get($id);
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }