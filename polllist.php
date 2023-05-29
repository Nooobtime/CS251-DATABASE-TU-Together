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
  <?php include './components/navComponents.php'; ?>
  <div id="app">
    <div class="container mx-auto py-8">
      <h1 class="text-3xl text-center font-bold mb-8">รายชื่อ Poll</h1>
      <ul class="space-y-4" id="poll-list"></ul>
    </div>
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
    } else {
      // Handle the error case
      $polls = array();
    }
  } catch (PDOException $e) {
    // Log the error message to the console
    error_log("Connection failed: " . $e->getMessage());

    // Output an empty array for the polls data
    $polls = array();
  }

  // Handle delete poll request
  if (isset($_POST['pollId'])) {
    $pollId = $_POST['pollId'];
    deletePoll($pollId);
  }

  function deletePoll($pollId)
  {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Delete the poll from the database
      $query = "DELETE FROM vote WHERE poll_id = :pollId;
                DELETE FROM `option` WHERE poll_id = :pollId;
                DELETE FROM poll WHERE poll_id = :pollId";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':pollId', $pollId);
      $stmt->execute();

      echo "Delete poll $pollId";
    } catch (PDOException $e) {
      // Log the error message to the console
      error_log("Deletion failed: " . $e->getMessage());
      echo "Error deleting the poll: " . $e->getMessage();
    }
  }
  ?>

  <script>

    // Use the poll data fetched from PHP
    const pollsData = <?php echo json_encode($polls); ?>;

    // Function to delete a poll
    function deletePoll(pollId) {
      // Confirm deletion
      if (confirm("Are you sure you want to delete this poll?")) {
        // Send an AJAX request to the server to delete the poll
        fetch(window.location.href, {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: `pollId=${encodeURIComponent(pollId)}`
        })
          .then(response => response.text())
          .then(data => {
            console.log(data);
            // Refresh the poll list after successful deletion
            renderPolls(pollsData.filter(poll => poll.poll_id !== pollId));
            location.reload(); // Reload the page
          })
          .catch(error => console.log(error));
      }
    }

    // Use the poll data fetched from PHP
    document.addEventListener("DOMContentLoaded", function () {
      renderPolls(pollsData);
    });

    function renderPolls(polls) {
      const pollList = document.getElementById("poll-list");
      const currentDate = new Date();

      polls.forEach(poll => {
        const pollItem = document.createElement("li");
        pollItem.innerHTML = `
          <div class="bg-white p-4 shadow-sm rounded-md">
            <div class="flex items-center justify-between mb-2">
              <h2 class="text-lg font-semibold">${poll.poll_name}</h2>
              
              <div>
                ${getPollButton(poll)}
                <button class="px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded-md" onclick="deletePoll('${poll.poll_id}')">Delete</button>
              </div>
              
            </div>
            <p class="text-sm text-gray-600">${poll.poll_created_at}</p>
            <p>Start Date: ${poll.poll_startDate}</p>
            <p>End Date: ${poll.poll_endDate}</p>
          </div>
        `;

        pollList.appendChild(pollItem);
      });

      function getPollButton(poll) {
        const startDate = new Date(poll.poll_startDate);
        const endDate = new Date(poll.poll_endDate);

        if (currentDate < startDate) {
          // Poll has not started yet
          return `<button class="px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded-md" disabled>
          Soon
          </button>`;
        } else if (currentDate >= startDate && currentDate <= endDate) {
          // Poll is ongoing
          return `
            <button class="px-4 py-2 text-white bg-green-500 hover:bg-green-600 rounded-md">
              <a href="./poll.php?pollId=${poll.poll_id}">
                Vote
              </a>
            </button>
          `;
        } else {
          // Poll has already ended
          return `
            <button class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-md">
              <a href="./result.php?pollId=${poll.poll_id}">
                View
              </a>
            </button>
          `;
        }
      }
    }
  </script>
</body>
<?php include './components/footerComponents.php'; ?>

</html>
