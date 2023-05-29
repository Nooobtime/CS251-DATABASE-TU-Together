<?php
session_start();

// Database connection
$dbHost = 'localhost';
$dbName = 'test';
$dbUser = 'root';
$dbPass = '';

try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    exit;
}

// Function to retrieve poll details from the database
function getPollDetails($pollId, $conn)
{
    $sql = "SELECT * FROM poll WHERE id = :pollId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':pollId', $pollId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $id = $result['id'];
        $question = $result['question'];
        $createdAt = $result['created_at'];
        $startDate = $result['startDate'];
        $endDate = $result['endDate'];

        $optionSql = "SELECT * FROM option WHERE poll_id = :pollId";
        $optionStmt = $conn->prepare($optionSql);
        $optionStmt->bindParam(':pollId', $pollId, PDO::PARAM_INT);
        $optionStmt->execute();
        $options = $optionStmt->fetchAll(PDO::FETCH_ASSOC);

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

// Function to insert the vote into the database
function addVote($pollId, $optionId, $userId, $conn)
{
    // Check if the user has already voted in the poll
    $voteCheckSql = "SELECT * FROM vote WHERE user_id = :userId AND poll_id = :pollId";
    $voteCheckStmt = $conn->prepare($voteCheckSql);
    $voteCheckStmt->bindParam(':userId', $userId, PDO::PARAM_STR);
    $voteCheckStmt->bindParam(':pollId', $pollId, PDO::PARAM_INT);
    $voteCheckStmt->execute();

    if ($voteCheckStmt->fetch()) {
        // User has already voted in the poll, return false
        return false;
    }

    // Insert the vote into the database
    $sql = "INSERT INTO vote (user_id, poll_id, option_id) VALUES (:userId, :pollId, :optionId)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
    $stmt->bindParam(':pollId', $pollId, PDO::PARAM_INT);
    $stmt->bindParam(':optionId', $optionId, PDO::PARAM_INT);
    $stmt->execute();

    // Check for errors
    if ($stmt->errorCode() !== '00000') {
        $errorInfo = $stmt->errorInfo();
        error_log('Error executing SQL: ' . $errorInfo[2]);
        return false;
    }

    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote']) && $_POST['vote'] === 'true') {
    // Verify CSRF token
    if (!isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        echo "Invalid CSRF token";
        exit;
    }

    $pollId = $_POST['pollId'];
    $optionId = $_POST['optionId'];
    $userId = $_COOKIE['username'] ?? '';

    // Add the vote to the database
    $voteAdded = addVote($pollId, $optionId, $userId, $conn);

    if ($voteAdded) {
        // Send a success response to the client
        echo "Vote submitted successfully";
        exit;
    } else {
        // Send an error response to the client
        http_response_code(500);
        echo "Failed to submit vote";
        exit;
    }
}

if (!isset($_GET['pollId'])) {
    echo "No poll ID specified.";
    exit;
}

$pollId = $_GET['pollId'];
$pollDetails = getPollDetails($pollId, $conn);

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

// Generate CSRF token and store it in the session
$csrfToken = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrfToken;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Poll</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include './components/navComponents.php'; ?>

    <div class="bg-white">
        <div>
            <!-- Poll info -->
            <div
                class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
                <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                        <?php echo $question; ?>
                    </h1>
                </div>

                <!-- Options -->
                <div class="mt-4 lg:row-span-3 lg:mt-0">
                    <h2 class="sr-only">Poll options</h2>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="mt-10">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-900">Choose an option</h3>
                            </div>

                            <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4">
                                <?php foreach ($options as $option): ?>
                                    <div>
                                        <label
                                            class="cursor-pointer bg-white text-gray-900 shadow-sm group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6">
                                            <input type="radio" name="optionId" value="<?php echo $option['id']; ?>">
                                            <span>
                                                <?php echo $option['name']; ?>
                                            </span>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Vote Button -->
                        <input type="hidden" name="vote" value="true">
                        <input type="hidden" name="pollId" value="<?php echo $pollId; ?>">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                        <button type="submit"
                            class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Vote</button>
                    </form>
                </div>

                <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
                    <!-- Description and details -->
                    <div>
                        <h3 class="sr-only">Poll details</h3>
                        <div class="space-y-6">
                            <p class="text-base text-gray-900">Poll ID:
                                <?php echo $id; ?>
                            </p>
                            <p class="text-base text-gray-900">Created At:
                                <?php echo $createdAt; ?>
                            </p>
                            <p class="text-base text-gray-900">Start Date:
                                <?php echo $startDate; ?>
                            </p>
                            <p class="text-base text-gray-900">End Date:
                                <?php echo $endDate; ?>
                            </p>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h3 class="text-sm font-medium text-gray-900">Options</h3>

                        <div class="mt-4">
                            <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                                <?php foreach ($options as $option): ?>
                                    <li class="text-gray-400">
                                        <span class="text-gray-600">
                                            <?php echo $option['id'] . ' ' . $option['name'] . ' Info: ' . $option['info']; ?>
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // No changes made to the JavaScript code
        document.querySelector('form').addEventListener('submit', vote);

        function vote(event) {
            event.preventDefault();

            const selectedOption = document.querySelector('input[name="optionId"]:checked');
            if (!selectedOption) {
                alert('Please select an option');
                return;
            }

            const optionId = selectedOption.value;
            const pollId = "<?php echo $pollId; ?>";
            const csrfToken = "<?php echo $csrfToken; ?>";

            fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    vote: 'true',
                    pollId: pollId,
                    optionId: optionId,
                    csrf_token: csrfToken
                })
            })
                .then(response => {
                    if (response.ok) {
                        alert('Vote submitted successfully');
                        location.reload();
                    } else {
                        throw new Error('User already vote!');
                    }
                })
                .catch(error => {
                    alert('Failed to submit vote');
                });
            window.location.href = "./polllist.php";

        }
    </script>
</body>

</html>