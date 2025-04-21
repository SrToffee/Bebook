<?php
session_start();

function clean_input($value)
{
	$value = trim($value);
	$value = stripslashes($value);
	$value = htmlspecialchars($value);
	str_ireplace("'", "", $value);
	if (preg_match('@[A-Z]@', $value) || preg_match('@[a-z]@', $value) || preg_match('@[^\w]@', $value)) {
		$ret = substr_replace($value, "'", 0, 0);
		$ret = substr_replace($ret, "'", strlen($ret), 0);
		return $ret;
	}
	return $value;
}
function get_all_table($table)
{
	include('connect_bd.php');
	$sql = "SELECT * FROM " . $table;
	$result = mysqli_query($conn, $sql);
	return ($result);
}

function unique_camp_val($value, $camp)
{
	include('connect_bd.php');
	$sql = "SELECT '$camp' FROM t_user WHERE $camp ='$value'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
		return (true);
	return (false);
}

function pass_val($pass)
{
	$number = preg_match('@[0-9]@', $pass);
	$uppercase = preg_match('@[A-Z]@', $pass);
	$lowercase = preg_match('@[a-z]@', $pass);
	$specialChars = preg_match('@[^\w]@', $pass);
	if (strlen($pass) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars)
		return (false);
	return (true);
}
function get_numrows($value, $camp, $table)
{
	include('connect_bd.php');
	$sql = "SELECT '$camp' FROM " . $table . " WHERE $camp =$value";
	$result = mysqli_query($conn, $sql);
	mysqli_close($conn);
	return (mysqli_num_rows($result));
}
function get_column($id, $key)
{
	include('connect_bd.php');
	$table = get_table($key);
	$sql = "SELECT * FROM " . $table . " WHERE " . $key . " =" . $id;
	$result = mysqli_query($conn, $sql);
	mysqli_close($conn);
	if ($result)
		return ($result);
	return (0);
}
function get_table($key_id)
{
	include('connect_bd.php');
	$sql = 'SELECT *
		from INFORMATION_SCHEMA.COLUMNS
		where COLUMN_KEY = "PRI" && COLUMN_NAME ="' . $key_id . '"';
	$result = mysqli_query($conn, $sql);
	$table = mysqli_fetch_assoc($result);
	return ($table['TABLE_NAME']);
}
function get_primary_key($table)
{
	include('connect_bd.php');
	$sql = 'SELECT c.COLUMN_NAME
		from INFORMATION_SCHEMA.COLUMNS c
		where COLUMN_KEY = "PRI" && TABLE_NAME = "' . $table . '";';
	$result = mysqli_query($conn, $sql);
	$primary = mysqli_fetch_assoc($result);
	return ($primary['COLUMN_NAME']);
}
function get_user($id)
{
	return (get_column($id, "id_user"));
}
function get_cart()
{
	include('connect_bd.php');
	$sub_id = array_keys($_SESSION['cart']);
	$values = implode(" || sub_id= ", $sub_id);
	$sql = "SELECT t_products.name,t_products.price, discont, sub_id, pic, stock
		from t_products, t_products_d, t_discont
		WHERE t_products.id_item = t_products_d.id_item && t_products.id_discont = t_discont.id_discont
		&&( t_products_d.sub_id =" . $values . ')';
	$result = mysqli_query($conn, $sql);
	return ($result) ? ($result) : (0);
}
function type_val()
{
	if (isset($_SESSION['id_user'])) {
		include('connect_bd.php');
		$sql = "SELECT u_type FROM t_user WHERE id_user = " . $_SESSION['id_user'];
		if ($result = mysqli_query($conn, $sql)) {
			$value = mysqli_fetch_assoc($result);
			mysqli_close($conn);
			if ($value['u_type'] != 0)
				header('location:login.php');
		}
	} else
		header('location:index.php');
}

function tool_insert($data, $table)
{
	include('connect_bd.php');
	$input = array();
	$data_keys = array();
	foreach ($data as $camp =>$value)
		if (!empty($value)) {
			$input[] = clean_input($value);
			$data_keys[] = $camp;
		}
	$values = implode(",", $input);
	$camps = implode(",", $data_keys);
	if (!empty($_FILES['pic']) && $_FILES['pic']['error'] == 0)
		$input[] = upload_pic($_FILES['pic']);
	$sql = "INSERT INTO " . $table . "(" . $camps . ")
		values(" . $values . ");";
	echo $sql;
	if (!mysqli_query($conn, $sql))
		return (0);
	return (mysqli_insert_id($conn));
}
function form_validation($data)
{
	$i = 0;
	$errors = array_keys($data);
	foreach ($errors as $value) {
		if ($data[$value] == "") {
			$i++;
		}
	}
	if ($i > 0)
		return (0);
	return (1);
}
function tool_update($data, $condition, $table)
{
	include('connect_bd.php');
	$input = array();
	foreach ($data as $key => $value) {
		$input[$key] = clean_input($value);
	}
	if (isset($input["email"])) {
		if ($input["email"] != null && get_numrows($input["email"], 'email', $table) == 0)
			$input['email'] = clean_input($data["email"]);
		else
			unset($input["email"]);
	}
	if (isset($input["password"]) && pass_val($input["password"])) {
		if (isset($input["c_password"]) && $input['password'] == $input['c_password']) {
			unset($input["c_password"]);
		} else
			unset($input["password"], $input['c_password']);
	} else
		unset($input["password"], $input['c_password']);
	if (isset($_FILES['pic']) && $_FILES['pic']['error'] == 0) {
		$input['pic'] = clean_input(upload_pic($_FILES['pic']));
		header('location:error.php?show=' . $input['pic']);
	} else {
		unset($input["pic"]);
	}
	foreach ($input as $column => $value) {
		if ($value != null) {
			$sql = "UPDATE " . $table . " SET " . $column . "=" . $value . " WHERE " . $condition;
			if (!mysqli_query($conn, $sql))
				return (0);
		}
	}
	mysqli_close($conn);
	return (1);
}
function upload_pic($value)
{
	$target_file = 'img/' . basename($value["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	$check = getimagesize($value["tmp_name"]);
	if ($check !== false) {
		$uploadOk = 1;
	} else {
		$uploadOk = 0;
	}

	if (file_exists($target_file)) {
		unlink($target_file);
	}


	if (
		$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif"
	) {
		$uploadOk = 0;
	}

	if ($uploadOk == 1) {
		if (move_uploaded_file($value["tmp_name"], $target_file)) {
			return ($target_file);
		} else {
			return (0);
		}
	} else
		return (3);
}
