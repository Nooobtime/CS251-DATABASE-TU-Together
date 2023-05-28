<!DOCTYPE html>
<html lang="en">

<head>
  <title>Poll List</title>
  <style>
    .container {
      max-width: 600px;
    }
  </style>
  <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
  <div id="app">
    <div id="navbar"></div>
    <div class="container mx-auto py-8">
      <h1 class="text-3xl text-center font-bold mb-8">รายชื่อ Poll</h1>
      <ul class="space-y-4" id="poll-list"></ul>
    </div>
    <div id="footer"></div>
  </div>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch poll data from the database
    $query = "SELECT * FROM poll";
    $result = $conn->query($query);

    if ($result) {
      $polls = array();

      // Fetch each row as an associative array
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $polls[] = $row;
      }

      // Output the poll data as JSON for JavaScript
      echo '<script>const pollsData = ' . json_encode($polls) . ';</script>';
    } else {
      // Handle the error case
      echo '<script>const pollsData = [];</script>';
    }
  } catch (PDOException $e) {
    // Log the error message to the console
    error_log("Connection failed: " . $e->getMessage());

    // Output an empty array for the polls data
    echo '<script>const pollsData = [];</script>';
  }
  ?>

  <script>
    // Use the poll data fetched from PHP
    document.addEventListener("DOMContentLoaded", function () {
      renderPolls(pollsData);
    });

    function renderPolls(polls) {
      const pollList = document.getElementById("poll-list");

      polls.forEach(poll => {
        const pollItem = document.createElement("li");
        pollItem.innerHTML = `
          <div class="bg-white p-4 shadow-sm rounded-md">
            <div class="flex items-center justify-between mb-2">
              <h2 class="text-lg font-semibold">${poll.name}</h2>
              <a href="./poll.php?pollId=${poll.id}">
                <button class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-md">
                  Vote
                </button>
              </a>
            </div>
            <p class="text-sm text-gray-600">${poll.info}</p>
          </div>
        `;

        pollList.appendChild(pollItem);
      });
    }
  </script>
</body>

</html>