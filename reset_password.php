<?php
$token = $_GET["token"];
$token_hash = hash("sha256", $token);
include 'connect.php'; // connect

$sql = "SELECT * FROM admin_users WHERE reset_token_hash = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("Token not found");
}
if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token has expired");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change password</title>
        
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
        <!-- Reset password -->
        <div class="justify-content-center mt-5 col-md-6 container">
            <img src="assets/images/eliazar_logo-tranparent.png" alt="" class="w-3rem ratio-1-1 mx-auto mb-3">
            <h1 class="display-6 mb-5">Change your password</h1>
            <form method="post" action="process_reset_password.php">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <div class="mb-3">  
                    <label for="password1" class="form-label fw-bold">New Password</label>
                    <input type="password" name="password" class="form-control" style="height: 3.5rem;" id="password1" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <label for="password2" class="form-label fw-bold">Repeat Password</label>
                    <input type="password" name="password_confirmation" class="form-control" style="height: 3.5rem;" id="password2" placeholder="Password" required>
                </div>
                <button type="submit" class="btn bg-primaryClr text-light d-block col-12 col-md-8 clickDown">Change password</button>
            </form>
        </div>
    </main>
    <script src="myScripts.js"></script>
    <script src="scripts/music.js"></script>
</body>

</html>