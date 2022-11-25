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
    
    $query = "SELECT com_ID FROM company WHERE com_email = '$email' AND com_password = '$password'";
        
    $result = mysqli_query($con, $query)
    	or die ('Error in query');
    
    if (mysqli_num_rows($result))
    {
        $row = mysqli_fetch_row($result);
            
        // mysqli_query($con, $query)
        // 	or die('Error in query');

        setcookie('cookie_id',$row[0]);


        if (empty($refer) || !$refer)
        {
            $refer = 'shop_com.php?>';
        }

        header('Location: '. $refer);
    }
    else
    {
        // Not authenticated
        echo "<script language='javascript'>alert('帳號或密碼輸入錯誤!'); window.history.back(-1);</script>";
    }
}
?>