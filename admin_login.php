<?php
// Redirect back to c - panel if logged in
session_start();
if (isset($_SESSION["username"])) {
    header("location:admin_cpanel.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Eliazar - Admin login</title>
        
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
        <link rel="stylesheet" type="text/css" href="styles/login_admin.css?v=1.0004">
    </head>
<body>
    <main>
        <!-- Login -->
        <div class="d-md-flex welcome-about" style="height: auto; background-image: none;">
            <div class="d-none d-md-flex col-md-6 position-relative overflow-hidden">
                <div class="dim-100 position-absolute inset-0 inx--1">
                    <a href="https://www.freepik.com/free-vector/account-concept-illustration_5464649.htm#fromView=search&page=1&position=23&uuid=297d511c-cf5b-4821-999f-227e285d12a4" class="ms-3 mt-3 small text-muted opacity-50 text-decoration-none">
                        Image by storyset on Freepik
                    </a>
                    <img src="assets/images/login_illustration.jpeg" alt="Avatar" class="d-none d-md-block avatar mx-auto mt-3 mb-3 object-fit-cover" style="animation: slideInRight .5s 1 !important">
                </div>
            </div>
            <section class="align-self-baseline col-md-5 col-xl-4 my-3 p-4 rad-20 bg-bodi container" style="animation: slideInLeft .5s 1 !important">
                <form action="admin_logger.php" method="post" id="loginForm">
                    <div class="">
                        <img src="assets/images/eliazar_logo-tranparent.png" alt="Avatar" class="avatar mx-auto mb-3 w-3rem ratio-1-1">
                        <h1 class="fs-3 mb-5 mt-3 text-center text-secondaryClr" style="text-transform: uppercase;">
                            Login to the dashboard
                        </h1>
                    </div>
                    <div class="mb-3">
                        <label for="userName" class="form-label fw-bold">Email</label>
                        <input type="email" name="uname" class="form-control h-3rem" id="userName" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label for="userPassword" class="form-label fw-bold">Password</label>
                        <input type="password" name="psw" class="form-control h-3rem" id="userPassword" placeholder="Enter Password" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-lg col-12 my-3 rad-15 bg-secondaryClr text-light clickDown">Login</button>
                    </div>
                    <div class="d-flex clearfix">
                        <button type="reset" class="btn btn-sm btn-outline-secondary border-0 col-6 my-3">Reset</button>
                        <span class="ms-auto my-auto pe-2 float-end">
                            <a href="forgot_password.php" class="small" title="Click to reset password">Forgot password?</a>
                        </span>
                    </div>
              </form>
            </section>
        </div>
        <!-- Footer svg -->
        <svg width="100%" id="svg" viewBox="0 0 1440 390" xmlns="http://www.w3.org/2000/svg" class="transition duration-300 ease-in-out delay-150 fixed-bottom inx--1"><defs><linearGradient id="gradient" x1="35%" y1="98%" x2="65%" y2="2%"><stop offset="5%" stop-color="#453643"></stop><stop offset="95%" stop-color="#8ED1FC"></stop></linearGradient></defs><path d="M 0,400 L 0,0 C 32.54626582398603,48.83251722370893 65.09253164797207,97.66503444741787 108,109 C 150.90746835202793,120.33496555258213 204.1761392320978,94.17237943403748 246,91 C 287.8238607679022,87.82762056596252 318.2029114236368,107.64544781643227 356,109 C 393.7970885763632,110.35455218356773 439.01221507335504,93.24582930023347 476,101 C 512.987784926645,108.75417069976653 541.7482282829433,141.37123498263395 582,129 C 622.2517717170567,116.62876501736606 673.9948717948718,59.269230769230774 720,63 C 766.0051282051282,66.73076923076923 806.2722845375696,131.55184194044298 852,134 C 897.7277154624304,136.44815805955702 948.9159900548501,76.52340146899732 981,70 C 1013.0840099451499,63.476598531002686 1026.0637552430298,110.35455218356775 1063,109 C 1099.9362447569702,107.64544781643225 1160.8289889730304,58.058389796731745 1205,66 C 1249.1710110269696,73.94161020326825 1276.6202888648486,139.41188862950523 1313,138 C 1349.3797111351514,136.58811137049477 1394.6898555675757,68.29405568524739 1440,0 L 1440,400 L 0,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="0.53" class="transition-all duration-300 ease-in-out delay-150 path-0"></path><defs><linearGradient id="gradient" x1="35%" y1="98%" x2="65%" y2="2%"><stop offset="5%" stop-color="#453643"></stop><stop offset="95%" stop-color="#8ED1FC"></stop></linearGradient></defs><path d="M 0,400 L 0,0 C 47.26338419784015,115.37915219495531 94.5267683956803,230.75830438991062 137,271 C 179.4732316043197,311.2416956100894 217.15631061511897,276.34593463531286 258,261 C 298.84368938488103,245.65406536468714 342.8479891438441,249.8579570688379 381,259 C 419.1520108561559,268.1420429311621 451.45173280950485,282.2222370893356 489,268 C 526.5482671904952,253.77776291066442 569.3450796181367,211.25309457381996 609,200 C 648.6549203818633,188.74690542618004 685.1679487179487,208.7653846153846 723,210 C 760.8320512820513,211.2346153846154 799.9831255100685,193.68536696464162 836,199 C 872.0168744899315,204.31463303535838 904.8995492417773,232.49314752604903 947,244 C 989.1004507582227,255.50685247395097 1040.4186775228222,250.34204293116215 1082,249 C 1123.5813224771778,247.65795706883785 1155.4257406669326,250.13868074930247 1193,251 C 1230.5742593330674,251.86131925069753 1273.878359809448,251.1032340716279 1316,209 C 1358.121640190552,166.8967659283721 1399.060820095276,83.44838296418605 1440,0 L 1440,400 L 0,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="1" class="transition-all duration-300 ease-in-out delay-150 path-1"></path></svg>
    </main>
    <script src="myScripts.js"></script>
    <script src="scripts/music.js"></script>                   
</body>
</html>