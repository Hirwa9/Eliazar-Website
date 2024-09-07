<?php
$token = $_POST["token"];
$token_hash = hash("sha256", $token);
include 'connect.php'; // connect

$sql = "SELECT * FROM admin_users WHERE reset_token_hash = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

// Check token
if ($user === null) {
    exit("Token not found");
}
if (strtotime($user["reset_token_expires_at"]) <= time()) {
    exit("Token has expired");
}

// Validate password
if (strlen($_POST["password"]) < 8) {
    exit("Password must be at least 8 characters");
}
if (!preg_match("/[a-z]/i", $_POST["password"])) {
    exit("Password must contain at least one letter");
}
if (!preg_match("/[0-9]/", $_POST["password"])) {
    exit("Password must contain at least one number");
}

// Check if Passwords match
if ($_POST["password"] !== $_POST["password_confirmation"]) {
    exit("Passwords must match");
}

// Update the password
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
$sql = "UPDATE admin_users
        SET password = ?, reset_token_hash = NULL, reset_token_expires_at = NULL
        WHERE id = ?";
$updatePasswordStmt = $conn->prepare($sql);
$updatePasswordStmt->bind_param("ss", $password_hash, $user["id"]);
if ($updatePasswordStmt->execute()) {
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Password reset successfully</title>
            
        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width= device-width, initial-scale=1.0">
        <meta name="author" content="Hirwa Willy">
        <meta name="keywords" content="HTML, CSS">
        
        <!-- BS, FA & jQ -->
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- custom styles-->
        <link rel="icon" type="image/x-icon" href="assets/images/eliazar.ico">
        <link rel="stylesheet" type="text/css" href="styles/music.css?v=1.0004">
    </head>
    <body>
        <main>
            <div class="justify-content-center mt-5 col-md-6 container">
                <img src="assets/images/eliazar_logo-tranparent.png" alt="" class="w-3rem ratio-1-1 mx-auto mb-3">
                <h1 class="display-6 mb-5">Password reset successively</h1>
                <div class="my-3">
                    You can now login with your new password.<br><br>
                    <a class="btn bg-primaryClr text-light d-block col-12 col-md-8 clickDown" href=admin_login.php>Login <span class="fa fa-angle-right ms-2"></span></a>
                </div>
            </div>
        </main>
        <script src="myScripts.js"></script>
        <script src="scripts/music.js"></script>
    </body>        
    </html>
    HTML;
} else {
    echo <<<HTML
    <div class="justify-content-center mt-5 col-md-6 container">
        <img src="assets/images/eliazar_logo-tranparent.png" alt="" class="w-3rem ratio-1-1 mx-auto mb-3">
        <h1 class="display-6 mb-5">Password reset successively</h1>
        <div class="my-3">
            Sorry! Something went wrong! Kindly go back and try again!<br><br>
        </div>
    </div>
    HTML;
}