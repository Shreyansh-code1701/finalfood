
<?php
require_once 'connection.php';
require_once 'sellersecure.php';

$pr=mysql_query("select * from user where userid like '$_SESSION[user]'");
$prr=mysql_fetch_array($pr);
$oldpath=$prr[12];

if (isset($_REQUEST[send])) 
    {
    
    if (strlen($_FILES[updatepic][name]) > 0) 
     {
        unlink($oldpath);
        $name = $_FILES[updatepic][name];
        $ex = "." . substr($_FILES[updatepic][type], 6);

        if ($ex == ".png" || $ex == ".jpg" || $ex == ".jpeg" || $ex == ".PNG" || $ex == ".JPG" || $ex == ".JPEG") 
         {
            $siz = $_FILES[updatepic][size] / 1024;
            $siz = $siz / 1024;
            if ($siz <= 10) 
            {
                $name = $_SESSION[user] . $ex;
                $path1 ="profile/" . $name;
                 $oldpath=$path1;
                $path2 = substr(dirname(__FILE__), 0,20) .  $oldpath;
               
        
            } 
           
        }
      
           
       move_uploaded_file($_FILES[updatepic][tmp_name], $path2);
    }
  $up = mysql_query("update user set username='$_REQUEST[name]',address='$_REQUEST[address]',gender='$_REQUEST[gender]',state='$_REQUEST[state]',city='$_REQUEST[city]',area='$_REQUEST[area]',email='$_REQUEST[email]',mobile='$_REQUEST[mobile]',password='$_REQUEST[password]',sque='$_REQUEST[sqq]',sans='$_REQUEST[sqa]',url='$oldpath' where userid like '$_SESSION[user]' ");
$upp=mysql_query("update login set password='$_REQUEST[password]' where userid like '$_SESSION[user]'");
    header("location:seller.php");  
}
?>


