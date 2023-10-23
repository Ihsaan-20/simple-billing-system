<?php
date_default_timezone_set('Asia/Karachi');

require_once '../config/functions.php';

$paraResult = checkParamId('id');

if(is_numeric($paraResult))
{
    $admin_id = validate($paraResult);
    // echo $admin_id;
    $admin = getById('admins', $admin_id);

    if($admin['status'] == 200 )
    {
        $adminDelete = Delete('admins', $admin_id);
        if($adminDelete)
        {
            redirect('admins.php', 'Record deleted successfully..','success');
        }
        else
        {
            redirect('admins.php', 'Oops! something went wrong!..','error');
        }
    }
    else
    {
        redirect('admins.php', $admin['message']);
    }
}
else
{
    redirect('admins.php', 'Oops! something went wrong!..','error');
}