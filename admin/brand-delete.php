<?php
date_default_timezone_set('Asia/Karachi');

require_once '../config/functions.php';

$paraResult = checkParamId('id');

if(is_numeric($paraResult))
{
    $brand_id = validate($paraResult);
    // echo $brand_id;
    $brand = getById('brands', $brand_id);

    if($brand['status'] == 200 )
    {
        $brandDelete = Delete('brands', $brand_id);
        if($brandDelete)
        {
            redirect('brands.php', 'Record deleted successfully..','success');
        }
        else
        {
            redirect('brands.php', 'Oops! something went wrong!..','error');
        }
    }
    else
    {
        redirect('brands.php', $brand['message']);
    }
}
else
{
    redirect('brands.php', 'Oops! something went wrong!..','error');
}