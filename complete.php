<?php
    //session_start();
    include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include_once('head.php'); ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main.css" />

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/util.js"></script>
    <script src="js/app.js"></script>
    
    <title>Phoodie</title>
</head>
<body>
    <?php include_once('nav.php'); ?>
    
    <div id="body" class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h2>Your order is completed!</h2>
                <p>Your order will be delivered by <span id="confirm-delivery-date"></span></p>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        loadConfirmation();
    </script>
    
</body>
</html>