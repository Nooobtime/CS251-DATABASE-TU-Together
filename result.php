
<!DOCTYPE html>
<html>
<head>
  <title>Result</title>
  <style>
    .container {
      max-width: 600px;
    }
  </style>
  

</head>





<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";
function getResult($pollId){
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL query
    $sql = "SELECT side_id FROM side WHERE poll_id = $pollId ";

    // Execute the query
    $stmt = $conn->query($sql);

    // Fetch all the rows as an associative array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the database connection
    $conn = null;

    // Print the array for demonstration
    print_r($result);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}var $j = 1;
foreach($result as $side){
  $query = "SELECT * FROM vote WHERE side_id =$side" ;
  $result = mysqli_query($conn, $sql);  
  echo "result poll " $j "is" $result;
  echo '<br>'
  $j++;
}
}

?>


