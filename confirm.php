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
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="choose.php">Phoodie</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="cart.php">My Cart</a></li>
                    <li><a href="choose.php">Find Food</a></li>
                    <li><a href="account.php">My Account</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div id="body" class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <p><span class="page-logo glyphicon glyphicon-shopping-cart"></span></p>
                <hr />
                <div id="confirm-success" class="alert alert-success messages" role="alert">
                    <p class="text-center"><span id="confirm-success-message"></span></p>
                </div>
                <div id="confirm-fail" class="alert alert-danger messages" role="alert">
                    <p class="text-center"><span id="confirm-fail-message"></span></p>
                </div>


                <form id="confirm-form" action="">
                    <h3>Delivery Address</h3>
                    <div class="radio">
                        <label>
                            <input type="radio" name="address_select" id="address_select_default" value="1" checked>
                            Use default address<br />
                            <div id="confirm-default-address" class="well"></div>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="address_select" id="address_select_temp" value="0">
                            Use one-time address<br />
                            <div id="temp-address-form">
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
                            </div>
                        </label>
                    </div>

                    <hr />

                    <h3>Delivery Address</h3>
                    <div class="radio">
                        <label>
                            <input type="radio" name="cc_select" id="cc_select_default" value="1" checked>
                            Use default payment method<br />
                            <div id="confirm-default-cc" class="well"></div>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="cc_select" id="cc_select_temp" value="0">
                            Use one-time payment method<br />
                            <div id="temp-cc-form">
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
                            </div>
                        </label>
                    </div>

                    <hr />

                    <div class="row">
                        <div class="col-xs-12">
                            <h3>Totals</h3>
                            <strong>Subtotal:</strong> <span id="cart-subtotal"></span><br />
                            <strong>Delivery Fee:</strong> <span id="cart-deliveryfee"></span><br />
                            <strong>Total: </strong> <span id="cart-total"></span>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <p class="text-center"><a href="#" id="purchase-button" class="btn btn-lg btn-danger">Confirm Purchase</a></p>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        loadCheckoutInfo();
    </script>
    
</body>
</html>