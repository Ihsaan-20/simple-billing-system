<?php
date_default_timezone_set('Asia/Karachi');

require_once '../config/functions.php';

if(!isset($_SESSION['productItems']))
{
    $_SESSION['productItems'] = [];
}

if(!isset($_SESSION['productItemIds']))
{
    $_SESSION['productItemIds'] = [];
}   

 $currentTimestamp = date('Y-m-d H:i:s', time());


// add item in list;
if(isset($_POST['addItem']))
{
   

    $item_id = validate($_POST['item_id']);
    $unit = validate($_POST['unit']);
    $quantity = validate($_POST['quantity']);
    $currentTimestamp = date('Y-m-d H:i:s', time());



    if($item_id == '' || $unit == '' || $quantity == '')
    {
        redirect('create-invoice.php', 'Please select Item/Unit/Quantity * ... ', 'error');
    }

    $checkItem = mysqli_query($conn, " SELECT * FROM items WHERE id = '$item_id' LIMIT 1");
    if($checkItem)
    {
        if(mysqli_num_rows($checkItem) > 0)
        {
            $row = mysqli_fetch_assoc($checkItem);

            $itemData = [
                'item_id' => $row['id'],
                'item_name' => $row['item_name'],
                'price' => $row['price'],
                'unit' => $unit,
                'quantity' => $quantity,
                'created_at' => $currentTimestamp,
            ];

            if(!in_array($row['id'], $_SESSION['productItemIds']))
            {
                array_push($_SESSION['productItemIds'],$row['id']);
                array_push($_SESSION['productItems'],$itemData);
            }
            else
            {
                
                
                foreach($_SESSION['productItems'] as $key => $productSessionItem)
                {
                    if($productSessionItem['item_id'] == $row['id'])
                    {
                        $newQuantity = $productSessionItem['quantity'] + $quantity;

                        $itemData = [
                            'item_id' => $row['id'],
                            'item_name' => $row['item_name'],
                            'price' => $row['price'],
                            'unit' => $unit,
                            'quantity' => $newQuantity
                        ];
                        $_SESSION['productItems'][$key] = $itemData;
                    }
                }
            }

            redirect('create-invoice.php', 'Item added successfully!'.$row['name'], 'success');

        }
        else
        {
            redirect('create-invoice.php', 'No Product found!', 'error');

        }
    }
    else
    {
        redirect('create-invoice.php', 'Ops! something went wrong!', 'error');
    }
}//end here;

if (isset($_POST['itemIncDec'])) {
    $item_id = validate($_POST['item_id']);
    $quantity = validate($_POST['quantity']);

    $flag = false;

    if (isset($_SESSION['productItems']) && is_array($_SESSION['productItems'])) {
        foreach ($_SESSION['productItems'] as $key => $item) {
            if ($item['item_id'] == $item_id) {
                $flag = true;
                $_SESSION['productItems'][$key]['quantity'] = $quantity;
                break; // Exit the loop once the item is found
            }
        }
    } else {
        // Initialize the array if it doesn't exist
        $_SESSION['productItems'] = array();
    }

    if ($flag) {
        JsonResponse(200, 'success', 'Quantity Updated');
    } else {
        JsonResponse(500, 'error', 'Ops! Something went wrong, please reload the page.');
    }
}//end here


if(isset($_POST['order_now']))
{
    $payment_method = validate($_POST['payment_method']);
    $customer_id = validate($_POST['customer_id']);

    //check the customer id, customer register or not!
    $checkCustomer = mysqli_query($conn, "SELECT * FROM customers WHERE id = '$customer_id' LIMIT 1 ");
    if($checkCustomer)
    {
        if(mysqli_num_rows($checkCustomer) > 0)
        {
            $_SESSION['invoice_number'] = "INV-".time();
            $_SESSION['order_number'] = "ORD-".time();
            $_SESSION['payment_method'] = $payment_method;
            $_SESSION['customer_id'] = $customer_id;

            JsonResponse(200, "success", "Customer found");
        }
        else
        {
            $_SESSION['customer_id'] = $customer_id;
            JsonResponse(404, "error", "Customer not found");

        }
    }
    else
    {
        JsonResponse(500, "error", "Ops! something went wrong!");

    }
}//end here



