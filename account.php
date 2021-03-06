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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
        <link rel="stylesheet" href="css/main.css" />

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
        <script src="js/app.js"></script>
        <script src="js/util.js"></script>

        <title>Phoodie</title>
    </head>
    <body>
        <?php include_once('nav.php'); ?>
        
        <div id="body" class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    
                    <h3>Default Address</h3>

                    <div id="address-success" class="alert alert-success messages" role="alert">
                        <p class="text-center">The address was successfully updated.</p>
                    </div>

                    <form id="address-form" action="">
                        <div class="form-group">
                            <label for="address1_textbox">Address</label>
                            <input type="textbox" class="form-control" id="address1_textbox" name="address1_textbox" placeholder="Address 1" /><br />
                            <input type="textbox" class="form-control" id="address2_textbox" name="address2_textbox" placeholder="Address 2" />
                        </div>
                        <div class="form-group">
                            <label for="city_textbox">City</label>
                            <input type="textbox" class="form-control" id="city_textbox" name="city_textbox" placeholder="City" />
                        </div>
                        <div class="form-group">
                            <label for="state_dropdown">State</label>
                            <select id="state_dropdown" class="form-control" name="state_dropdown">
                                <option value="">-- Choose a State --</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="OH">Ohio</option>
                                <option value="NY">New York</option>
                                <option value="CA">California</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="zip_textbox">Postal Code</label>
                            <input type="textbox" class="form-control" id="zip_textbox" name="zip_textbox" placeholder="Postal Code" />
                        </div>
                        <div class="form-group">
                            <label for="phone_textbox">Phone Number</label>
                            <input type="textbox" class="form-control" id="phone_textbox" name="phone_textbox" placeholder="Phone Number" />
                        </div>

                        <a href="#" id="address-button" class="btn btn-primary">Save Default Address</a>
                    </form>

                    <hr />

                    <h3>Default Payment Method</h3>

                    <div id="cc-success" class="alert alert-success messages" role="alert">
                        <p class="text-center">The payment method was successfully updated.</p>
                    </div>

                    <form id="cc-form" action="">
                        <div class="form-group">
                            <label for="ccname_textbox">Name on Card</label>
                            <input type="textbox" class="form-control" id="ccname_textbox" name="ccname_textbox" placeholder="Name on Card" />
                        </div>
                        <div class="form-group">
                            <label for="ccnumber_textbox">CC Number</label>
                            <input type="textbox" class="form-control" id="ccnumber_textbox" name="ccnumber_textbox" maxlength="16" placeholder="CC Number" />
                        </div>
                        <div class="form-group">
                            <label for="ccnumber_textbox">CVV</label>
                            <input type="textbox" class="form-control" id="cccvv_textbox" name="cccvv_textbox" maxlength="4" placeholder="CVV" />
                        </div>
                        <div class="form-group">
                            <label for="ccexpmo_textbox">CC Expiration Month</label>
                            <input type="textbox" class="form-control" id="ccexpmo_textbox" name="ccexpmo_textbox" maxlength="2" placeholder="Mo" />
                        </div>
                        <div class="form-group">
                            <label for="ccexpyr_textbox">CC Expiration Year</label>
                            <input type="textbox" class="form-control" id="ccexpyr_textbox" name="ccexpyr_textbox" maxlength="4" placeholder="Year" />
                        </div>
                        <div class="form-group">
                            <label for="cczip_textbox">CC Postal Code</label>
                            <input type="textbox" class="form-control" id="cczip_textbox" name="cczip_textbox" maxlength="10" placeholder="CC Postal Code" />
                        </div>

                        <a href="#" id="cc-button" class="btn btn-primary">Save Default Payment Method</a>
                    </form>

                </div>
            </div>
        </div>

        <script type="text/javascript">
            loadAccountInfo();
        </script>
    </body>
</html>