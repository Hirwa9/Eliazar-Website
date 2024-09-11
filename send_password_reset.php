<?php
// Include your database connection
include 'connect.php';
require 'mailer.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mailAttemptSuccessful = true;

    // Verify if email exists in the database
    $checkSql = "SELECT * FROM admin_users WHERE username = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a token
        $token = bin2hex(random_bytes(16));
        $token_hash = hash('sha256', $token);
        $expiry = date('Y-m-d H:i:s', time() + 60 * 30);

        // Update the database with the reset token
        $sql = "UPDATE admin_users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $token_hash, $expiry, $email);
        $stmt->execute();

        // Check if the token was successfully updated
        if ($stmt->affected_rows > 0) {
            $subject = 'Password Reset';
            $body = <<<HTML
            <html>
            <head>
                <style>
                    .button {
                        display: inline-block;
                        padding: 10px 20px;
                        font-size: 16px;
                        color: #fff !important;
                        background-color: #007bff;
                        border: none;
                        border-radius: 5px;
                        text-align: center;
                        text-decoration: none;
                    }
                </style>
            </head>
            <body>
                <p>Hello,</p>
                <p>You requested to reset your password. Please click the button below to reset your password:</p>

                <!-- Live -->
                <!-- <a href="https://eliazarndayisabye.rf.gd/reset_password.php?token={$token}" class="button">Reset Password</a> -->
                
                <!-- Local -->
                <a href="http://localhost/eliazar/reset_password.php?token={$token}" class="button">Reset Password</a>
                
                <p>
                    If you did not request this action, please ignore this email. Your password will remain unchanged. <br><br>
                    Thank you.
                </p>
            </body>
            </html>
            HTML;

            // Send email
            if (!sendMail($email, $subject, $body)) {
                echo 'Reset link could not be sent. Please try again.';
                $mailAttemptSuccessful = false;
            }
        } else {
            echo 'Failed to update reset token. Please try again.';
            $mailAttemptSuccessful = false;
        }

        $stmt->close();
    }
    if ($mailAttemptSuccessful === true) {
        // echo 'Password reset email has been sent. Please check your inbox.';
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>Reset password</title>
                
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
                    <h1 class="display-3 mb-5">Check your inbox</h1>
                    <p>
                        <span class="fa fa-check-circle me-2"></span> An email was sent to the provided email address. Please check your inbox and follow instructions to reset your password.
                    </p>
                </div>
            </main>
            <script src="myScripts.js"></script>
            <script src="scripts/music.js"></script>
        </body>        
        </html>
        HTML;
    }
    $checkStmt->close();
    $conn->close();
}