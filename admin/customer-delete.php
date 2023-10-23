<?php
date_default_timezone_set('Asia/Karachi');

require_once '../config/functions.php';

$paraResult = checkParamId('id');

if(is_numeric($paraResult))
{
    $customer_id = validate($paraResult);
    // echo $customer_id;
    $customer = getById('customers', $customer_id);

    if($customer['status'] == 200 )
    {
        $customerDelete = Delete('customers', $customer_id);
        if($customerDelete)
        {
            redirect('customers.php', 'Record deleted successfully..','success');
        }
        else
        {
            redirect('customers.php', 'Oops! something went wrong!..','error');
        }
    }
    else
    {
        redirect('customers.php', $customer['message']);
    }
}
else
{
    redirect('customers.php', 'Oops! something went wrong!..','error');
}