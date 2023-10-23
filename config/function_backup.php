<?php 
session_start();
require 'dbcon.php';

// input field validation;
function validate($inputData)
{
	global $conn;
	$validateData = mysqli_real_escape_string($conn, $inputData);
	return trim($validateData);

}

// Redirect from 1 page to another page with the message status;
function redirect($url, $status)
{
	$_SESSION['status'] = $status;
	header('Location: '.$url);
	exit(0);
}

// Display message or status after any process
function alertMessage()
{
	if(isset($_SESSION['status']))
	{
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  '.$_SESSION['status'].'
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>';
		unset($_SESSION['status']);
	}
}

// Insert record function
function insert($tableName, $data)
{
    global $conn;
    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumn = implode(', ', $columns);
    $finalValues = "'" . implode("', '", $values) . "'"; // Add a closing single quote here

    $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}


//update data function 
function update($tableName, $id, $data)
{
	global $conn;
	$table = validate($tableName);
	$id = validate($id);

	$updateDataString = "";

	foreach($data as $column => $value)
	{
		$updateDataString .= $column.'='."'$value',";
	}

	$finalUpdateData = substr(trim($updateDataString), 0,-1);

	$query = "UPDATE $table SET $finalUpdateData WHERE id = '$id' ";
	$result = mysqli_query($conn, $query);
	return $result;
}

//get all data function
function getAll($tableName, $status = NULL)
{
	global $conn;

	$table = validate($tableName);
	$status = validate($status);

	if($status == 'status')
	{
		$query = " SELECT * FROM $table WHERE status = '0' ";
	}
	else
	{
		$query = " SELECT * FROM $table";
	}
	return mysqli_query($conn, $query);
}


// get by ID record function
function getById($tableName, $id)
{
	global $conn;
	$table = validate($tableName);
	$id = validate($id);

	$query = "SELECT * FROM $table WHERE id = '$id' LIMIT 1";
	$result = mysqli_query($conn, $query);

	if($result)
	{
		if(mysqli_num_rows($result) == 1 )
		{
			$row = mysqli_fetch_assoc($result);
			$response = [
				'status' => 200,
				'data' => $row,
				'message' => 'Data found'
			];
			return $response;

		}
		else
		{
			$response = [
				'status' => 404,
				'message' => 'No data found'
			];
			return $response;

		}
	}
	else
	{
		$response = [
			'status' => 500,
			'message' => 'Something went wrong'
		];
		return $response;
	}
}

//delete the record function by using ID
function delete($tableName, $id)
{
	global $conn;

	$table = validate($tableName);
	$id = validate($id);

	$query = "DELETE FROM $table WHERE id = '$id' LIMIT 1";

	$result = mysqli_query($conn, $query);
	return $result;
}

//check the paramId type function;
function checkParamId($type)
{
	if(isset($_GET[$type]))
	{
		if($_GET[$type] != '')
		{
			return $_GET[$type];
		}
		else
		{
			return '<h5>No ID found!</h5>';
		}
	}
	else
	{
		return '<h5>No ID given!</h5>';
	}
}

function logoutSession()
{
	unset($_SESSION['logged']);
	unset($_SESSION['user']);
}



?>