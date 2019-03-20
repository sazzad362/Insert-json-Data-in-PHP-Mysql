<?php  
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "jshon";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//Check if post submit
if (isset($_POST['submit'])) {

	// For single input
	// $data              = array();
	// $data['name']      = $_POST['name'];
	// $data['number']    = $_POST['number'];
	// $data['emailBar']  = $_POST['emailBar'];
	// $data['emailName'] = $_POST['emailName'];
	// $myJSON            = json_encode($data);

	//For Multiple Data
	$dataType  = $_POST['data'];
	$dataValue = $_POST['dataValue'];
	$myJSON    = array_combine($dataType, $dataValue);
	$myJSON    = json_encode($myJSON);

	// Insert Operation
	$sql   = "INSERT INTO `info` (`id`, `data`) VALUES (NULL, '$myJSON');";
	$conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Multiple Data Insert</title>
	<style>.area{background:#ddd;padding:15px;margin:15px;max-width: 600px;margin: 0 auto; display: block;text-align: center;} input[type="text"]{padding:6px 10px;} .submit{padding: 6px 10px; width: 100%;}</style> 
</head>
<body>
	
	<form action="" method="POST">


		<div class="area">
			<input type="text" name="data[]" placeholder="label of data" autocomplete="OFF" value="Badhon">
			<input type="text" name="dataValue[]" placeholder="value of data" autocomplete="OFF" value="01675716053">
		</div>
		<div class="area">
			<input type="text" name="data[]" placeholder="label of data" autocomplete="OFF" value="Email Name">
			<input type="text" name="dataValue[]" placeholder="value of data" autocomplete="OFF" value="badhon@gmail.com">
		</div>
		<div class="area">
			<input type="submit" value="submit" name="submit" class="submit">
		</div>


		<!-- <div class="area">
			<input type="text" name="name" placeholder="label of data" autocomplete="OFF" value="Badhon">
			<input type="text" name="number" placeholder="value of data" autocomplete="OFF" value="01675716053">
		</div>
		<div class="area">
			<input type="text" name="emailBar" placeholder="label of data" autocomplete="OFF" value="Email Name">
			<input type="text" name="emailName" placeholder="value of data" autocomplete="OFF" value="badhon@gmail.com">
		</div>
		<div class="area">
			<input type="submit" value="submit" name="submit" class="submit">
		</div> -->
	</form>

</body>
</html>



<?php 

	$sql = "SELECT data FROM info";

	$result = $conn->query($sql);

	while ($row = $result->fetch_assoc()) {
		$get = json_decode($row['data']);
		foreach ($get as $key => $value) {
			echo $key .":". $value . "<br>";
		}
	}

	// $sql = "SELECT data FROM info";

	// $result = $conn->query($sql);

	// while ($row = $result->fetch_assoc()) {
	// 	$get = json_decode($row['data']);
	// 	echo $get->name ." : ".  $get->number;
	// }

?>