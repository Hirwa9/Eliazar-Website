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
            <h1 class="display-3 mb-5">Reset password</h1>
            <p>You will receive a link to reset the password</p>            
            <form method="post" action="send_password_reset.php">
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" style="border-color: var(--primaryClr); height: 3.5rem;" id="adminEmail" placeholder="Enter your email" required>
                </div>
                <button type="submit" class="btn bg-primaryClr text-light d-block col-12 col-md-8 clickDown">Send link</button>
            </form>
        </div>
    </main>
    <script src="myScripts.js"></script>
    <script src="scripts/music.js"></script>
</body>

</html>