<?php
date_default_timezone_set('Asia/Karachi');

require_once '../config/functions.php';

$currentTimestamp = date('Y-m-d H:i:s', time());

//add new staff;
if(isset($_POST['saveAdmin']))
{

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $status = isset($_POST['status']) == true ? 1 : 0 ;
    $currentTimestamp = date('Y-m-d H:i:s', time());

    

    if( $name != '' && $email != '' && $password != '')
    {
        $checkEmail = mysqli_query($conn, "SELECT email FROM admins WHERE email = '$email' ");
        if($checkEmail)
        {
            if(mysqli_num_rows($checkEmail) > 0)
            {
                redirect('admins-create.php', 'Email already exists..', 'error');
            }
        }
        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bcrypt_password,
            'phone' => $phone,
            'status' => $status,
            'created_at' => $currentTimestamp

        ];

        $result = insert('admins', $data);
        if($result)
        {
            redirect('admins.php', 'Added successfully','success');
        }
        else
        {
            redirect('admins-create.php', 'Oops failed!','error');
        }

    }
    else
    {
        redirect('admins-create.php', 'Please Fill required fields..','error');
    }
}//end here;

//update staff data;
if(isset($_POST['update']))
{   
    $admin_id = validate($_POST['admin_id']);

    $adminData = getById('admins', $admin_id);

    if($adminData['status'] != 200)
    {
        redirect('admin-edit.php?id='.$admin_id,'Please fill required fields..','error');
    } 

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $status = isset($_POST['status']) == true ? 1 : 0 ;
    
    //check email if exist or not
    $emailCheckQuery = "SELECT * FROM admins WHERE email = '$email' AND id != '$admin_id'";
    $checkResult = mysqli_query($conn, $emailCheckQuery);

    if ($checkResult) {
        if (mysqli_num_rows($checkResult) > 0) {
            redirect('admin-edit.php?id=' . $admin_id, 'Email Already exists...','error');
        }
    }

    // check password update or not
    if($password != '')
    {
        $hashpassword = password_hash($password, PASSWORD_BCRYPT);
    }
    else
    {
        $hashpassword = $adminData['data']['password'];
       
    }
    if( $name != '' && $email != '')
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashpassword,
            'phone' => $phone,
            'status' => $status,
            'updated_at' => $currentTimestamp

        ];
       
        $result = update('admins',$admin_id, $data);
        if($result)
        {
            redirect('admin-edit.php?id='.$admin_id, 'Record Updated successfully', 'success');
        }
        else
        {
            redirect('admin-edit.php?id='.$admin_id, 'Oops! something went wrong!', 'error');

        }
    }
    else
    {
        redirect('admins-create.php', 'Please fill required fields..','error');
    }
}//end here;



// add customer;
if(isset($_POST['addCustomer']))
{   

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
            redirect('customers.php', 'Added successfully','success');
        }
        else
        {
            redirect('customer-create.php', 'Oops failed!','error');
        }

    }
    else
    {
        redirect('customer-create.php', 'Please Fill required fields..','error');
    }
}//end here;

// update customer record;
if(isset($_POST['updateCustomer']))
{
    $customer_id = validate($_POST['customer_id']);

    $customerData = getById('customers', $customer_id);

    if($customerData['status'] != 200)
    {
        redirect('customer-edit.php?id='.$customer_id,'Please fill required fields..','error');
    } 

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
            'updated_at' => $currentTimestamp
        ];

        $result = update('customers', $customer_id, $data);
        if($result)
        {
            redirect('customers.php?id='.$customer_id, 'Record Updated successfully','success');
        }
        else
        {
            redirect('customer-edit.php?id='.$customer_id, 'Oops failed!','error');
        }

    }
    else
    {
        redirect('customer-edit.php?id='.$customer_id, 'Please Fill required fields..','error');
    }

}//end here

// add new brand;
if(isset($_POST['addBrand']))
{
    $brand_name = validate($_POST['brand_name']);
    $currentTimestamp = date('Y-m-d H:i:s', time());

    

    if( $brand_name != '')
    {
        $data = [
            'brand_name' => $brand_name,
            'created_at' => $currentTimestamp
        ];

        $result = insert('brands', $data);
        if($result)
        {
            redirect('brands.php', 'Added successfully','success');
        }
        else
        {
            redirect('brand-create.php', 'Oops failed!','error');
        }

    }
    else
    {
        redirect('brand-create.php', 'Please Fill required field..','error');
    }

}//end here

//update brand ;
if(isset($_POST['updateBrand']))
{
    $brand_id = validate($_POST['brand_id']);

    $brandData = getById('brands', $brand_id);
    $currentTimestamp = date('Y-m-d H:i:s', time());


    if($brandData['status'] != 200)
    {
        redirect('brand-edit.php?id='.$brand_id,'Please fill required fields..','error');
    } 

    $brand_name = validate($_POST['brand_name']);
    
    if( $brand_name != '')
    {
        $data = [
            'brand_name' => $brand_name,
            'updated_at' => $currentTimestamp
        ];

        $result = update('brands', $brand_id, $data);
        if($result)
        {
            redirect('brands.php?id='.$brand_id, 'Record Updated successfully','success');
        }
        else
        {
            redirect('brand-edit.php?id='.$brand_id, 'Oops failed!','error');
        }

    }
    else
    {
        redirect('brand-edit.php?id='.$brand_id, 'Please Fill required fields..','error');
    }
}//end here;

//add new item;
if(isset($_POST['addItem']))
{

    $item_name = validate($_POST['item_name']);
    $brand_id = validate($_POST['brand_id']);
    $price = validate($_POST['price']);
    
    $item_code = 'ITEM-'.time();
    $currentTimestamp = date('Y-m-d H:i:s', time());

    

    if( $item_name != '' && $brand_id != '' && $price != '')
    {
        $data = [
            'item_name' => $item_name,
            'brand_id' => $brand_id,
            'price' => $price,
            'item_code' => $item_code,
            'created_at' => $currentTimestamp
        ];

        $result = insert('items', $data);
        if($result)
        {
            redirect('items.php', 'Added successfully','success');
        }
        else
        {
            redirect('item-create.php', 'Oops failed!','error');
        }

    }
    else
    {
        redirect('item-create.php', 'Please Fill required fields..','error');
    }
}//end here;

//update item data;
if(isset($_POST['updateItem']))
{
    $item_id = validate($_POST['item_id']);

    $itemData = getById('items', $item_id);
    $currentTimestamp = date('Y-m-d H:i:s', time());


    if($itemData['status'] != 200)
    {
        redirect('item-edit.php?id='.$item_id,'Please fill required fields..','error');
    } 

    $item_name = validate($_POST['item_name']);
    $brand_id = validate($_POST['brand_id']);
    $price = validate($_POST['price']);
    

    $item_code = 'ITEM-'.time();
    
    if( $item_name != '' && $brand_id != '' && $price != '')
    {
        $data = [
            'item_name' => $item_name,
            'brand_id' => $brand_id,
            'price' => $price,
            'item_code' => $item_code,
            'updated_at' => $currentTimestamp
        ];

        $result = update('items', $item_id, $data);
        if($result)
        {
            redirect('items.php?id='.$item_id, 'Record Updated successfully','success');
        }
        else
        {
            redirect('item-edit.php?id='.$item_id, 'Oops failed!','error');
        }

    }
    else
    {
        redirect('item-edit.php?id='.$item_id, 'Please Fill required fields..','error');
    }

}//end here;