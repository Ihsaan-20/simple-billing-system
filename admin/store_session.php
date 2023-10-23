<?php
session_start();


if (isset($_POST['key']) && isset($_POST['value'])) {
    $_SESSION[$_POST['key']] = $_POST['value'];
    echo json_encode($_POST['key']);
} else {
    echo json_encode('Parameters (key and value) not provided.');
}



?>
