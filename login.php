<!DOCTYPE html>
<html>

<head>
    <title>Page Title</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue-cookie@1.1.4/dist/vue-cookie.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="flex min-h-full flex-1 flex-col justify-center items-center px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-20 w-auto" src="../assets/logo/TU_logo.png" alt="Your Company" />
            <h1 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                TU Together
            </h1>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" onsubmit="login(event)">
                <div>
                    <div class="mt-2">
                        <input type="text" id="username" placeholder="student id/user id" required
                            class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between"></div>
                    <div class="mt-2">
                        <input type="password" id="password" placeholder="password" required
                            class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Sign in
                    </button>
                </div>
                <div>
                    <p id="error" style="color: red"></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function login(event) {
            event.preventDefault();
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            axios.post(
                "https://restapi.tu.ac.th/api/v1/auth/Ad/verify2", {
                    UserName: username,
                    PassWord: password,
                }, {
                    headers: {
                        "Content-Type": "application/json",
                        "Application-Key": "TUdf7e79f1e0c5d3c9b2ec2f0e3a020b3304e430a0d5da9bb391acf6266e2c8fc3609c8ae07c5c9ea42e487b8eeb1af452",
                    },
                }
            ).then(function(response) {
                var userData = response.data;
                setCookie("TUTogetherUserData", JSON.stringify(userData), 1);
                window.location.href = "./home.php";
                setCookie("username", userData.username, 1);
                console.log(userData.username);
            }).catch(function(error) {
                console.error(error);
                var errorMessage = error.response.data.message;
                document.getElementById("error").textContent = errorMessage;
            });


        }

        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function eraseCookie(name) {
            document.cookie = name + '=; Max-Age=-99999999;';
        }

        function checkCookie() {
            var userData = getCookie("TUTogetherUserData");
            if (userData) {
                alert("Already logged in");
                window.location.href = "./home.php";
            }
        }

        checkCookie();
    </script>
</body>

</html>
