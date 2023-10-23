<?php
date_default_timezone_set('Asia/Karachi');

require_once '../config/functions.php';

if(isset($_POST['login']))
{
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    // old values values in session;
    $_SESSION['old_email'] = $email;
    $_SESSION['old_password'] = $password;

    if($email != '' && $password != '')
    {
        $checkEmail = " SELECT * FROM admins WHERE email = '$email' LIMIT 1 ";
        $result = mysqli_query($conn, $checkEmail);
        if($result)
        {
            if(mysqli_num_rows($result) == 1 )
            {
                $row = mysqli_fetch_assoc($result);

                 $hashedPassword = $row['password'];

                // verify password
                if(!password_verify($password, $hashedPassword))
                {
                    redirect('login.php', 'Password incorrect...','error');
                }
                // verify account status
                if($row['status'] == 0 )
                {
                    redirect('login.php', 'Your account is in-active... Contact admin first!','error');
                }

                // Store data in session;
                $_SESSION['logged'] = true;
                $_SESSION['user'] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'status' => $row['status'],
                ];
                redirect('../admin/index.php', 'Login successful!','success');
                
            }
            else
            {
                redirect('login.php', 'Invalid email address...','error');
            }
        }
        else
        {
            redirect('login.php', 'Oops! something went wrong!','error');
        }
    }
    else
    {
        redirect('login.php', 'Please Enter email & password','error');
    }
}