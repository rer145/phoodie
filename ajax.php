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

    if ($method == 'get_food_info') {
        try {
            $id = $_GET["id"];

            $stmt = $conn->prepare('
                SELECT *
                FROM food
                WHERE id = :id
            ');
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Food');
            $food = $stmt->fetch();

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
            $name = $_GET["name"];
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
                    INSERT INTO foodie (name, email, password) VALUES (:name, :email, :password)
                ');
                $stmt->bindParam(':name', $name);
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

                $_SESSION["user_id"] = $id;
                $_SESSION["user_email"] = $foodie->email;
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

                $cid = $conn->lastInsertId();
                $_SESSION["cart_id"] = $cid;
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

                //check if item already exists in cart, and update quantity?
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

            echo '{}';
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    if ($method == 'remove_from_cart') {
        try {
            $id = $_GET["id"];
            $sid = session_id();

            //check if cart is started
            if (isset($_SESSION["cart_id"])) {
                $stmt = $conn->prepare('
                    DELETE FROM cartitem WHERE id = :id
                ');
                $stmt->bindParam(':id', $id);
                $stmt->execute();
            }

            echo '{}';
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
            } else {
                echo '{}';
            }
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    if ($method == 'get_address') {
        try {
            $id = $_SESSION["user_id"];

            $stmt = $conn->prepare('
                SELECT * FROM foodie WHERE id = :id
            ');
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Foodie');
            $foodie = $stmt->fetch();

            if (count($foodie) > 0) {
                if (isset($foodie->default_address1)) {
                    //continue
                } else {
                    //go to account to set
                }
            } else {
                $err = new Err;
                $err->code = 2;
                $err->message = "Invalid user. Please logout and try again..";
                echo json_encode($err);
            }
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    if ($method == 'get_account') {
        try {
            $id = $_SESSION["user_id"];

            $stmt = $conn->prepare('
                SELECT * FROM foodie WHERE id = :id
            ');
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Foodie');
            $foodie = $stmt->fetch();

            if (count($foodie) > 0) {
                echo json_encode($foodie);
            } else {
                $err = new Err;
                $err->code = 2;
                $err->message = "Invalid user. Please logout and try again..";
                echo json_encode($err);
            }
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    if ($method == 'update_address') {
        try {
            $id = $_SESSION["user_id"];
            $address1 = $_GET["address1"];
            $address2 = $_GET["address2"];
            $city = $_GET["city"];
            $state = $_GET["state"];
            $zip = $_GET["zip"];
            $phone = $_GET["phone"];

            $stmt = $conn->prepare('
                SELECT * FROM foodie WHERE id = :id
            ');
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Foodie');
            $foodie = $stmt->fetch();

            if (count($foodie) > 0) {
                $stmt = $conn->prepare('
                    UPDATE foodie SET
                        default_address1 = :address1,
                        default_address2 = :address2,
                        default_city= :city,
                        default_state = :state,
                        default_zip = :zip,
                        default_phone = :phone
                    WHERE id = :id
                ');
                $stmt->bindParam(':address1', $address1);
                $stmt->bindParam(':address2', $address2);
                $stmt->bindParam(':city', $city);
                $stmt->bindParam(':state', $state);
                $stmt->bindParam(':zip', $zip);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                echo '{}';
            } else {
                $err = new Err;
                $err->code = 2;
                $err->message = "Invalid user. Please logout and try again..";
                echo json_encode($err);
            }
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    if ($method == 'update_cc') {
        try {
            $id = $_SESSION["user_id"];
            $name = $_GET["name"];
            $number = $_GET["number"];
            $cvv = $_GET["cvv"];
            $expmo = $_GET["expmo"];
            $expyr = $_GET["expyr"];
            $zip = $_GET["zip"];

            $stmt = $conn->prepare('
                SELECT * FROM foodie WHERE id = :id
            ');
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Foodie');
            $foodie = $stmt->fetch();

            if (count($foodie) > 0) {
                $stmt = $conn->prepare('
                    UPDATE foodie SET
                        default_cc_name = :name,
                        default_cc_number = :number,
                        default_cc_cvv = :cvv,
                        default_cc_exp_mo = :expmo,
                        default_cc_exp_yr = :expyr,
                        default_cc_zip = :zip
                    WHERE id = :id
                ');
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':number', $number);
                $stmt->bindParam(':cvv', $cvv);
                $stmt->bindParam(':expmo', $expmo);
                $stmt->bindParam(':expyr', $expyr);
                $stmt->bindParam(':zip', $zip);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                echo '{}';

                $_SESSION["cart_id"] = '';
            } else {
                $err = new Err;
                $err->code = 2;
                $err->message = "Invalid user. Please logout and try again..";
                echo json_encode($err);
            }
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    if ($method == 'complete_purchase') {
        try {
            $cart_id = $_SESSION["cart_id"];

            $stmt = $conn->prepare('
                UPDATE cart SET
                    order_completed = 1
                WHERE id = :cart_id
            ');
            $stmt->bindParam(':cart_id', $cart_id);
            $stmt->execute();

            $_SESSION["cart_id"];

            echo '{}';
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }