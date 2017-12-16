<?php 

    include_once('models/foodie.php');
    include_once('models/food.php');
    include_once('models/cart.php');
    include_once('models/cartitem.php');
    include_once('models/err.php');

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
        // try {
        //     //vars
        //     //save current cart id in session
        //     //update other fields later

        //     $stmt = $this->connection->prepare('
        //         INSERT INTO cart (name, franchise_id, sequence_no)
        //         VALUES (:name, :franchise_id, :sequence_no)
        //     ');
        //     $stmt->bindParam(':name', $class->name);
        //     $stmt->bindParam(':franchise_id', $class->franchise_id);
        //     $stmt->bindParam(':sequence_no', $class->sequence_no);
        //     $stmt->execute();

        //     $id = $this->connection->lastInsertId();
        //     return $this->get($id);
        // } catch (Exception $err) {
        //     echo $err->getMessage();
        // }
    }

    if ($method == 'validate_user') {
        try {
            $email = $_GET["email"];
            $password = $_GET["password"];

            $stmt = $conn->prepare('
                SELECT * FROM foodie WHERE email = :email AND password = :password
            ');
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Foodie');
            $foodie = $stmt->fetchAll();

            if (count($foodie) > 0) {
                if (count($foodie) > 1) {
                    $err = new Err;
                    $err->code = 1;
                    $err->message = "Too many records returned";
                    echo json_encode($err);
                } else {
                    $_SESSION["user_id"] = $foodie[0]->id;
                    echo json_encode($foodie[0]);
                }
            } else {
                $err = new Err;
                $err->code = 2;
                $err->message = "Invalid user. Please try again.";
                echo json_encode($err);
            }
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    if ($method == 'register_user') {
        try {
            $email = $_GET["email"];
            $password = $_GET["password"];

            $stmt = $conn->prepare('
                SELECT * FROM foodie WHERE email = :email
            ');
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Foodie');
            $foodie = $stmt->fetchAll();

            if (count($foodie) > 0) {
                $err = new Err;
                $err->code = 1;
                $err->message = "User already exists";
                echo json_encode($err);
            } else {
                $stmt = $conn->prepare('
                    INSERT INTO foodie (email, password) VALUES (:email, :password)
                ');
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->execute();

                $id = $conn->lastInsertId();
                $stmt = $conn->prepare('
                    SELECT * FROM foodie WHERE id = :id
                ');
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Foodie');
                $foodie = $stmt->fetch();
                echo json_encode($foodie);
            }
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }