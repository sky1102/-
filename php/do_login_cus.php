<?php
require('config2.php');

$email = $_POST['email'];
$password = $_POST['password'];
$refer = $_POST['refer'];

if ($email == '' || $password == '')
{
    // No login information
    header('Location: login.php?refer='. urlencode($_POST['refer']));
}
else
{
    // Authenticate user
    $con = mysqli_connect($db_host, $db_user, $db_pass);
    mysqli_select_db($con, $db_name);
    
    $query = "SELECT cus_ID FROM customer WHERE cus_email = '$email' AND cus_password = '$password'";
        
    $result = mysqli_query($con, $query)
    	or die ('Error in query');
    
    if (mysqli_num_rows($result))
    {
        $row = mysqli_fetch_row($result);
        // Update the user record
        // $query = "UPDATE customer SET guid = '$row[1]' WHERE cus_ID = $row[0]";
            
        mysqli_query($con, $query)
        	or die('Error in query');
        
        setcookie('cookie_id',$row[0]);

        if (empty($refer) || !$refer)
        {
            $refer = 'shop_cus.php';
        }

        header('Location: '. $refer);
    }
    else
    {
        // Not authenticated
        echo "<script language='javascript'>alert('帳號或密碼輸入錯誤!'); window.history.back(-1);</script>";    }
}
?>