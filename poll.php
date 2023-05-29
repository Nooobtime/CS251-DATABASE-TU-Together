<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Function to add a vote to the database
    function addVote($pollId, $optionId, $userId)
    {
        global $conn;

        // Insert the vote into the database
        $voteSql = "INSERT INTO vote (user_id, poll_id, option_id) VALUES (:user_id, :poll_id, :option_id)";
        $voteStmt = $conn->prepare($voteSql);
        $voteStmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $voteStmt->bindParam(':poll_id', $pollId, PDO::PARAM_INT);
        $voteStmt->bindParam(':option_id', $optionId, PDO::PARAM_INT);
        $voteStmt->execute();
    }

    // Function to retrieve poll details from the database
    function getPollDetails($pollId)
    {
        global $conn;

        // Prepare the SQL query
        $sql = "SELECT * FROM poll WHERE id = :pollId";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the pollId parameter
        $stmt->bindParam(':pollId', $pollId, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if a row was returned
        if ($result) {
            // Access the retrieved data
            $id = $result['id'];
            $question = $result['question'];
            $createdAt = $result['created_at'];
            $startDate = $result['startDate'];
            $endDate = $result['endDate'];

            // Prepare the SQL query to fetch poll options
            $optionSql = "SELECT * FROM option WHERE poll_id = :pollId";

            // Prepare the statement
            $optionStmt = $conn->prepare($optionSql);

            // Bind the pollId parameter
            $optionStmt->bindParam(':pollId', $pollId, PDO::PARAM_INT);

            // Execute the query
            $optionStmt->execute();

            // Fetch all the poll options
            $options = $optionStmt->fetchAll(PDO::FETCH_ASSOC);

            // Return the poll details and options
            return [
                'id' => $id,
                'question' => $question,
                'created_at' => $createdAt,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'options' => $options
            ];
        } else {
            return null;
        }
    }

    // Check if the vote form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote']) && $_POST['vote'] === 'true') {
        $pollId = $_GET['pollId'];
        $optionId = $_POST['option_id'];
        $userId = ''; // Get the user ID (you may need to implement user authentication to get the user ID)
        addVote($pollId, $optionId, $userId);
    }

    $pollId = $_GET['pollId'];
    $pollDetails = getPollDetails($pollId);

    if ($pollDetails === null) {
        echo "No poll found with the specified poll ID.";
        exit;
    }

    $id = $pollDetails['id'];
    $question = $pollDetails['question'];
    $createdAt = $pollDetails['created_at'];
    $startDate = $pollDetails['startDate'];
    $endDate = $pollDetails['endDate'];
    $options = $pollDetails['options'];
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Page Title</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include './components/navComponents.php'; ?>
    <div class="bg-white">
        <div>
            <!-- Poll info -->
            <div class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
                <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl"><?php echo $question; ?></h1>
                </div>

                <!-- Options -->
                <div class="mt-4 lg:row-span-3 lg:mt-0">
                    <h2 class="sr-only">Poll options</h2>
                    <form class="mt-10" method="POST" action="">
                        <!-- Options -->
                        <div class="mt-10">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-900">Choose an option</h3>
                            </div>

                            <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4">
                                <?php
                                foreach ($options as $option) {
                                    $optionId = $option['id'];
                                    $optionName = $option['name'];
                                    $optionInfo = $option['info'];

                                    echo '<div>';
                                    echo '<label class="cursor-pointer bg-white text-gray-900 shadow-sm group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6">';
                                    echo '<input type="radio" name="option_id" value="' . $optionId . '">';
                                    echo '<span>' . $optionName . '</span>';
                                    echo '</label>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Vote Button -->
                        <button type="submit" name="vote" value="true"
                            class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Vote
                        </button>
                    </form>
                </div>

                <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
                    <!-- Description and details -->
                    <div>
                        <h3 class="sr-only">Poll details</h3>
                        <div class="space-y-6">
                            <p class="text-base text-gray-900">Poll ID: <?php echo $id; ?></p>
                            <p class="text-base text-gray-900">Created At: <?php echo $createdAt; ?></p>
                            <p class="text-base text-gray-900">Start Date: <?php echo $startDate; ?></p>
                            <p class="text-base text-gray-900">End Date: <?php echo $endDate; ?></p>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h3 class="text-sm font-medium text-gray-900">Options</h3>

                        <div class="mt-4">
                            <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                                <?php
                                foreach ($options as $option) {
                                    $optionId = $option['id'];
                                    $optionName = $option['name'];
                                    $optionInfo = $option['info'];

                                    echo '<li class="text-gray-400">';
                                    echo '<span class="text-gray-600">' . $optionId . ' ' . $optionName . ' Info: ' . $optionInfo . '</span>';
                                    echo '</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
