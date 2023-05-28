<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the pollId from the URL parameter
    $pollId = $_GET['pollId'];

    // Prepare the SQL query
    $sql = "SELECT * FROM poll WHERE id = :pollId";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the pollId parameter
    $stmt->bindParam(':pollId', $pollId, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if a row was returned
    if ($result) {
        // Access the retrieved data
        $id = $result['id'];
        $name = $result['name'];
        $info = $result['info'];

        // Prepare the SQL query to fetch poll sides
        $sideSql = "SELECT * FROM side WHERE poll_id = :pollId";

        // Prepare the statement
        $sideStmt = $conn->prepare($sideSql);

        // Bind the pollId parameter
        $sideStmt->bindParam(':pollId', $pollId, PDO::PARAM_STR);

        // Execute the query
        $sideStmt->execute();

        // Fetch all the poll sides
        $pollSides = $sideStmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "No poll found with the specified poll ID.";
    }
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Page Title</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="bg-white">
        <div>
            <!-- Product info -->
            <div
                class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
                <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                    <?php echo '<h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">' . $name . '</h1>'; ?>
                </div>

                <!-- Options -->
                <div class="mt-4 lg:row-span-3 lg:mt-0">
                    <h2 class="sr-only">Poll information</h2>
                    <form class="mt-10">
                        <!-- Sizes -->
                        <div class="mt-10">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-900">เลือก</h3>
                            </div>

                            <RadioGroup class="mt-4">
                                <RadioGroupLabel class="sr-only">Choose a size</RadioGroupLabel>
                                <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4">
                                    <?php
                                    foreach ($pollSides as $side) {
                                        $id = $side['id'];
                                        $name = $side['name'];
                                        $info = $side['info'];

                                        echo '<RadioGroupOption>';
                                        echo '<div class="cursor-pointer bg-white text-gray-900 shadow-sm group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6">';
                                        echo '<RadioGroupLabel as="span">' . $id . '</RadioGroupLabel>';
                                        echo '<span class="border-2 pointer-events-none absolute -inset-px rounded-md"></span>';
                                        echo '</div>';
                                        echo '</RadioGroupOption>';
                                    }
                                    ?>
                                </div>
                            </RadioGroup>
                        </div>

                        <!-- Vote Button (Conditional) -->
                        <button v-if="isPollOpen" @click="vote" type="button"
                            class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Vote
                        </button>
                    </form>
                </div>

                <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
                    <!-- Description and details -->
                    <div>
                        <h3 class="sr-only">Description</h3>
                        <div class="space-y-6">
                            <?php echo '<p class="text-base text-gray-900">' . $info . '</p>'; ?>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h3 class="text-sm font-medium text-gray-900">ฝั่ง</h3>

                        <div class="mt-4">
                            <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                                <?php
                                foreach ($pollSides as $side) {
                                    $id = $side['id'];
                                    $name = $side['name'];
                                    $info = $side['info'];

                                    echo '<li class="text-gray-400">';
                                    echo '<span class="text-gray-600">' . $id . ' ' . $name . ' Info: ' . $info . '</span>';
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
