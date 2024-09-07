<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:admin_login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Eliazar - admin</title>
        
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
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-light blur-bg-15px shadow-sm" id="stickyNavbar">
            <div class="container">
                <a class="pill bg-white4 text-decoration-none text-light border-0 Here" href="#" aria-current="page"><span class="fa fa-wrench me-2"></span> Contol panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item ps-3 ps-md-0 py-2 py-sm-0">
                            <a class="nav-link" href="index.html" target="_blank">Home</a>
                        </li>
                        <li class="nav-item ps-3 ps-md-0 py-2 py-sm-0">
                            <a class="nav-link" href="about.html" target="_blank">About</a>
                        </li>
                        <li class="nav-item ps-3 ps-md-0 py-2 py-sm-0">
                            <a class="nav-link" href="music.php" target="_blank">Music</a>
                        </li>
                        <li class="nav-item ps-3 ps-md-0 py-2 py-sm-0">
                            <a class="nav-link" href="services.html" target="_blank">Services</a>
                        </li>
                        <li class="nav-item ps-3 ps-md-0 py-2 py-sm-0">
                            <a class="nav-link" href="contact.html" target="_blank">Contact</a>
                        </li>
                    </ul>
                    <div class="navbar-nav ms-auto">
                        <a href="#" aria-current="page" class="border-0 Here">
                            <img src="assets/images/eliazar_logo-tranparent.png" alt="Profile Image" class="profile-img">
                        </a>
                        <li class="nav-item ps-3 ps-md-0 py-2 py-sm-0 ms-md-2 my-3 my-md-0">
                            <a class="nav-link text-warning ptr" href="#" data-dialog-toggle=".admin-logout-dialog"><span class="fa fa-sign-out-alt me-1"></span> Log out</a>
                        </li>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Welcome -->
        <div class="d-md-flex welcome-about">
            <div class="position-absolute w-100 inx--1 ptr-none">
                <!-- <svg id="wave" class="ptr-none" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 210" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="var(--secondaryClr)" offset="0%"></stop><stop stop-color="var(--secondaryClr)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,147L21.8,129.5C43.6,112,87,77,131,84C174.5,91,218,140,262,164.5C305.5,189,349,189,393,157.5C436.4,126,480,63,524,56C567.3,49,611,98,655,105C698.2,112,742,77,785,66.5C829.1,56,873,70,916,73.5C960,77,1004,70,1047,73.5C1090.9,77,1135,91,1178,105C1221.8,119,1265,133,1309,115.5C1352.7,98,1396,49,1440,52.5C1483.6,56,1527,112,1571,140C1614.5,168,1658,168,1702,150.5C1745.5,133,1789,98,1833,98C1876.4,98,1920,133,1964,154C2007.3,175,2051,182,2095,175C2138.2,168,2182,147,2225,126C2269.1,105,2313,84,2356,70C2400,56,2444,49,2487,45.5C2530.9,42,2575,42,2618,38.5C2661.8,35,2705,28,2749,52.5C2792.7,77,2836,133,2880,157.5C2923.6,182,2967,175,3011,147C3054.5,119,3098,70,3120,45.5L3141.8,21L3141.8,210L3120,210C3098.2,210,3055,210,3011,210C2967.3,210,2924,210,2880,210C2836.4,210,2793,210,2749,210C2705.5,210,2662,210,2618,210C2574.5,210,2531,210,2487,210C2443.6,210,2400,210,2356,210C2312.7,210,2269,210,2225,210C2181.8,210,2138,210,2095,210C2050.9,210,2007,210,1964,210C1920,210,1876,210,1833,210C1789.1,210,1745,210,1702,210C1658.2,210,1615,210,1571,210C1527.3,210,1484,210,1440,210C1396.4,210,1353,210,1309,210C1265.5,210,1222,210,1178,210C1134.5,210,1091,210,1047,210C1003.6,210,960,210,916,210C872.7,210,829,210,785,210C741.8,210,698,210,655,210C610.9,210,567,210,524,210C480,210,436,210,393,210C349.1,210,305,210,262,210C218.2,210,175,210,131,210C87.3,210,44,210,22,210L0,210Z"></path></svg> -->

                <svg width="100%" height="100%" id="svg" viewBox="0 0 1440 390" xmlns="http://www.w3.org/2000/svg" class="transition duration-300 ease-in-out delay-150"><defs><linearGradient id="gradient" x1="35%" y1="98%" x2="65%" y2="2%"><stop offset="5%" stop-color="#453643"></stop><stop offset="95%" stop-color="#8ED1FC"></stop></linearGradient></defs><path d="M 0,400 L 0,0 C 43.79242631289263,60.31577843572663 87.58485262578526,120.63155687145326 130,145 C 172.41514737421474,169.36844312854674 213.45301580975155,157.78955094991366 252,144 C 290.54698419024845,130.21044905008634 326.60308413520846,114.21023932889219 361,105 C 395.39691586479154,95.78976067110781 428.1346476494145,93.36949173451765 465,94 C 501.8653523505855,94.63050826548235 542.8583252671335,98.31179373303725 590,106 C 637.1416747328665,113.68820626696275 690.4320512820512,125.38333333333333 734,121 C 777.5679487179488,116.61666666666667 811.4134696046614,96.1548729336294 844,78 C 876.5865303953386,59.84512706637059 907.9140702993034,43.997174932149015 947,53 C 986.0859297006966,62.002825067850985 1032.9302491981248,95.8564273377745 1076,116 C 1119.0697508018752,136.1435726622255 1158.364932908197,142.577115716753 1197,145 C 1235.635067091803,147.422884283247 1273.6100191690866,145.83510979521344 1314,121 C 1354.3899808309134,96.16489020478657 1397.1949904154567,48.08244510239329 1440,0 L 1440,400 L 0,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="0.53" class="transition-all duration-300 ease-in-out delay-150 path-0" transform="rotate(-180 720 200)"></path><defs><linearGradient id="gradient" x1="35%" y1="98%" x2="65%" y2="2%"><stop offset="5%" stop-color="#453643"></stop><stop offset="95%" stop-color="#8ED1FC"></stop></linearGradient></defs><path d="M 0,400 L 0,0 C 50.91206893279433,103.52692877071115 101.82413786558865,207.0538575414223 135,232 C 168.17586213441135,256.9461424585777 183.61551747043973,203.31149860502194 220,198 C 256.3844825295603,192.68850139497806 313.71379225265235,235.70014803849 361,252 C 408.28620774734765,268.29985196151 445.52931351895086,257.88790924101806 484,244 C 522.4706864810491,230.11209075898196 562.1689536715444,212.7482149974378 604,212 C 645.8310463284556,211.2517850025622 689.7948717948717,227.11923076923074 734,243 C 778.2051282051283,258.88076923076926 822.6515591489685,274.77486192563913 853,274 C 883.3484408510315,273.22513807436087 899.5988916092543,255.78132152821274 937,237 C 974.4011083907457,218.21867847178726 1032.952874414014,198.09985196150996 1083,187 C 1133.047125585986,175.90014803849004 1174.5896107346887,173.81927062574732 1212,190 C 1249.4103892653113,206.18072937425268 1282.6886826472319,240.62306553550076 1320,212 C 1357.3113173527681,183.37693446449924 1398.655658676384,91.68846723224962 1440,0 L 1440,400 L 0,400 Z" stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="1" class="transition-all duration-300 ease-in-out delay-150 path-1" transform="rotate(-180 720 200)"></path></svg>
            </div>
            
            <div class="d-none d-md-block col-md-6 overflow-hidden">
                <img src="assets/images/eliazar_n-transparent.png" alt="My photo" class="object-fit-cover" style="mask-image: linear-gradient(black, black, var(--black3) 90%, transparent); animation: slideInBottom 1s 1;">
            </div>
            <section class="container mx-md-4" style="--primaryClr: #3576cb">
                <h1 class="display-5 mb-5 pt-md-5 text-center small-title item-primaryClr text-primaryClr fw-bold">Music dashboard</h1>
                <p class="fs-4 mx-3 mx-md-0 mb-4">
                    Manage all compositions from below. This panel provides you with the tools to organize, edit, add or remove any compositions according to your requirements.
                </p>
                <a href="#my-compositions" class="btn btn-lg pill mx-2 my-2 bg-primaryClr text-light bounceClick"><span class="fa fa-list me-2"></span> Manage compositions</a>
                <a href="#add-composition" class="btn btn-lg pill mx-2 my-2 bg-primaryClr text-light bounceClick"><span class="fa fa-plus me-2"></span> Add composition</a>
                <a href="music.php" target="_blank" class="btn btn-lg pill mx-2 my-2 bg-primaryClr text-light bounceClick"><span class="fa fa-angle-right me-2"></span> Go to music</a>
            </section>
        </div>
        <div class="container col-lg-8">
            <p class="px-2 py-5 text-secondaryClr">
                " <b>Welcome to your blog!</b> As an administrator, you hold the keys to unlock the full potential of your platform. Within the dashboard, you can shape the very essence of your blog, from curating captivating content to fine-tuning the user experience. With every click and configuration, you're sculpting a digital masterpiece that reflects your vision and resonates with your audience. This is your domain, your canvas, your stage - <b>let's dive in and bring your blog to life!</b> "
            </p>
        </div>
        
        <!-- Songs statistics -->
        <section class="container mb-5" id="songs-dashboard">
            <?php
            include 'connect.php';
            
            // Fetch existing songs
            $query = "SELECT * FROM compositions";
            $result = mysqli_query($conn, $query);
            
            $currentYear = date("Y");
            // Initialize counters
            $totalSongs = 0;
            $videoSongs = 0;
            $audioSongs = 0;
            $songsFromCurrentYear = 0;

            // Check if there are any rows returned
            if (mysqli_num_rows($result) > 0) {
                // Loop through the rows
                while ($row = mysqli_fetch_assoc($result)) {
                    $totalSongs++;
                    // Check if the song is from the current year
                    if ($row["songDateYear"] == $currentYear) {
                        $songsFromCurrentYear++;
                    }
                    // Check for video link
                    if (!empty($row["songVideoLink"])) {
                        $videoSongs++;
                    }
                    // Check for audio link
                    if (!empty($row["songAudioLink"])) {
                        $audioSongs++;
                    }
                }
            }
            ?>
            
            <!-- Display statistics -->
            <div class="mb-3 d-flex flex-wrap">
                <div class="col-6 col-md-4 col-lg-3 mb-3 mx-0 px-2">
                    <div class="d-grid justify-content-center mx-0 p-3 rad-10 border border-3" data-bs-toggle="offcanvas" data-bs-target="#shortStatistics" onclick="$('.show-all-list').trigger('click')">
                        <span class="fs-6">All songs</span>
                        <span class="display-3 mx-auto text-primaryClr ptr"><?php echo $totalSongs; ?></span>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-3 mx-0 px-2">
                    <div class="d-grid justify-content-center mx-0 p-3 rad-10 border border-3" data-bs-toggle="offcanvas" data-bs-target="#shortStatistics" onclick="$('.show-video-list').trigger('click')">
                        <span class="fs-6">Video songs</span>
                        <span class="display-3 mx-auto text-primaryClr ptr"><?php echo $videoSongs; ?></span>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-3 mx-0 px-2">
                    <div class="d-grid justify-content-center mx-0 p-3 rad-10 border border-3" data-bs-toggle="offcanvas" data-bs-target="#shortStatistics" onclick="$('.show-audio-list').trigger('click')">
                        <span class="fs-6">Audio songs</span>
                        <span class="display-3 mx-auto text-primaryClr ptr"><?php echo $audioSongs; ?></span>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-3 mx-0 px-2">
                    <div class="d-grid justify-content-center mx-0 p-3 rad-10 border border-3" data-bs-toggle="offcanvas" data-bs-target="#shortStatistics"onclick="$('.show-new-list').trigger('click')">
                        <span class="fs-6">New (this year)</span>
                        <span class="display-3 mx-auto text-primaryClr ptr"><?php echo $songsFromCurrentYear; ?></span>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- All songs -->
        <section class="container mb-5" id="my-compositions">
            <h2 class="fs-1 fw-bold py-2 section-title">List of compositions <span class="badge rounded-pill bg-primaryClr"><?php echo $totalSongs; ?></span></h2>
            <p class="px-4 fs-5">
                You have full control over all compositions listed below. Each song is accompanied by a set of options that allow you to perform actions like editing, getting links, and removing corresponding composition based on your needs and preferences.
            </p>
            <!-- Jumper / side-tools -->
            <div class="d-flex item-secondaryClr rad-10 side-tools">
                <button class="fa fa-indent btn rad-10 blur-bg-10px bounceClick side-tools_toggler" data-bs-toggle="tooltip" title="Jump to"></button>
                <div class="ms-2 flex-grow-1 flex-shrink-0 collapsible-grid-x side-tools_items">
                    <div class="d-flex gap-2 collapsing-content">
                        <a href="#my-compositions" class="fa fa-list btn flex-center side-tools-item" data-bs-toggle="tooltip" title="Manage compositions"></a>
                        <a href="#add-composition" class="fa fa-plus btn flex-center side-tools-item" data-bs-toggle="tooltip" title="Add composition"></a>
                    </div>
                </div>
            </div>
            
            <!-- Display existing songs -->
            <!-- DB connector -->
            <?php
            include 'connect.php';
            // Query to fetch existing songs sorted by date in descending order
            $query = "SELECT * FROM compositions ORDER BY songDateYear DESC, STR_TO_DATE(CONCAT(songDateYear, '-', songDateMonth, '-', songDateDay), '%Y-%m-%d') DESC";
            $result = mysqli_query($conn, $query);
            
            // Check if there are any rows returned
            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result) > 2) {
                    // Show song searcher
                    echo '<div class="position-sticky inx-5 bg-body rad-100vw mx-3 mx-sm-5 col-lg-8 mx-lg-auto shadow" style="top: 3.7rem">';
                    echo     '<div class="position-relative mt-5 mb-3 p-1 target-input border-3 search-box">';
                    echo         '<span class="fa fa-search grid-center"></span>';
                    echo         '<input type="text" placeholder="Find a composition" class="borderless search-box__input">';
                    echo    ' </div>';
                    echo '</div>';
                    // Show filter
                    $years = "SELECT DISTINCT songDateYear FROM compositions ORDER BY songDateYear DESC";
                    $yearsResult = mysqli_query($conn, $years);
                    echo '<ul class="mb-4 list-flexible px-3 collapse show active-options composition-years" id="compositionFilterAdmin">';
                    echo '    <li class="px-3 py-1 show-all active" data-bs-toggle="tooltip" data-bs-html="true" title="<span class=\'kbd bg-white3 text-light\'>alt</span> + <span class=\'kbd bg-white3 text-light\'>r</span>" onclick="reset_filter_admin()">All</li>';
                    while ($row = mysqli_fetch_assoc($yearsResult)) {
                        echo '    <li class="px-3 py-1">' . $row['songDateYear'] . '</li>';
                    }
                    echo '</ul>';
                    echo <<<HTML
                    <div class="px-3 mb-3">
                        <button class="btn btn-sm border border-2" data-bs-toggle="dropdown" id="moreCompositionTools" aria-expanded="false"><span class="fa fa-tools me-2 text-muted"></span> More tools <span class="fa fa-angle-down ms-2 text-muted"></span></button>
                        <ul class="dropdown-menu me-3 me-sm-0 my-dropdown" aria-labelledby="moreCompositionTools">
                            <li data-bs-toggle="collapse" data-bs-target=".composition-details">
                                <a class="dropdown-item d-flex align-items-center" href="#"><span class="fa fa-eye me-3"></span> Hide/show details</a>
                            </li>
                            <li onclick="reset_filter_admin(), show_toast(3000, 'Songs refreshed');">
                                <a class="dropdown-item d-flex align-items-center" href="#"><span class="fa fa-refresh me-3"></span> Unfilter <b class="ms-1">(alt + r)</b></a>
                            </li>
                        </ul>
                     </div>
                    HTML;
                }
                echo '<div class="d-lg-flex flex-wrap">';
                // Loop through the rows to display each song
                while ($row = mysqli_fetch_assoc($result)) {
                    // map month numbers to month names
                    $monthNames = [
                        '1' => 'January',
                        '2' => 'February',
                        '3' => 'March',
                        '4' => 'April',
                        '5' => 'May',
                        '6' => 'June',
                        '7' => 'July',
                        '8' => 'August',
                        '9' => 'September',
                        '10' => 'October',
                        '11' => 'November',
                        '12' => 'December'
                    ];                
                    // Get the month name
                    $monthName = $monthNames[$row["songDateMonth"]];
                    // Diplay song details
                    echo '<div class="col-lg-6 mb-4 p-lg-3">';
                    echo '    <div class="p-3 rad-15 music-element">';
                    echo '        <h4 class="mb-3 d-flex flex-space-between composition-title">';
                    echo '            <span class="fs-3 notranslate">' . $row["songName"] . '</span>';
                    echo '            <div class="rad-3 my-item-header__icons">';
                    echo '                <button class="fa fa-ellipsis-v" data-menu-toggle=".composition-cont-menu"></button>';
                    echo '            </div>';
                    echo '        </h4>';
                    echo '        <div class="mx-4 composition-details collapse show">';
                    echo '            <h6>Composed on:</h6>';
                    echo '            <div class="d-flex mb-3 fw-bold composition-date">';
                    echo '                <span class="col-2 composed-day">' . $row["songDateDay"] . '</span>';
                    echo '                <span class="col-4 composed-month">' . $monthName . '</span>';
                    echo '                <span class="col-3 composed-year">' . $row["songDateYear"] . '</span>';
                    echo '            </div>';
                    echo '            <h6 class="p-2 clickDown ptr bg-black4 toggle-next">Song about</h6>';
                    echo '            <div class="my-3 p-2 fst-italic small collapse notranslate composition-about">';
                    echo '                ' . $row["songAbout"];
                    echo '            </div>';
                    echo '            <h6 class="p-2 clickDown ptr bg-black4 toggle-next">File link</h6>';
                    echo '            <div class="my-3 p-2 fst-italic text-truncate small collapse composition-file">';
                    echo '                ' . $row["songFileLink"];
                    echo '            </div>';
                    if (empty($row["songAudioLink"])) {
                        echo '            <h6 class="p-2 clickDown ptr bg-black4 toggle-next">Audio file <span class="fa fa-close ms-3"></span></h6>';
                        echo '            <div class="my-3 p-2 fst-italic text-danger text-truncate small collapse composition-audio">';
                        echo '                No audio provided';
                        echo '            </div>';
                    } else {
                        echo '            <h6 class="p-2 clickDown ptr bg-black4 toggle-next">Audio file</h6>';
                        echo '            <div class="my-3 p-2 fst-italic text-truncate small collapse composition-audio">';
                        echo '                ' . basename($row["songAudioLink"]);
                        echo '            </div>';
                    }
                    if (empty($row["songVideoLink"])) {
                        echo '            <h6 class="p-2 clickDown ptr bg-black4 toggle-next">Video link <span class="fa fa-close ms-3"></span></h6>';
                        echo '            <div class="my-3 p-2 fst-italic text-danger text-truncate small collapse composition-video">';
                        echo '                No link provided';
                        echo '            </div>';
                    } else {
                        echo '            <h6 class="p-2 clickDown ptr bg-black4 toggle-next">Video link</h6>';
                        echo '            <div class="my-3 p-2 fst-italic text-truncate small collapse composition-video">';
                        echo '                ' . $row["songVideoLink"];
                        echo '            </div>';
                    }
                    echo '        </div>';
                    echo '            <button class="btn btn-sm btn-secondary mx-auto mt-3 rad-10 clickDown deselect-composition" style="font-size: 70%;">Deselect</button>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                // No songs found
                echo '<div class="mb-4 p-lg-3">No compositions found. Below, you can start uploading your compositions</div>';
            }
            echo '</div>';
            // Close the connection
            mysqli_close($conn);
            ?>

            <!-- Song options -->
            <div class="rad-7 my-cont-menu composition-cont-menu">
                <ul>
                    <li class="rad-100vw m-2 bg-white3 composition-data-editor" data-totoggle=".song-editor"><span class="fa fa-pen w-25px mr-2"></span>Edit</li>
                    <hr class="my-1">
                    <li class="border-0 composition-file-previewer"><span class="fa fa-eye w-25px mr-2"></span> Preview</li>
                    <li class="border-0 composition-flink-copier"><span class="fa fa-link w-25px mr-2"></span> Copy file link</li>
                    <li class="border-0 composition-vlink-copier"><span class="fa fa-film w-25px mr-2"></span> Copy video link</li>
                    <hr class="my-1">
                    <li class="border-0 rad-100vw m-2 composition-removal" data-dialog-toggle=".composition-removal-dialog" style="background-color: rgba(220, 53, 69, .4)"><span class="fa fa-trash-alt w-25px mr-2"></span> Remove</li>
                </ul>
            </div>

            <!-- Song removal -->
            <div class="my-dialog self-close composition-removal-dialog" style="background-color: rgba(220, 53, 69, .2);">
                <div class="col-11 col-sm-8 col-md-6 col-lg-4  bg-danger text-light my-dialog-content">
                    <h5><span class="fa fa-warning"></span> Warning: Removing Composition</h5>
                    <p class="p-3">
                        If removed, "<span class="fw-bold selected-composition-name">This composition</span>" will not appear in the list of compositions unless you add it once again. Do you want to preceed?
                    </p>
                    <div class="my-dialog-buttons">
                        <button class="btn btn-outline-dark clickDown show-touch my-dialog-closer">Cancel <span class="touch-anim d-md-none"></span></button>
                        <button class="btn btn-danger d-flex gap-3 justify-content-center clickDown show-touch" id="removeCompositionBtn">Yes, remove <span class="touch-anim d-md-none"></span></button>
                    </div>
                </div>
            </div>

            <!-- Song editor -->
            <!-- Form for edditing a composition -->
            <div class="fix-holder fix-holder-black2 pt-5 overflow-auto blur-bg-1px song-editor">
                <form action="edit_composition.php" method="post" enctype="multipart/form-data" class="position-relative isolate p-3 p-sm-4 col-sm-8 col-lg-5 mx-auto mb-sm-3 rad-15 overflow-hidden bg-light shadow" style="animation: flyInBottomSM .5s 1;" id="currentSongEditor">
                    <div class="position-absolute w-100 inx--1" style="bottom: -8px; left: 0;">
                        <svg id="wave" class="ptr-none" style="transition: 0.3s" viewBox="0 0 1440 210" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-1" x1="0" x2="0" y1="1" y2="0"><stop stop-color="var(--bs-success)" offset="0%"></stop><stop stop-color="rgba(25, 135, 84, .3)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-1)" d="M0,147L21.8,129.5C43.6,112,87,77,131,84C174.5,91,218,140,262,164.5C305.5,189,349,189,393,157.5C436.4,126,480,63,524,56C567.3,49,611,98,655,105C698.2,112,742,77,785,66.5C829.1,56,873,70,916,73.5C960,77,1004,70,1047,73.5C1090.9,77,1135,91,1178,105C1221.8,119,1265,133,1309,115.5C1352.7,98,1396,49,1440,52.5C1483.6,56,1527,112,1571,140C1614.5,168,1658,168,1702,150.5C1745.5,133,1789,98,1833,98C1876.4,98,1920,133,1964,154C2007.3,175,2051,182,2095,175C2138.2,168,2182,147,2225,126C2269.1,105,2313,84,2356,70C2400,56,2444,49,2487,45.5C2530.9,42,2575,42,2618,38.5C2661.8,35,2705,28,2749,52.5C2792.7,77,2836,133,2880,157.5C2923.6,182,2967,175,3011,147C3054.5,119,3098,70,3120,45.5L3141.8,21L3141.8,210L3120,210C3098.2,210,3055,210,3011,210C2967.3,210,2924,210,2880,210C2836.4,210,2793,210,2749,210C2705.5,210,2662,210,2618,210C2574.5,210,2531,210,2487,210C2443.6,210,2400,210,2356,210C2312.7,210,2269,210,2225,210C2181.8,210,2138,210,2095,210C2050.9,210,2007,210,1964,210C1920,210,1876,210,1833,210C1789.1,210,1745,210,1702,210C1658.2,210,1615,210,1571,210C1527.3,210,1484,210,1440,210C1396.4,210,1353,210,1309,210C1265.5,210,1222,210,1178,210C1134.5,210,1091,210,1047,210C1003.6,210,960,210,916,210C872.7,210,829,210,785,210C741.8,210,698,210,655,210C610.9,210,567,210,524,210C480,210,436,210,393,210C349.1,210,305,210,262,210C218.2,210,175,210,131,210C87.3,210,44,210,22,210L0,210Z"></path></svg>
                    </div>
                
                    <div class="fs-4">Editing "<span class="fw-bold selected-composition-name">This composition</span>"</div>
                    <button type="reset" class="btn text-danger d-block col-4 mx-auto mt-2 border-danger clickDown hide-par-fix"><span class="fa fa-close me-2"></span> Discard</button>
                    <hr class="hr-md mb-5">
                    <div class="col-md-10 mx-auto my-3" id="editor">
                        <div class="mb-3 d-none">
                            <label for="oldSName" class="form-label fw-bold">Editing</label>
                            <input type="text" name="current_song_name" required class="form-control" id="oldSName" placeholder="Current song name">
                        </div>
                        <div class="mb-3">
                            <label for="sName" class="form-label fw-bold">Song name</label>
                            <input type="text" name="song_name" required class="form-control" style="border-color: var(--primaryClr); height: 3.5rem;" id="sName" placeholder="Eg: Nyirubutagatifu">
                        </div>
                        <div class="mb-3">
                            <label for="sDateYear" class="form-label fw-bold">Date composed/trans/harm</label>
                            <div class="d-flex justify-content-between">
                                <input type="number" maxlength="4" name="song_date_year" required class="form-control" style="width: 33%" id="sDateYear" placeholder="Year">
                                <select name="song_date_month" required class="form-select" style="width: 33%" id="sDateMonth">
                                    <option value="" class="p-2">Month</option>
                                    <option value="01" class="p-2">January</option>
                                    <option value="02" class="p-2">February</option>
                                    <option value="03" class="p-2">March</option>
                                    <option value="04" class="p-2">April</option>
                                    <option value="05" class="p-2">May</option>
                                    <option value="06" class="p-2">June</option>
                                    <option value="07" class="p-2">July</option>
                                    <option value="08" class="p-2">August</option>
                                    <option value="09" class="p-2">September</option>
                                    <option value="10" class="p-2">October</option>
                                    <option value="11" class="p-2">November</option>
                                    <option value="12" class="p-2">December</option>
                                </select>
                                <input type="number" maxlength="2" name="song_date_day" required class="form-control" style="width: 33%" id="sDateDay" placeholder="Day">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sFileLink" class="form-label fw-bold">File link</label>
                            <input type="text" name="song_file_link" required class="form-control" id="sFileLink" placeholder="Enter shared file's link" onfocus="this.select()">
                        </div>
                        <div class="mb-3">
                            <label for="sAbout" class="form-label fw-bold">Song about</label>
                            <textarea maxlength="250" name="song_about" required id="sAbout" cols="30" rows="3" class="p-3 w-100" placeholder="Enter a short message about the song"></textarea>
                        </div>
                        <div class="mb-3 collapse change-audio-file">
                            <label class="form-label fw-bold ptr toggle-next">Change audio file <span class="fa fa-file-audio ms-3"></span></label>
                            <p id="audioHelp" class="form-text collapse alert alert-warning">
                                This will remove the existing audio file for this composition. Click <b>Remove audio</b> to continue, or <b>Cancel</b> to abort the action.
                                <span class="flex-space-between mt-2">
                                    <span class="col-4 btn btn-sm btn-warning" data-bs-toggle="collapse" data-bs-target="#audioHelp.alert-warning">Cancel</span>
                                    <span class="col-7 btn btn-sm border border-warning" id="removeCompositionAudio">Remove Audio</span>
                                </span>                                
                            </p>
                        </div>
                        <div class="mb-3 collapse add-audio-file">
                            <label for="songAudio" class="form-label fw-bold">Audio file (optional)</label>
                            <input type="file" name="song_audio" class="form-control h-auto" id="songAudio" accept="audio/mp3, audio/wav, audio/ogg">
                            <div id="audioHelp" class="form-text">Only MP3, WAV, or OGG files. <u>Max 7MB in size</u></div>
                        </div>
                        <div class="mb-3">
                            <label for="sYoutubeLink" class="form-label fw-bold">Youtube link (optional)</label>
                            <input type="text" name="song_video_link" class="form-control" id="sYoutubeLink" placeholder="Enter song's video link">
                        </div>
                        <div class="p-4" style="background-color: rgba(255, 193, 7, .4)">
                            <h6 class="text-decoration-underline">Reminder</h6>
                            <p>
                                Take a moment to confirm the <b>song's name</b> spelling before you proceed. It's important that it aligns correctly with the title of your composition.
                            </p>
                            <div class="d-flex gap-2 align-items-center">
                                <label for="confirmCheck" class="form-label fw-bold m-0">I have checked</label>
                                <input type="checkbox" name="confirm_check" require class="ms-3" id="confirmCheck" style="width: 1rem; height: 1rem;">
                            </div>
                        </div>
                        <div class="my-5 d-flex justify-content-between">
                            <button type="reset" class="btn text-danger col-4 border-danger clickDown hide-par-fix"><span class="fa fa-close me-2"></span> Discard</button>
                            <button type="submit" class="btn btn-lg btn-success col-7 clickDown" id="songEditorBTN"><span class="fa fa-check-circle me-3"></span> Update</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Song preview -->
            <div class="fix-holder fix-holder-appColor2_cons blur-bg-2px composition-iframe-viewer">
                <div class="dim-100 item-dark p-md-3 iframe-viewer">
                    <div class="col-md-8 iframe-viewer_body">
                        <div class="position-absolute inx--1 flex-center visible-y bg-transparent Loading_fix">
                            <div class="grid-center Loading_fix visible-y">
                                <div class="loading-motion-circle"></div>
                            </div>
                        </div>
                        <iframe src="" frameborder="0" class="dim-100"></iframe>
                    </div>
                    <div class="col-md-4 my-item iframe-viewer_actions">
                        <div class="my-item-header">
                            <h4 class="my-item-header__title">Song preview</h4>
                            <div class="me-3 me-md-0 p-1 my-item-header__icons">
                                <button class="fa fa-ellipsis-v rad-50 preview-cont-menu" title="Options" data-menu-toggle=".composition-cont-menu"></button>
                                <button class="fa fa-close rad-50 hide-par-fix item-closer" title="Close (q)" onclick="hide_preview()"></button>
                            </div>
                        </div>
                        <div class="my-item-body">
                            <span class="fa fa-file-pdf flex-center"></span>
                            <div class="d-flex flex-wrap justify-content-center gap-1 py-3 iframe-file-actions">
                                <button class="hide-par-fix composition-file-downloader">Download</button>
                                <button class="hide-par-fix composition-flink-copier">Copy link</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        
        <!-- Adding a new song  -->
        <section class="container mb-5" id="add-composition">
            <h2 class="fs-1 fw-bold py-2 section-title">Add composition</h2>
            <div class="my-5 shadow">
                <div class="d-lg-flex p-4 p-lg-5">
                    <article class="pe-lg-5 mb-4 mb-lg-0">
                        <h4 class="mb-3 small-title">Add a new song</h4>
                        <p>
                            Here, you can add songs to your list of compositions. Simply type the song's name <b>(excluding your own)</b> in the provided space, enter the date it was composed/transcripted/harmonised,..., and provide a shared <b>Google Drive file link</b> for the song. Make sure the song is not already on the list before uploading it. Additionally, include a brief message about it, and if available, upload it's audio file and/or provide the song's YouTube link.
                        </p>
                    </article>
                    <button class="btn btn-lg bg-primaryClr text-light d-block mx-auto py-lg-4 align-self-center clickDown" style="min-width: 15rem;" id="startUpload">Proceed <span class="fa fa-plus ms-3"></span></button>
                </div>
                <!-- Form for adding a new composition -->
                <div class="p-2 p-sm-4 collapse new-song-upload-space">
                    <hr class="hr-lg mb-5">
                    <div class="d-lg-flex">
                        <form action="add_composition.php" method="post" enctype="multipart/form-data" class="col-md-10 col-lg-5 mx-auto mx-lg-0 d-block" id="newSongUploader">
                            <div class="my-3" id="uploader">
                                <div class="mb-3">
                                    <label for="sName" class="form-label fw-bold">Song name</label>
                                    <input type="text" name="song_name" required class="form-control" style="border-color: var(--primaryClr); height: 3.5rem;" id="sName" placeholder="Eg: Nyirubutagatifu">
                                </div>
                                <div class="mb-3">
                                    <label for="sDateYear" class="form-label fw-bold">Date composed/trans/harm</label>
                                    <div class="d-flex justify-content-between">
                                        <input type="number" maxlength="4" name="song_date_year" required class="form-control" style="width: 33%" id="sDateYear" placeholder="Year">
                                        <select name="song_date_month" required class="form-select" style="width: 33%" id="sDateMonth">
                                            <option value="" class="p-2">Month</option>
                                            <option value="01" class="p-2">January</option>
                                            <option value="02" class="p-2">February</option>
                                            <option value="03" class="p-2">March</option>
                                            <option value="04" class="p-2">April</option>
                                            <option value="05" class="p-2">May</option>
                                            <option value="06" class="p-2">June</option>
                                            <option value="07" class="p-2">July</option>
                                            <option value="08" class="p-2">August</option>
                                            <option value="09" class="p-2">September</option>
                                            <option value="10" class="p-2">October</option>
                                            <option value="11" class="p-2">November</option>
                                            <option value="12" class="p-2">December</option>
                                        </select>
                                        <input type="number" maxlength="2" name="song_date_day" required class="form-control" style="width: 33%" id="sDateDay" placeholder="Day">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="sFileLink" class="form-label fw-bold">File link</label>
                                    <input type="text" name="song_file_link" required class="form-control" id="sFileLink" placeholder="Enter shared file's link">
                                </div>
                                <div class="mb-3">
                                    <label for="sAbout" class="form-label fw-bold">Song about</label>
                                    <textarea maxlength="250" name="song_about" required id="sAbout" cols="30" rows="3" class="p-3 w-100" placeholder="Enter a short message about the song"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="songAudio" class="form-label fw-bold">Audio file (optional)</label>
                                    <input type="file" name="song_audio" class="form-control h-auto" id="songAudio" accept="audio/mp3, audio/wav, audio/ogg">
                                    <div id="audioHelp" class="form-text">Only MP3, WAV, or OGG files. <u>Max 7MB in size</u></div>
                                </div>
                                <div class="mb-3">
                                    <label for="sYoutubeLink" class="form-label fw-bold">Youtube link (optional)</label>
                                    <input type="text" name="song_video_link" class="form-control" id="sYoutubeLink" placeholder="Enter song's video link">
                                </div>
                                <div class="p-4" style="background-color: rgba(255, 193, 7, .4)">
                                    <h6 class="text-decoration-underline">Reminder</h6>
                                    <p>
                                        Take a moment to confirm the <b>song's name</b> spelling before you proceed. It's important that it aligns correctly with the title of your composition.
                                    </p>
                                    <div class="d-flex gap-2 align-items-center">
                                        <label for="confirmCheck" class="form-label fw-bold m-0">I have checked</label>
                                        <input type="checkbox" name="confirm_check" require class="ms-3" id="confirmCheck" style="width: 1rem; height: 1rem;">
                                    </div>
                                </div>
                                <div class="my-5 d-flex justify-content-between">
                                    <button type="reset" class="btn text-danger col-4 border-danger clickDown" data-bs-toggle="collapse" data-bs-target=".new-song-upload-space" onclick="$('#directFilePreview iframe').attr('src', '')"><span class="fa fa-close me-2"></span> Discard</button>
                                    <button type="submit" class="btn btn-lg btn-success col-7 clickDown" id="newSongUploadBTN"><span class="fa fa-cloud-upload me-2"></span> Add song</button>
                                </div>
                            </div>
                        </form>
                        <div class="d-lg-flex flex-column col-lg-7 p-sm-4" id="directFilePreview">
                            <div class="alert alert-info">If your file link is valid, a preview will appear below.</div>
                            <div class="flex-grow-1 d-grid border border-2 border-black4" style="background: url('assets/images/file_preview.jpg') center top no-repeat; min-height: 80vh;">
                                <iframe src="" frameborder="0" class="dim-100"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Brief statistics -->
        <div class="offcanvas offcanvas-start bg-secondaryClr text-light blur-bg-5px" id="shortStatistics">
            <div class="py-2 offcanvas-header">
                <h3 class="offcanvas-title">Classifications</h3>
                <button type="button" class="btn-close text-reset bg-white3" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="overflow-hidden offcanvas-body" style="border-radius: 1rem 1rem 0 0; animation: flyInBottom 2s 1; max-height: 90vh;">
                <div class="d-md-flex h-100 stats">
                    <div class="active-options stats-icons">
                        <button class="border-0 clickDown show-all-list active">All</button>
                        <button class="fa fa-headphones border-0 clickDown show-audio-list"></button>
                        <button class="fa fa-video border-0 clickDown show-video-list"></button>
                        <button class="border-0 clickDown show-new-list">New</button>
                    </div>
                    <div class="p-3 Sbar-sm-low-opacity stats-body">
                        <h6 class="text-warning"><span class="stats-title">All songs</span> <span class="badge bg-warning stats-counter ms-2"></span> </h6>
                        <hr>
                        <ul class="my-list list-unstyled">
                            <!-- Filtered list -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Logging out -->
        <div class="my-dialog self-close bg-black3 admin-logout-dialog">
            <div class="col-11 col-sm-8 col-md-6 col-lg-4 bg-bodi my-dialog-content">
                <h5><span class="fa fa-sign-out-alt"></span> Logging out</h5>
                <p class="p-3 text-center">
                    You want to log out?
                </p>
                <div class="my-dialog-buttons">
                    <button class="btn btn-light clickDown show-touch my-dialog-closer">
                        No, stay <span class="touch-anim d-md-none"></span>
                    </button>
                    <button class="btn btn-outline-dark position-relative d-flex gap-3 justify-content-center clickDown show-touch">
                        <a href="admin_logout.php" class="text-decoration-none flex-center position-absolute inset-0">
                        Log out</a> <span class="touch-anim d-md-none"></span>
                    </button>
                </div>
            </div>
        </div>
        <!-- sticky to-top  -->
        <div class="position-fixed bottom-right-m h-50px w-50px inx-5 bg-navi1 rad-7 flex-center ToTop-fixed"><span class="fa fa-angle-double-up"></span></div>
    </main>
    
    <!-- Footer -->
    <div class="footer-top w-100 h-10vh bg-secondaryClr"></div>
    <footer>
        <button class="fa fa-angle-up p-3 toTop border" style="border-color: var(--white4) !important"></button>
        <div class="d-lg-flex py-5 justify-content-around flex-row-reverse container-lg">
            <div class="align-self-center ">
                <h6 class="fs-4 text-center">Follow me</h6>
                <div class="d-flex flex-wrap justify-content-center social-media-icons">
                    <a href="https://www.youtube.com/@ririmbamediaeliazar" class="btn btn-lg pill mx-2 my-2 bg-primaryClr text-light bounceClick" target="_blank" title="My instagram"><span class="fab fa-youtube"></span></a>
                    <a href="https://twitter.com/Eliazarmusicien" class="btn btn-lg pill mx-2 my-2 bg-primaryClr text-light bounceClick" target="_blank" title="My Twitter"><span class="fab fa-x-twitter"></span></a>
                    <a href="https://www.facebook.com/eliazar.ndayisabye" class="btn btn-lg pill mx-2 my-2 bg-primaryClr text-light bounceClick" target="_blank" title="My Facebook"><span class="fab fa-facebook"></span></a>
                </div>
            </div>
            <nav class="flex-grow-1 p-4">
                <ul class="list-unstyled">
                    <li class="py-2"><a href="index.html" target="_blank">Home</a></li>
                    <li class="py-2"><a href="music.php" target="_blank">Music</a></li>
                    <li class="py-2"><a href="contact.html" target="_blank">Contact</a></li>
                </ul>
            </nav>
            <div class="d-sm-flex flex-wrap">
                <strong class="d-block col-sm-6 py-3 align-self-center p-3 border-end" style="white-space: nowrap;">©️ <span class="copyright-year">2024</span> Eliazar N.</strong>
                <strong class="d-block col-sm-6 py-3 align-self-center p-3" style="white-space: nowrap;"><span class="fa fa-map-marker-alt me-3"></span> Kigali - Rwanda</span></strong>
            </div>
        </div>
        <div class="pb-3 text-center text-muted small powered-by">
            <span class="fa fa-code me-1"></span> Powered by <a href="https://hirwa9.github.io" target="_blank" class=" text-muted"><strong>Hirwa</strong></a>
        </div>
    </footer>
    
    <style>
        .stats {
            --measure: 3rem;
        }
        .stats > .stats-icons {
            display: flex;
            justify-content: space-between;
        }
        .stats > .stats-icons > * {
            height: var(--measure);
            background-color: transparent;
            color: var(--bs-light);
            flex-grow: 1;
        }
        .stats > .stats-icons > .active {
            border-radius: .5rem;
            background-color: var(--white3);
            color: var(--bs-warning);
            font-weight: bold;
        }
        .stats > .stats-body {
            height: 100%;
            overflow-y: auto;
        }
        @media screen and (min-width: 768px) {
            .stats > .stats-icons {
                display: block;
                flex-shrink: 0;
                flex-basis: var(--measure);
            }
            .stats > .stats-icons > * {
                width: 100%;
            }
            .stats > .stats-body {
                width: calc(100% - var(--measure));
            }
        }
        @media screen and (min-width: 1200px) {
            .stats {
                --measure: 5rem;
            }
            .stats > .stats-body {
                border-radius: 0 1rem 1rem 0;
            }
        }
        .stats .stats-body ul {
            overflow: hidden;
        }
        .stats-body > ul > li {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    </style>
    <script src="myScripts.js"></script>
    <script src="scripts/music.js"></script>
    <script>
        // Uploading a song
        $('#startUpload').click(function () {
            $('.new-song-upload-space').collapse('show');
            scroll_page_to($('.new-song-upload-space'));
            setTimeout(() => {
                $('#newSongUploader #sName').focus();
            }, 500);
        });        
    </script>                        
</body>
</html>