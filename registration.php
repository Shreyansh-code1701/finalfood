<?php
require_once 'conection.php';
?>

<?php
ob_start();
require_once 'PHPMailerAutoload.php';
if(isset($_REQUEST[send])) 
{
    $in = mysql_query("select * from registration") or trigger_error(mysql_error());
    while ($inn = mysql_fetch_array($in))
    {
        if (stristr($inn[0], $_REQUEST[userid])) 
        {
            $er = 1;
            break;
        }
    }
    
    if ($_REQUEST[password] != $_REQUEST[cpassword]){
        $er1 = 1;
    }

    $emailquery = "select * from user where email='$_REQUEST[email]'";
    $query = mysql_query($emailquery);

    $emailcount = mysql_num_rows($query);
    
    if($emailcount>0){
        $er2 = 1;
    }

    $mnquery = "select * from user where mobile='$_REQUEST[mobile]'";
    $query = mysql_query($mnquery);

    $mncount = mysql_num_rows($query);
    
    if($mncount>0){
        $er6 = 1;
    }

    // if ($_SESSION[cap] != $_REQUEST[capcha])
    // {
    //     $er2 = 1;
    // }
    
     if (strlen($_FILES[fileup][name]) > 0) 
     {
        $name = $_FILES[fileup][name];
        $ex = "." . substr($_FILES[fileup][type],6);

        if ($ex == ".png" || $ex == ".jpg" || $ex == ".jpeg" || $ex == ".PNG" || $ex == ".JPG" || $ex == ".JPEG") 
         {
            $siz = $_FILES[fileup][size] / 1024;
            $siz = $siz / 1024;
            if ($siz <= 10) 
            {
                $name = $_REQUEST[userid] . $ex;

                $path1 = "profile/" . $name;
                 $path2 = dirname(__FILE__) . "/" . $path1;
            } 
            else 
            {
                $er4 = 1;
            }
        }
        else 
        {
            $er3 = 1;
        }
    }
    
    // if ($er!=1 && $er1 != 1 && $er2 != 1 && $er3 != 1 && $er4 != 1)

     if ($er != 1 && $er1 != 1 && $er2!= 1 && $er6 != 1 && $er3 != 1 && $er4 != 1)
    {
        $date = date('Y-m-d');
        $time = date('h:i:s:a');
        
        $_SESSION[time] = $time;
        $_SESSION[date] = $date;
        
        $dtime=$_SESSION[date]. ":" . $_SESSION[time];
        $email=$_REQUEST[email];

        
        // $encrypted_pwd = md5($pwd);
        // $str = 'This is an encoded string';
        // $encrypted_pwd = base64_encode($pwd);
        // $encrypted_pwd = crypt($pwd, '$12$hrd$reer');
        $pwd = $_REQUEST['password'];
        $encrypted_pwd = base64_encode($pwd);


        // $length = 24;
        // $randomletter = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"), 0, $length);

        $email_encrypt = urlencode($email);
        $special_string = 'SuperSecretUser?';
        $hash = md5($email_encrypt.$special_string);

        $ins =mysql_query("insert into user values('$_REQUEST[name]','$_REQUEST[address]','$_REQUEST[gender]','$_REQUEST[state]','$_REQUEST[city]','$_REQUEST[area]','$_REQUEST[email]','$_REQUEST[mobile]','$_REQUEST[userid]','$encrypted_pwd','$_REQUEST[sque]','$_REQUEST[sans]','$path1','yes','$_REQUEST[sell]')");
        $ins2 =mysql_query("insert into login values('$_REQUEST[userid]','$encrypted_pwd','$dtime','$_REQUEST[sell]',0,'$hash',0)");
        $ins3 =mysql_query("insert into logintime values('$_REQUEST[userid]','$date','$time')");
        $ins4=mysql_query("insert into svubscriber values(0,'$_REQUEST[email]')");

        function sendmail($email,$sms,$subject)
        {
  
            $mail = new PHPMailer;

            $mail->isSMTP();

            $mail->SMTPDebug = 0;

            //Ask for HTML-friendly debug output
            $mail->Debugoutput = 'html';

            //Set the hostname of the mail server
            $mail->Host = 'smtp.gmail.com';

            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 587;

            //Set the encryption system to use - ssl (deprecated) or tls
            $mail->SMTPSecure = 'tls';

            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;

            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = "PUT_EMAIL";

            //Password to use for SMTP authentication
            $mail->Password = "PUT_PASSWORD";

            //Set who the message is to be sent from
            $mail->setFrom('PUT_EMAIL', 'Foodlocker');

            //Set an alternative reply-to address
            $mail->addReplyTo('PUT_EMAIL', 'Foodlocker');

            //Set who the message is to be sent to
            $mail->addAddress($email, 'Foodlocker');

            //Set the subject line
            $mail->Subject = $subject;

            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $message=$sms;
            $mail->msgHTML($message, dirname(__FILE__));

            //Replace the plain text body with one created manually
            $mail->AltBody = 'foodlocker';

            //Attach an image file
            //$mail->addAttachment('images/phpmailer_mini.png');

            //send the message, check for errors
            if (!$mail->send()) 
            {
                $done=1;
                echo "Mailer Error: " . $mail->ErrorInfo;
            } 
            else
            {
                $done=2;
                //echo "Message sent!";
            }
            //echo $done;
        }

        sendmail("$email","Welcome to FoodLocker<br>Click here to <a href=http://localhost/original/verify.php?email=$email&hash=$hash>verify</a> your account","Account Confirmation");

        move_uploaded_file($_FILES[fileup][tmp_name], $path2);
        
        $_SESSION[name]=$_REQUEST[name];
        $_SESSION[address]=$_REQUEST[address];
        $_SESSION[gen]=$_REQUEST[gender];
        $_SESSION[state]=$_REQUEST[state];
        $_SESSION[city]=$_REQUEST[city];
        $_SESSION[area]=$_REQUEST[area];
        $_SESSION[email]=$_REQUEST[email];
        $_SESSION[mobile]=$_REQUEST[mobile];
        $_SESSION[user] = $_REQUEST[userid];
        $_SESSION[type] = $_REQUEST[sell];
        $_SESSION[img] =$path2;
        
            if($_SESSION[type]!=1)
            {
              
                header("location:userprofile.php");
            }
            else
           {
                
               header("location:seller/seller.php");
           }
            
    }
    
}

