<?php

date_default_timezone_set('Asia/Karachi');

require_once '../config/functions.php';


$paramResult = checkParamId('index');
if(!is_numeric($paramResult))
{
    $indexValue = validate($paramResult);

    if(isset($_SESSION['productItems']) && isset($_SESSION['productItemIds']))
    {
        unset($_SESSION['productItems'][$indexValue]);
        unset($_SESSION['productItemIds'][$indexValue]);
        redirect('create-invoice.php', 'Item removed', 'success');
    }
    else
    {
        redirect('create-invoice.php', 'No item found!', 'error');

    }
}
else
{
    // redirect('create-invoice.php', 'Param not numeric', 'error');
    if(is_numeric($paramResult))
        {
            $indexValue = validate($paramResult);

            if(isset($_SESSION['productItems']) && isset($_SESSION['productItemIds']))
            {
                unset($_SESSION['productItems'][$indexValue]);
                unset($_SESSION['productItemIds'][$indexValue]);
                redirect('create-invoice.php', 'Item removed', 'success');
            }
            else
            {
                redirect('create-invoice.php', 'No item found!', 'error');

            }
        }
        else
        {
            redirect('create-invoice.php', 'Param not numeric', 'error');

        }
}

die();

// $paramResult = checkParamId('index');
// if(is_numeric($paramResult))
// {
//     $indexValue = validate($paramResult);

//     if(isset($_SESSION['productItems']) && isset($_SESSION['productItemIds']))
//     {
//         unset($_SESSION['productItems'][$indexValue]);
//         unset($_SESSION['productItemIds'][$indexValue]);
//         redirect('create-invoice.php', 'Item removed', 'success');
//     }
//     else
//     {
//         redirect('create-invoice.php', 'No item found!', 'error');

//     }
// }
// else
// {
//     redirect('create-invoice.php', 'Param not numeric', 'error');

// }