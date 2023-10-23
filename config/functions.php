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

// Redirect from one page to another with a message and status type
function redirect($url, $status, $statusType)
{
    $_SESSION['status'] = [
        'message' => $status,
        'type' => $statusType,
    ];
    header('Location: ' . $url);
    exit(0);
}

// Display a message or status after any process
function alertMessage()
{
    if (isset($_SESSION['status']) && isset($_SESSION['status']['type']) && isset($_SESSION['status']['message'])) {
        $message = $_SESSION['status']['message'];
        $type = $_SESSION['status']['type'];
        $alertClass = 'alert-warning'; // Default to warning, you can customize this.
        
        if ($type === 'success') {
            $alertClass = 'alert-success';
        } elseif ($type === 'error') {
            $alertClass = 'alert-danger';
        }

        echo '<div class="alert ' . $alertClass . ' alert-dismissible fade show" role="alert">
            ' . $message . '
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
		$query = " SELECT * FROM $table WHERE status = '0' ORDER BY id DESC ";
	}
	else
	{
		$query = " SELECT * FROM $table ORDER BY id DESC";
	}
	return mysqli_query($conn, $query);
}

//get sum of a column form table;
function sumColumn($tableName, $columnName)
{
    global $conn;

    $table = validate($tableName);
    $column = validate($columnName);

    $query = "SELECT SUM($column) AS total_sum FROM $table";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    return $row['total_sum'];
}

//count today's number of rows
function countOrdersForCurrentDate($tableName, $dateColumnName, $currentDate)
{
    global $conn;

    $table = validate($tableName);
    $dateColumn = validate($dateColumnName);
    $currentDate = validate($currentDate);

    $query = "SELECT COUNT(*) AS total FROM $table WHERE DATE($dateColumn) = '$currentDate'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    return $row['total'];
}


// Count total number of row from the table;
function countRecord($tableName, $columnName)
{
    global $conn;

    $table = validate($tableName);
    $column = validate($columnName);

    $query = "SELECT COUNT($column) AS total FROM $table";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    return $row['total'];
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

function JsonResponse($status, $status_type, $message)
{
	$response = [
		'status' => $status,
		'status_type' => $status_type,
		'message' => $message
	];
	echo json_encode($response);
	return;
}


?>