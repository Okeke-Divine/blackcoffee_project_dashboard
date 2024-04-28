<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('meta-head.php'); ?>
    <title>Login | Black Cofee</title>
</head>
<body>

    <div class="bg-gray-200 w-full min-h-[100vh] flex justify-center items-center">
        <div class="bg-white p-10 rounded-lg border-2 border-gray-300 w-[80%] md:w-[60%] lg:w-[500px]">
            <div class="font-bold text-2xl">Welcome to Dashboard!</div>
            <div class="mt-1 text-gray-500">Please sign-in to continue</div>
            <?php

                if(isset($_POST['email'],$_POST['pswd'])){
                    $email = $_POST['email'];
                    $pswd = $_POST['pswd'];
                    echo "pass";
                }

            ?>
            <form class="mt-2" method="POST" action=".">
                <div class="mb-2">
                    <label class="mt-1 text-gray-500">Email or Username</label>
                    <input placeholder="johndoe@gmail.com" name="email" class="p-2 w-full outline-none border-2 border-gray-200 rounded" value="admin@gmail.com" />
                </div>
                <div class="mb-2">
                    <label class="mt-1 text-gray-500">Password</label>
                    <input type="password" names="pswd" required placeholder="....." class="p-2 w-full outline-none border-2 border-gray-200 rounded" value="admin" />
                </div>
                <div class="w-full mt-2">
                    <button type="submit" class="bg-purple-700 text-white py-3 w-full text-center rounded-lg">Login</button>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>