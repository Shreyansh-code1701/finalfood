<?php
require_once 'connection.php';
$_SESSION[page] = "about";
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<?php
require_once 'head.php';
?>

<body class="smooth-scroll">

    <div class="ht-page-wrapper">
        <?php
        require_once 'toppati.php';
        ?>

        <?php
        require_once 'menu.php';
        ?>
        <div class="ht-page-header" style="background-image: url('images/parallax/2.jpg')">
            <div class="overlay" style="background: rgba(0,0,0,.5)"></div>
            <div class="container">
                <div class="inner">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center ">
                        <font style="font-size:30px;">Who are we?</font>
                    </div>

                </div>
            </div>
        </div>
        <div class="container "><BR></br>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <img src="images/about.png" style="text-align: center;" class="img img-responsive" />
                    </div>
                </div>
                <div class="col-md-12col-sm-12 col-xs-12 text-center">

                <p style="font-size: 30px; font-weight: 600;">What is FOOD LOCKER?</p></p><br>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 text-center ">
                    <p style="font-size: 17px;"> Foodlocker is India's most convenient online food ordering site. It's connects people with the best restaurants<br>
                        around them. Delivering in Delhi, Bangalore, Chennai, Mumbai, Hyderabad and over 100 other cities.<br>
                        Foodlocker has the widest reach in India.<br>
                        We believe food is a pleasure and food ordering should be fast and definitely a fun experience. Ordering<br>
                        with Foodlocker is as easy as a 4-step recipe. </p>
                </div>
                <div class="row" style="margin-top: 25%;">
                    <div class="col-md-3 col-sm-12 col-xs-12 text-center ">
                        <div class="aboutborder">
                            <div><i class="fa fa-map-marker aboutimg" style="font-size: 50px; "></i></div>
                            <div class="aboutdes"> 1.Search</div>
                            <p style="font-size: 18px;">Find restaurants that deliver to you by entering your address</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                        <div class="aboutborder">
                            <div><i class="fa fa-cutlery aboutimg" style="font-size: 50px; "></i></div>
                            <div class=" aboutdes "> 2. Choose</div>
                            <p style="font-size: 18px;">Browse hundreds of menus to find the food you like</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 text-center">
                        <div class="aboutborder">
                            <div><i class="fa fa-money aboutimg" style="font-size: 50px;"></i></div>
                            <div class="aboutdes"> 3. Pay</div>
                            <p style="font-size: 18px;"> Pay fast & secure online with credit card or simply with cash on delivery</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 text-center ">
                        <div class="aboutborder">
                            <div><i class="fa fa-truck aboutimg" style="font-size: 50px; "></i></div>
                            <div class="aboutdes"> 4. Enjoy </div>
                            <p style="font-size: 18px;"> Food is prepared & delivered to your door-step.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-top: 5%; border-bottom: 1px solid #f8a631;">
                    <i class="fa fa-hand-o-right"></i>&nbsp;&nbsp;<font style="font-size: 15px; font-weight: 600; ">On your mobile, tablet, desktop, foodlocker is a delicious experience. Just try and see for yourselves.</font>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center" style="margin-top: 5%;">
                    <h2 class="restaurant-section" style=""> A selection of top restaurants</h2>
                    <div class="restaurant-logos text-center">
                        <img alt="Ammi&#39;s Biryani" class="imgbw" src="images/restaurantlogo/box8.png" title="Box8" />
                        <img alt="BOX8" class="imgbw" src="images/restaurantlogo/dominos.png" title="dominos" />
                        <img alt="Domino&#39;s Pizza" class="imgbw" src="images/restaurantlogo/pandahead.png" title="Pandahead" />
                        <img alt="Pizza Hut" class="imgbw" src="images/restaurantlogo/pioneer.jpg" title="Pioneer" />
                        <img alt="Subway" class="imgbw" src="images/restaurantlogo/pizzahut.png" title="pizzahut" />
                        <img alt="Subway" class="imgbw" src="images/restaurantlogo/subway.jpg" title="Subway" />


                    </div>
                </div>
            </div>
        </div><br>





        <?php
        require_once 'footer.php';
        ?>

    </div>


</body>


</html>