<!DOCTYPE html>
<html lang="en">

    <?php
    require_once 'head.php';
    ?>

    <body class="sticky-header" onload="picc('0');">

        <section>
            <?php
            require_once 'menu.php';
            ?>

            <div class="main-content" >

                <?php
                require_once 'toppati.php';
                require_once 'sellerpati.php';
                ?>

                <div class="wrapper">

                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="profile"> EDIT SELLER PROFILE</h5>
                            <div class="panel">
                                <div class="panel-body">
                                    <form action="" method="post" enctype="multipart/form-data">

                                        <div class="sellerprofile-pic text-center " style="padding: 10px;">
                                            <div class="sellerprofile-pic text-center uppic"style="position:absolute" >
                                                <input type="file" name="updatepic"class="dpcont" style="width:91%;" onchange="picc(this);" />
                                            </div>
                                            <?php
                                            $in = mysql_query("select * from user where userid like '$_SESSION[user]' ");
                                            $inn = mysql_fetch_array($in);
                                            ?>
                                            <img class="img-rsponsive " id="pic" src="../<?php echo $inn[12]; ?>"  />
                                           <img class="img-rsponsive " id="pic1" src=""  />
                                        </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="col-md-12">
                                <h5 class="profile"> EDIT SELLER INFORMATION</h5>
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="name" autofocus="" required="" value="<?php echo $inn[0]; ?>" pattern="^[a-zA-Z@_- ]+$"/>
                                                <div class="input-group-addon">
                                                    <i  class="fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label>Address</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="address" required="" value="<?php echo $inn[1]; ?>" pattern="^[a-zA-Z,/_- ]+$"/>
                                                <div class="input-group-addon">
                                                    <i  class="fa fa-home"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="gender" required="" value="<?php echo $inn[2]; ?>" pattern="^[a-zA-Z ]+$"/>
                                                <div class="input-group-addon" >
                                                    <i  class="fa fa-male" style="font-size:20px;"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Select State</label>
                                            <div class="input-group">
                                                <select name="state" class="form-control" required="" >
                                                    <?php
                                                    $get = mysql_query("select * from state  where del=0  ");
                                                    while ($row = mysql_fetch_array($get)) {
                                                        if($inn[3]==$row[0])
                                                        {
                                                        ?>
                                                    <option value="<?php echo $row[0]; ?>" selected="" style="text-transform: capitalize;"><?php echo $row[1]; ?></option>
                                                        
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                         <option value="<?php echo $row[0]; ?>"  style="text-transform: capitalize;"><?php echo $row[1]; ?></option>
                                                        <?php
                                                    }
                                                    }
                                                    ?>
                                                </select>
                                                <div class="input-group-addon">
                                                    <i  class="fa fa-globe"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Select City</label>
                                            <div class="input-group">
                                                <select name="city" class="form-control" required="">
                                                    <?php
                                                    $get = mysql_query("select * from city  where del=0 and stateid='$inn[3]' ");
                                                    while ($row = mysql_fetch_array($get)) {
                                                        if($inn[4]==$row[1])
                                                        {
                                                        ?>
                                                    <option value="<?php echo $row[1]; ?>" selected=""  style="text-transform: capitalize;"><?php echo $row[2]; ?></option>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                        <option value="<?php echo $row[1]; ?>"  style="text-transform: capitalize;"><?php echo $row[2]; ?></option>
                                                    <?php
                                                    }
                                                    }
                                                    ?>
                                                </select>
                                                <div class="input-group-addon">
                                                    <i  class="fa fa-globe"></i>
                                                </div>
                                            </div>
                                        </div>

                                     <div class="form-group">
                                            <label>Select Area</label>
                                            <div class="input-group">
                                                <select name="area" class="form-control" required="">
                                                    <?php
                                                    $get = mysql_query("select * from area  where del=0 and cityid='$inn[4]' ");
                                                    while ($row = mysql_fetch_array($get)) {
                                                        if($inn[5]==$row[1])
                                                        {
                                                        ?>
                                                    <option value="<?php echo $row[1]; ?>" selected=""  style="text-transform: capitalize;"><?php echo $row[2]; ?></option>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                        <option value="<?php echo $row[1]; ?>"  style="text-transform: capitalize;"><?php echo $row[2]; ?></option>
                                                    <?php
                                                    }
                                                    }
                                                    ?>
                                                </select>
                                                <div class="input-group-addon">
                                                    <i  class="fa fa-globe"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <div class="input-group">
                                                <input type="email" class="form-control" name="email" required="" value="<?php echo $inn[6]; ?>"/>
                                                <div class="input-group-addon">
                                                    <i  class="fa fa-envelope"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="mobile" required="" maxlength="10" value="<?php echo $inn[7]; ?>" pattern="^[0-9]{10}+$"/>
                                                <div class="input-group-addon">
                                                    <i  class="fa fa-phone"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="password" id="password" required="" value="<?php echo $inn[9]; ?>" pattern="^[0-9a-z@/.,+_ ]{20}+$"/>
                                                <div class="input-group-addon" id="showpass" style="cursor: pointer;">
                                                    <i  class="fa fa-lock" id="showpass" title="showpass" style="cursor: pointer;"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Security Question</label>
                                            <div class="input-group">
                                                <select name="sqq" class="form-control" required="" >
                                                    <?php
                                                    
                                                        if ($inn[10]=="What is your favorite color ?")
                                                        {
                                                        ?>
                                                    <option  selected=""  style="text-transform: capitalize;"><?php echo $inn[10]; ?></option>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                    <option>What is your favorite color ?</option>
                                                    <?php
                                                    }
                                                     if ($inn[10]=="What was the make and model of your first car ?")
                                                        {
                                                        ?>
                                                    <option  selected=""  style="text-transform: capitalize;"><?php echo $inn[10]; ?></option>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                    <option>What was the make and model of your first car ?</option>
                                                    <?php
                                                    }
                                                    
                                                     if ($inn[10]=="What was the name of elementary / primary school ?")
                                                        {
                                                        ?>
                                                    <option  selected=""  style="text-transform: capitalize;"><?php echo $inn[10]; ?></option>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                    <option>What was the name of elementary / primary school ?</option>
                                                    <?php
                                                    }
                                                    if ($inn[10]=="What is your pets name ?")
                                                        {
                                                        ?>
                                                    <option  selected=""  style="text-transform: capitalize;"><?php echo $inn[10]; ?></option>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                    <option>What is your pets name ?</option>
                                                    <?php
                                                    }
                                                    
                                                    if ($inn[10]=="In what country where you born ?")
                                                        {
                                                        ?>
                                                    <option  selected=""  style="text-transform: capitalize;"><?php echo $inn[10]; ?></option>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                    <option>In what country where you born ?</option>
                                                    <?php
                                                    }
                                                     if ($inn[10]=='What is your favorite food ?')
                                                        {
                                                        ?>
                                                    <option  selected=""  style="text-transform: capitalize;"><?php echo $inn[10]; ?></option>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                    <option>What is your favorite food ?</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <div class="input-group-addon">
                                                    <i  class="fa fa-globe"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Security Answer</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="sqa" required=""  value="<?php echo $inn[11]; ?>" pattern="^[a-z]+$"/>
                                                <div class="input-group-addon">
                                                    <i  class="fa fa-phone"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <button type="submit" name="send" class="btn btn-primary">EDIT</button>
                                        </div>
                                    </div>
                                </div>
                            </div>     
                        </div>
                        </form>
                    </div>
                </div>
                <div style="margin-top: 16%;">
                    <?php
                    require_once 'footer.php';
                    ?>
                </div>
        </section>


        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="js/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/jquery.nicescroll.js"></script>


        <script src="js/sparkline/jquery.sparkline.js"></script>
        <script src="js/sparkline/sparkline-init.js"></script>


        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;AMP;sensor=false"></script>



        <script src="js/scripts.js"></script>

        

    </body>


</html>
