<?php
date_default_timezone_set('Asia/Karachi');

require_once '../config/functions.php';

if(isset($_SESSION['logged']))
{
    logoutSession();
    redirect('login.php', 'Logged out successfully!','success');
}