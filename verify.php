<?php
    require_once 'conection.php';

    if(isset($_GET[email]) && isset($_GET[hash]))
    {
        $quuery=mysql_query("select * from login where 'verification_code'='$_GET[hash]';") or trigger_error(mysql_error());
        // $result=mysql_query($quuery);
        $update=mysql_query("UPDATE login SET `is_verified`='1' WHERE `verification_code`='$_GET[hash]';") or trigger_error(mysql_error());
        
        echo"
        <script>
            alert('Success');
            window.location.href='index.php';
        </script>
        ";
    }
    else{
        echo"
        <script>
            alert('Server Down');
            window.location.href='index.php';
        </script>
        ";
    }
?>