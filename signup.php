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
        <script src="https://www.gstatic.com/firebasejs/4.8.0/firebase.js"></script>
        <script src="js/app.js"></script>
        <script src="js/util.js"></script>
        
        <title>Phoodie</title>
    </head>
    <body id="page-signup">
        <div id="body" class="container-fluid">
            <div class="row">
                <div class="col-xs-12">

                    <p><img src="img/phoodielogo.jpg" class="img-responsive" /></p>

                    <p class="page-title text-center">
                        Sign Up
                    </p>

                    <div id="signup-error" class="messages">
                        <div class="alert alert-danger" role="alert">
                            <p><span id="error-message"></span></p>
                        </div>
                    </div>
                    
                    <form id="signup" action="">
                        <div class="form-group">
                            <label for="name_textbox">Name</label>
                            <input type="text" class="form-control" id="name_textbox" name="name_textbox" placeholder="Name" />
                        </div>
                        <div class="form-group">
                            <label for="email_textbox">Email</label>
                            <input type="email" class="form-control" id="email_textbox" name="email_textbox" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <label for="password_textbox">Password</label>
                            <input type="password" class="form-control" id="password_textbox" name="password_textbox" placeholder="Password" />
                        </div>
                        <a href="#" id="signup-button" class="btn btn-primary">Sign Up</a>
                    </form>

                    <p>&nbsp;</p>
                    
                    <p class="small">Already have an account? <a href="login.php">Login Now</a></p>

                </div>
            </div>
        </div>
        
    </body>
</html>