<?php

if(isset($_SESSION['logged']))
{
    $email = validate($_SESSION['user']['email']);
    $query = " SELECT * FROM admins WHERE email = '$email' LIMIT 1  ";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 0 )
    {
        logoutSession();
        redirect('../login/login.php', 'Access denied!');
    }
    else
    {
        $row = mysqli_fetch_assoc($result);
        if($row['status'] == 0)
        {
            logoutSession();
            redirect('../login/login.php', 'Your account is in-active, please contact admin!');
        }
    }
}
else
{
    redirect('../login/login.php', 'Login to continue...','error');

}