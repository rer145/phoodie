<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
        
        <title>Foodie</title>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-3 text-left">
                        <!-- <span class="glyphicon glyphicon-user"></span> -->
                    </div>
                    <div class="col-xs-6 text-center">
                        <span id="logo-small"><a href="index.html">Foodie</a></span>
                    </div>
                    <div class="col-xs-3 text-right">
                        <!-- <span class="glyphicon glyphicon-user"></span> -->
                    </div>
                </div>
            </div>
        </nav>
        
        <div id="body" class="container-fluid">
            <div class="row">
                <div class="col-xs-12">

                    <div id="signup-error" class="messages">
                        <div class="alert alert-danger" role="alert">
                            <p><span id="error-message"></span></p>
                        </div>
                    </div>
                    
                    <form id="signup" action="">
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

                </div>
            </div>
        </div>
        
    </body>
</html>