?>

<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
    <script>
          // Function to check Whether both passwords
          // is same or not.
          function checkPassword(form) {
              password1 = form.password.value;
              password2 = form.cpassword.value;

              // If password not entered
              if (password1 == '')
                  alert ("Please enter Password");
                    
              // If confirm password not entered
              else if (password2 == '')
                  alert ("Please enter confirm password");
                    
              // If Not same return False.    
              else (password1 != password2) {
                  alert ("\nPassword did not match: Please try again...")
                  return false;
              }
          }
      </script>

    </head>
    <?php
    require_once 'head.php';
    ?>

    <body class="smooth-scroll" onload="cap(); ">

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
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center " >
                        <font style="font-size:30px;">Sign Up</font>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container " ><br/><br/>

                
                    <div class="row" >
                        
                         <div class="col-md-6 col-sm-12 col-xs-12 ht-widget hw-popular-categories" >
                            <h3 class="widget-title" style="font-size: 15px;">JOIN US NOW</h3>
                         </div>
                        
                        
                        
                        <div class="col-md-6 col-sm-12 col-xs-12 ht-widget hw-popular-categories" >
                            <h3 class="widget-title" style="font-size: 15px;">CREATE ACCOUNT</h3>
                            
                                
                                <form action="" onSubmit="return checkPassword(this)" method="post" name="registration" enctype="multipart/form-data" class="maru">

                                        <div class="form-group">
                                            <label for="sell" class="mylbm">Type</label>
                                            <div class="input-group">
                                                <input type="radio" name="sell" required="" checked="" value="2" />&nbsp;&nbsp;Member&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="sell" required="" value="1"/>&nbsp;&nbsp;Seller

                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="mylbm">Name</label>
                                            <div class="input-group">
                                                <input type="text" name="name" placeholder="Enter Your Full Name" style="padding: 15px;"  required=""  pattern='^[a-zA-Z ]+$'  class="form-control"/>
                                                <div class="input-group-addon regi">
                                                    <i class="#"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="mylbm">Address</label>
                                            <div class="input-group">
                                                <input type="text" name="address" placeholder="Enter Your Address" required="" style="padding: 15px;"  pattern='^[a-zA-Z0-9-/,. ]+$'  class=" form-control"/>
                                                <div class="input-group-addon regi">
                                                    <i class="#"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="mylbm">Gender</label>
                                            <div class="input-group">
                                                <input type="radio" name="gender" required="" checked="" value="Male" />&nbsp;&nbsp;Male&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="gender" required="" value="Female"/>&nbsp;&nbsp;Female

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="mylbm">State</label>
                                                    <div class="input-group">
                                                        <select  required="" name="state"   class="form-control" onchange="getcity('city',this.value);getcity('area', 0)">
                                                            <option value="">-Select  State-</option>
                                                            <?php
                                                            $state = mysql_query("select * from state where del=0");
                                                            while ($row = mysql_fetch_array($state)) {
                                                                ?>

                                                                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                                                                <?php
                                                            }
                                                            ?>

                                                        </select>
                                                        <div class="input-group-addon regi"><i class="#"></i></div>
                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <label class="mylbm">City</label>
                                                    <div class="input-group">
                                                        <select name="city" class="form-control" id="city" onchange="getcity('area',this.value);" >
                                                            <option>-Select City-</option>
                                                        </select>
                                                        <div class="input-group-addon regi"><i class="#"></i></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="mylbm">Area</label>
                                                    <div class="input-group">
                                                        <select name="area" class="form-control" id="area">
                                                            <option>-Select Area-</option>
                                                        </select>
                                                        <div class="input-group-addon regi"><i class="#"></i></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="mylbm">Email</label>
                                            <div class="input-group">
                                                <input type="email" name="email" placeholder="Enter Your Email" required="" style="padding: 15px;" class="form-control"/>
                                                <div class="input-group-addon regi">
                                                    <i class="#"></i>
                                                </div>
                                            </div>
                                            <?php
                                                if ($er2 == 1) {
                                                    echo "<font color=red size=2>Email already exists</font>";
                                                }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="mylbm">Mobile</label>
                                            <div class="input-group">
                                                <input type="tel" name="mobile" placeholder="Enter Your mobile number" style="padding: 15px;" maxlength="10" required="" pattern='^[0-9]+$' class="form-control"/>
                                                <div class="input-group-addon regi">
                                                    <i class="#"></i>
                                                </div>
                                            </div>
                                            <?php
                                                if ($er6 == 1) {
                                                    echo "<font color=red size=2>Mobile Number already exists</font>";
                                                }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="mylbm">User ID</label>
                                            <div class="input-group">
                                                <input type="text" name="userid" placeholder="Enter the User ID" required="" style="padding: 15px;" pattern='^[a-zA-Z0-9@-_ ]+$' class="form-control"/>
                                                <div class="input-group-addon regi">
                                                    <i class="#"></i>
                                                </div>
                                            </div>
                                            <?php
                                                if ($er1 == 1) {
                                                    echo "<font color=red size=2>Username is not available.</font>";
                                                }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="mylbm">Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" placeholder="Create Your Password" id="pass" required="" pattern='^[a-zA-Z0-9-,/?()*&%$#! ]{5,20}+$' class="form-control"/>
                                                <div class="input-group-addon regi" id="sw" style="cursor:pointer;">
                                                    <i class="#" id="sw" style="cursor:pointer;"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="mylbm">Conform Password</label>
                                            <div class="input-group">
                                                <input type="password" name="cpassword" id="cpass" placeholder="Confirm Your Password" style="padding: 15px;" pattern='^[a-zA-Z0-9-,/?()*&%$#! ]{5,20}+$' class="form-control"/>
                                                <div class="input-group-addon regi" id="csw" style="cursor:pointer;">
                                                    <i class="#" id="csw" style="cursor:pointer;"></i>
                                                </div>
                                            </div>
                                            <?php
                                            if ($er1== 1) {
                                                echo '<font color=red size=2>not match..!</font>';
                                            }
                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <label class="mylbm">Secure Question </label>
                                            <div class="input-group">
                                                <select name="sque"  >
                                                    <option>-Secure Question -</option>
                                                    <option>What is your favorite color ?</option>
                                                    <option>What was the make and model of your first car ?</option>
                                                    <option>What was the name of elementary / primary school ?</option>
                                                    <option>What is your pets name ?</option>
                                                    <option>In what country where you born ?</option>
                                                    <option>What is your favorite food ?</option>
                                                </select>
                                                <div class="input-group-addon regi">
                                                    <i class="#"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="mylbm">-Secure Answer-</label>
                                            <div class="input-group">
                                                <input type="text" name="sans" placeholder="Secure Answer" required="" pattern='^[a-zA-Z ]+$'  class="form-control"/>
                                                <div class="input-group-addon regi">
                                                    <i class="#"></i>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="mylbm">Choose Your Profile</label>
                                            <div class="input-group">

                                                <input type="file" name="fileup" class="form-control" required="" accept=".png, .jpg, .jpeg"/>
                                                <?php
                                                    if ($er3 == 1)
                                                    {
                                                        echo "<font style=color:red;font-size:12;>Invalid Profile</font>";
                                                    }
                                                    if ($er4 == 1)
                                                    {
                                                        echo "<font style=color:red;font-size:12;>Maximum 5 MB Allow</font>";
                                                    }
                                                ?>

                                            </div>
                                        </div>
                                       
                                        <!-- <div class="row">
                                            <div class="col-md-5">
                                                <div  style="background-image: url(images/capchaimage1.jpg);background-repeat: no-repeat;padding:1px;color:#fff;" name="dekocapcha" id="capcha">
                                                </div>

                                            </div>
                                            <div class="col-md-1 text-center" style="padding-top: 13px; margin-left: -3%;">
                                                <i class="fa fa-rotate-right refreshbtn"  onclick="cap();" ></i>
                                            </div>
                                            <div class="col-md-6" >
                                                <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" placeholder="Enter CAPTCHA" name="captcha" required="" pattern="^[a-zA-Z0-9]+$" style="padding: 20px;" />
                                                <div class="input-group-addon regi">
                                                    <i class="#"></i>
                                                </div>
                                            </div>
                                        </div>
                                                
                                                <?php
                                                if ($er2 == 1) {
                                                    echo '<font color=red size=2>CAPTCHA is Case Sensitive</font>';
                                                }
                                                ?>
                                            </div>


                                        </div> -->

                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="checkbox" name="agree" title="Terms & Conditions" required/>&nbsp;&nbsp;<font>Agree Term & Condition</font>
                                            </div>
                                        </div>

                                        <div class="co-md-12 text-center" >
                                            <button type="submit" name="send" class="btn sendbtn" style="outline: 0;">Submit</button>
                                            <button type="reset" class="btn sendbtn" style="outline: 0;">Reset</button>
                                        </div>
                                </form>
                            
                    </div>
                     
            </div>

        </div>



        <?php
        require_once 'footer.php';
        ?>

    </div>


</body>


</html>