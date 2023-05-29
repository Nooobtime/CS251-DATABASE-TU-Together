<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    die("Database connection failed");
}

$pollId = $_GET['pollId'] ?? null;
if ($pollId === null) {
    die("Missing poll ID parameter");
}

try {
    $stmt = $conn->prepare("SELECT option.option_id, COUNT(*) AS count FROM vote 
                            INNER JOIN `option` ON vote.option_id = `option`.option_id
                            WHERE vote.poll_id = :poll_id GROUP BY vote.option_id");
    $stmt->bindParam(':poll_id', $pollId);
    $stmt->execute();
    $votes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $voteCounts = [];
    foreach ($votes as $vote) {
        $optionId = $vote['option_id'];
        $count = $vote['count'];

        // Fetch the option name from the database
        $stmt = $conn->prepare("SELECT option_name FROM `option` WHERE option_id = :option_id");
        $stmt->bindParam(':option_id', $optionId);
        $stmt->execute();
        $optionName = $stmt->fetchColumn();

        $voteCounts[$optionId] = [
            'count' => $count,
            'name' => $optionName
        ];
    }

    // Get the highest vote count
    $maxVotes = max(array_column($voteCounts, 'count'));

    // Check if there is a single winner or a draw
    $winners = array_keys(array_column($voteCounts, 'count'), $maxVotes);
    $winnerText = '';
    if (count($winners) === 1) {
        $winnerText = 'Winner: Option ' . $winners[0];
    } else {
        $winnerText = 'Draw: Options ' . implode(', ', $winners);
    }
} catch (PDOException $e) {
    error_log("Error retrieving vote counts: " . $e->getMessage());
    die("Failed to retrieve vote counts: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="path/to/optimized-styles.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.x"></script>
    <title>Page Title</title>
    <style>
        body {
            font-family: 'IBM Plex Mono', sans-serif;
        }

        [x-cloak] {
            display: none;
        }

        .line {
            background: repeating-linear-gradient(to bottom,
                    #eee,
                    #eee 1px,
                    #fff 1px,
                    #fff 8%);
        }

        .tick {
            background: repeating-linear-gradient(to right,
                    #eee,
                    #eee 1px,
                    #fff 1px,
                    #fff 5%);
        }
    </style>
</head>

<body>
    <?php include './components/navComponents.php'; ?>

    <div class="antialiased sans-serif bg-gray-200 w-lg min-h-screen">
        <div x-data="app()" x-cloak class="px-4">
            <div class="max-w-lg mx-auto py-10">
                <div class="shadow p-6 rounded-lg bg-white">
                    <div class="md:flex md:justify-between md:items-center">
                        <div>
                            <h2 class="text-xl text-gray-800 font-bold leading-tight">Poll Name</h2>

                        </div>

                        <!-- Legends -->
                        <div class="mb-4">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-blue-600 mr-2 rounded-full"></div>
                                <div class="text-sm text-gray-700">Selected</div>
                            </div>
                        </div>
                    </div>

                    <div class="line my-8 relative">
                        <!-- Tooltip -->
                        <template x-if="tooltipOpen == true">
                            <div x-ref="tooltipContainer"
                                class="p-0 m-0 z-10 shadow-lg rounded-lg absolute h-auto block"
                                :style="`bottom: ${tooltipY}px; left: ${tooltipX}px`">
                                <div class="shadow-xs rounded-lg bg-white p-2">
                                    <div class="flex items-center justify-between text-sm">
                                        <div>Sales:</div>
                                        <div class="font-bold ml-2">
                                            <span x-html="tooltipContent"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- Bar Chart -->
                        <div class="flex -mx-2 items-end mb-2">
                            <template x-for="(data, index) in selected">
                                <div class="px-2 w-1/6">
                                    <div :style="`height: ${(data.count)*10}px`"
                                        class="transition ease-in duration-200 bg-blue-600 hover:bg-blue-400 relative"
                                        @mouseenter="showTooltip($event, data.name); tooltipOpen = true"
                                        @mouseleave="hideTooltip($event)">
                                        <div x-text="data.count"
                                            class="text-center absolute top-0 left-0 right-0 -mt-6 text-gray-800 text-sm">
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Labels -->
                        <div class="border-t border-gray-400 mx-auto"
                            :style="`height: 1px; width: ${100 - 1/selected.length * 100 + 3}%`"></div>
                        <div class="flex -mx-6 items-end ">
                            <template class="" x-for="(data, index) in options">
                                <div class="px-2 w-1/6">
                                    <div class="bg-red-600 relative">
                                        <div class="text-center absolute top-0 left-0 right-0 h-2 -mt-px bg-gray-400 mx-auto"
                                            style="width: 1px"></div>
                                        <div x-text="data.name"
                                            class="text-center absolute top-0 left-0 right-0 mt-3 text-gray-700 text-sm">
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function app() {
                return {
                    selected: <?php echo json_encode(array_values($voteCounts)); ?>,
                    options: <?php echo json_encode(array_values($voteCounts)); ?>,

                    tooltipContent: '',
                    tooltipOpen: false,
                    tooltipX: 0,
                    tooltipY: 0,
                    showTooltip(e, content) {
                        this.tooltipContent = content;
                        this.tooltipX = e.target.offsetLeft - e.target.clientWidth;
                        this.tooltipY = e.target.clientHeight + e.target.clientWidth;
                    },
                    hideTooltip(e) {
                        this.tooltipContent = '';
                        this.tooltipOpen = false;
                        this.tooltipX = 0;
                        this.tooltipY = 0;
                    }
                };
            }
        </script>
    </div>
</body>
<?php include './components/footerComponents.php'; ?>

</html>
