<?php
require_once "../db.php";

function deletePoll($poll_id) {
  $query = "
    DELETE FROM vote WHERE poll_id = '$poll_id';
    DELETE FROM side WHERE poll_id = '$poll_id';
    DELETE FROM poll WHERE id = '$poll_id';
  ";

  $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
  }

  if (mysqli_multi_query($connection, $query)) {
    echo "Delete poll $poll_id";
  } else {
    echo "Error executing the query: " . mysqli_error($connection);
  }

  mysqli_close($connection);
}

deletePoll($poll_id);
?>