if(isset($_POST['saveCustomerData'])){
   
    $customer_name = validate($_POST['customer_name']);
    $customer_phone = validate($_POST['customer_phone']);
    $customer_address = validate($_POST['customer_address']);
    $customer_shop_name = validate($_POST['customer_shop_name']);
    
    // generate customer code number;
    $customer_code = "CUS-".time();
    $currentTimestamp = date('Y-m-d H:i:s', time());

    


    if( $customer_name != '' && $customer_phone != '' && $customer_address != '' && $customer_shop_name != '')
    {
        $data = [
            'customer_name' => $customer_name,
            'customer_phone' => $customer_phone,
            'customer_address' => $customer_address,
            'customer_shop_name' => $customer_shop_name,
            'customer_code' => $customer_code,
            'created_at' => $currentTimestamp
        ];

        $result = insert('customers', $data);
        if($result)
        {
            JsonResponse(200, "success", "Customer added successfully");

        }
        else
        {
            JsonResponse(500, "error", "Oops failed!");

        }

    }
    else
    {
        JsonResponse(422, "warning", "Please Fill required fields..");
    }
}

// place order in to database;
if(isset($_POST['saveOrder']))
{
    
    $customer_id = validate($_SESSION['customer_id']);
    $invoice_number = validate($_SESSION['invoice_number']);
    $payment_method = validate($_SESSION['payment_method']);
    $order_number = validate($_SESSION['order_number']);
    $order_by = $_SESSION['user']['name'];
    $currentTimestamp = date('Y-m-d H:i:s', time());
    
    

    $checkCustomer = mysqli_query($conn, "SELECT * FROM customers WHERE id = '$customer_id' LIMIT 1 ");

    if(!$checkCustomer)
    {
        JsonResponse(500, 'error', 'Ops! something went wrong...');
    }
   
    if(mysqli_num_rows($checkCustomer) > 0 )
    {
        $customerData = mysqli_fetch_assoc($checkCustomer);
        
        if(!isset($_SESSION['productItems']))
        {
            JsonResponse(404, 'warning', 'No items found!');
        }

        $sessionProducts = $_SESSION['productItems'];

        $totalAmount = 0;
        foreach($sessionProducts as $key => $amtItem)
        {
            $totalAmount += $amtItem['price'] * $amtItem['quantity'];
        }
        
        $data = [
            'customer_id' => $customerData['id'],
            'invoice_number' => $invoice_number,
            'order_number' => $order_number,
            'payment_method' => $payment_method,
            'total_amount' => $totalAmount,
            'created_at' => $currentTimestamp,
            'order_by' => $order_by
        ];

        $result = insert('invoices', $data);

        $last_invoice_id = mysqli_insert_id($conn);

        foreach($sessionProducts as $p_item)
        {
            $item_id = $p_item['item_id'];
            $price = $p_item['price'];
            $unit = $p_item['unit'];
            $quantity = $p_item['quantity'];

            $dataOrderItem = [
                'invoice_id' => $last_invoice_id,
                'item_id' => $item_id,
                'price' => $price,
                'quantity' => $quantity,
                'unit' => $unit
            ];

            $orderItemQuery = insert('invoice_items', $dataOrderItem);

        }
        // unset all the session;
        unset($_SESSION['productItems']);
        unset($_SESSION['productItemIds']);
        unset($_SESSION['customer_id']);
        unset($_SESSION['item_id']);
        unset($_SESSION['invoice_number']);
        unset($_SESSION['order_number']);

        $response = [
            'status' => 200,
            'message' => 'Order Placed!',
            'invoice_id' => $last_invoice_id
        ];

        // Return the error response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);

        // JsonResponse(200, 'success', 'Order placed');
    }
    else
    {
        JsonResponse(404, 'warning', 'No Customer found..');
    }
}
