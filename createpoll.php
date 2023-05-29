<?php
function getConnection()
{
    $servername = "localhost";
    $username = "root";
    $password = ""; // Replace with your database password
    $dbname = "test";

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Reset the auto-increment value for poll table
    $conn->query("ALTER TABLE poll AUTO_INCREMENT = 1");

    return $conn;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = getConnection();

    // Retrieve form data
    $pollName = isset($_POST["pollName"]) ? $_POST["pollName"] : "";
    $pollInfo = isset($_POST["pollInfo"]) ? $_POST["pollInfo"] : "";
    $startDate = isset($_POST["startDate"]) ? $_POST["startDate"] : "";
    $endDate = isset($_POST["endDate"]) ? $_POST["endDate"] : "";
    $options = isset($_POST["options"]) ? $_POST["options"] : [];

    // Insert poll into the database
    $sql = "INSERT INTO poll (question, created_at, startDate, endDate) VALUES (?, NOW(), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $pollName, $startDate, $endDate);
    $stmt->execute();
    $pollId = $stmt->insert_id;

    // Insert options into the database
    $sql = "INSERT INTO option (id, poll_id, name, info) VALUES (DEFAULT, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    foreach ($options as $option) {
        $optionName = $option["name"];
        $optionDescription = $option["description"];
        $stmt->bind_param("iss", $pollId, $optionName, $optionDescription);
        $stmt->execute();
    }

    // Close the database connection
    $stmt->close();
    $conn->close();

    // Provide feedback message
    $feedbackMessage = "Poll created successfully!";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Create Poll</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include './components/navComponents.php'; ?>

    <div class="min-h-screen bg-gray-100">
        <div class="container mx-auto py-8">
            <h1 class="text-3xl font-bold mb-6">Create Poll</h1>

            <?php if (!empty($feedbackMessage)): ?>
                <div class="bg-green-200 text-green-800 font-semibold px-4 py-2 rounded mb-4">
                    <?php echo $feedbackMessage; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="bg-white shadow-md rounded-md p-6 mb-6">
                    <div class="mb-4">
                        <label for="pollName" class="font-semibold mb-1 mr-2">Poll Name:</label>
                        <input type="text" name="pollName" placeholder="Enter poll name"
                            class="border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-blue-500"
                            required />
                    </div>

                    <div class="mb-4">
                        <label for="pollInfo" class="block font-semibold mb-1">Poll Info:</label>
                        <input type="text" name="pollInfo" placeholder="Enter poll information"
                            class="w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-blue-500"
                            required />
                    </div>

                    <div class="mb-4">
                        <label for="startDate" class="font-semibold mb-1 mr-2">Start Date:</label>
                        <input type="date" name="startDate"
                            class="border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-blue-500"
                            required />
                    </div>

                    <div class="mb-4">
                        <label for="endDate" class="font-semibold mb-1 mr-2">End Date:</label>
                        <input type="date" name="endDate"
                            class="border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-blue-500"
                            required />
                    </div>

                    <div>
                        <ul id="options-list">
                            <li>
                                <div class="flex items-center">
                                    <input type="text" name="options[0][name]" placeholder="Enter option name"
                                        class="border border-gray-300 rounded py-2 px-3 flex-grow ml-2 focus:outline-none focus:ring-blue-500" />
                                    <input type="text" name="options[0][description]"
                                        placeholder="Enter option description"
                                        class="border border-gray-300 rounded py-2 px-3 flex-grow ml-2 focus:outline-none focus:ring-blue-500" />
                                    <button type="button"
                                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded ml-2 remove-option-btn">Remove</button>
                                </div>
                            </li>
                        </ul>

                        <button type="button"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded mt-4"
                            id="addOptionBtn">Add Option</button>
                    </div>

                    <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded mt-4"
                        id="createPollBtn" disabled>Create Poll</button>
                </div>
            </form>
        </div>
    </div>

    <script>

        // Add option button click handler
        document.getElementById("addOptionBtn").addEventListener("click", function () {
            var optionsList = document.getElementById("options-list");
            var optionIndex = optionsList.getElementsByTagName("li").length;
            var listItem = document.createElement("li");
            listItem.innerHTML = '<div class="flex items-center">' +
                '<input type="text" name="options[' + optionIndex + '][name]" placeholder="Enter option name" ' +
                'class="border border-gray-300 rounded py-2 px-3 flex-grow ml-2 focus:outline-none focus:ring-blue-500" />' +
                '<input type="text" name="options[' + optionIndex + '][description]" ' +
                'placeholder="Enter option description" ' +
                'class="border border-gray-300 rounded py-2 px-3 flex-grow ml-2 focus:outline-none focus:ring-blue-500" />' +
                '<button type="button" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded ml-2 remove-option-btn">Remove</button>' +
                '</div>';
            optionsList.appendChild(listItem);
            updateCreatePollButton();
        });

        // Remove option button click handler (delegate event to options list)
        document.getElementById("options-list").addEventListener("click", function (event) {
            if (event.target.classList.contains("remove-option-btn")) {
                event.target.parentNode.parentNode.remove();
                updateCreatePollButton();
            }
        });

        // Enable or disable create poll button based on the number of options
        function updateCreatePollButton() {
            var optionsList = document.getElementById("options-list");
            var optionsCount = optionsList.getElementsByTagName("li").length;
            var createPollButton = document.getElementById("createPollBtn");
            createPollButton.disabled = optionsCount === 0;
        }
    </script>
</body>

</html>