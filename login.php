<?php
session_start();
if (isset($_SESSION['isLoggedIn'])) {
    header("location: /");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require ('meta-head.php'); ?>
    <title>Login | Black Cofee</title>
</head>

<body>

    <div class="bg-gray-200 w-full min-h-[100vh] flex justify-center items-center">
        <div class="bg-white p-10 rounded-lg border-2 border-gray-300 w-[80%] md:w-[60%] lg:w-[500px]">
            <div class="font-bold text-2xl">Welcome to Black Cofee Dashboard!</div>
            <div class="mt-1 text-gray-500">Please sign-in to continue</div>
            <?php


            if (isset($_POST['emailNname']) && isset($_POST['pswd'])) {
                $emailNname = $_POST['emailNname'];
                $pswd = $_POST['pswd'];
                if ($emailNname !== "admin@gmail.com" || $pswd !== "admin") {
                    ?>
                    <div class="rounded p-5 bg-red-200 text-red-600 border-[1px] border-red-600 my-2">Invalid login. (Use the
                        default values)</div>
                    <?php
                } else {
                    echo "success";
                    $_SESSION['isLoggedIn'] = "true";
                    echo $_SESSION['isLoggedIn'];
                    header("location: /");
                }
            }

            ?>
            <form class="mt-2" method="POST" action="/login">
                <div class="mb-2">
                    <label for="emailNname" class="mt-1 text-gray-500">Email or Username</label>
                    <input placeholder="johndoe@gmail.com" name="emailNname" id="emailNname"
                        class="p-2 w-full outline-none border-2 border-gray-200 rounded" value="admin@gmail.com" />
                </div>
                <div class="mb-2">
                    <label for="pswd" class="mt-1 text-gray-500">Password</label>
                    <input type="password" name="pswd" id="pswd" required placeholder="············"
                        class="p-2 w-full outline-none border-2 border-gray-200 rounded" value="admin" />
                </div>
                <div class="w-full mt-2">
                    <button class="bg-purple-700 text-white py-3 w-full text-center rounded-lg">Login</button>
                </div>
            </form>
            <div class="mt-5 text-center">Built by <a href="https://okekedivine.vercel.app" target="_blank"
                    class="text-purple-700">Dev Divine</a></div>
        </div>
    </div>

</body>

</html>