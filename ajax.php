<?php 
    session_start();

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
                    $_SESSION["user_email"] = $foodie[0]->email;
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
    
    if ($method == 'add_to_cart') {
        try {
            $id = $_GET["id"];
            $sid = session_id();

            //check if cart is started
            if (!isset($_SESSION["cart_id"])) {
                $stmt = $conn->prepare('
                    INSERT INTO cart (foodie_id, session_id, email)
                    VALUES (:foodie_id, :session_id, :email)
                ');
                $stmt->bindParam(':foodie_id', $_SESSION["user_id"]);
                $stmt->bindParam(':session_id', $sid);
                $stmt->bindParam(':email', $_SESSION["user_email"]);
                $stmt->execute();

                $id = $conn->lastInsertId();
                $_SESSION["cart_id"] = $id;
            }

            //add item to cart
            if (isset($_SESSION["cart_id"])) {
                //get food item
                $stmt = $conn->prepare('
                    SELECT * FROM food WHERE id = :id
                ');
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Food');
                $food = $stmt->fetch();


                $stmt = $conn->prepare('
                    INSERT INTO cartitem (cart_id, food_id, name, price)
                    VALUES (:cart_id, :food_id, :name, :price)
                ');
                $stmt->bindParam(':cart_id', $_SESSION["cart_id"]);
                $stmt->bindParam(':food_id', $food->id);
                $stmt->bindParam(':name', $food->name);
                $stmt->bindParam(':price', $food->price);
                $stmt->execute();

                $id = $conn->lastInsertId();
                $stmt = $conn->prepare('
                    SELECT * FROM cartitem WHERE id = :id
                ');
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'CartItem');
                $cart = $stmt->fetch();
            }
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    if ($method == 'get_cart') {
        try {
            if (isset($_SESSION["cart_id"])) {
                $stmt = $conn->prepare('
                    SELECT * FROM cart WHERE id = :id
                ');
                $stmt->bindParam(':id', $_SESSION["cart_id"]);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
                $cart = $stmt->fetch();
                
                //get food items
                $stmt = $conn->prepare('
                    SELECT * FROM cartitem WHERE cart_id = :id
                ');
                $stmt->bindParam(':id', $cart->id);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'CartItem');
                $items = $stmt->fetchAll();

                echo json_encode($items);
            }
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }