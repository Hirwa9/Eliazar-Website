<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Eliazar - music</title>
        
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
                <a class="navbar-brand" href="index.html">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item ps-3 ps-md-0 py-2 py-sm-0">
                            <a class="nav-link" href="about.html">About</a>
                        </li>
                        <li class="nav-item ps-3 ps-md-0 py-2 py-sm-0">
                            <a class="nav-link Here" aria-current="page">Music</a>
                        </li>
                        <li class="nav-item ps-3 ps-md-0 py-2 py-sm-0">
                            <a class="nav-link" href="services.html">Services</a>
                        </li>
                        <li class="nav-item ps-3 ps-md-0 py-2 py-sm-0">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                    </ul>
                    <div class="navbar-nav ms-auto">
                        <a href="admin_login.php">
                            <img src="assets/images/eliazar_logo-tranparent.png" alt="Profile Image" class="profile-img">
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Welcome -->
        <div class="d-md-flex welcome-about" style="background-image: none; height: auto;">
            <div class="position-absolute w-100 inx--1 ptr-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="ptr-none w-100"><path fill="var(--secondaryClr)" fill-opacity="1" d="M0,224L48,229.3C96,235,192,245,288,234.7C384,224,480,192,576,176C672,160,768,160,864,170.7C960,181,1056,203,1152,202.7C1248,203,1344,181,1392,170.7L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
            </div>
            <div class="col-md-7 d-flex overflow-hidden" style="flex-direction: column;">
                <img src="assets/images/eliazar_n-transparent.png" alt="" class="object-fit-cover rad-50 mx-auto my-3 p-1 mask-bottom" style="width: 7rem; height: 7rem; border: 6px solid var(--black4);">
                <div class="mb-3 p-3 d-sm-flex">
                    <!-- Song statistics -->
                    <?php
                    include 'connect.php';
                    // Query to fetch existing songs
                    $query = "SELECT * FROM compositions";
                    $result = mysqli_query($conn, $query);
                    // Initialize counters
                    $totalSongs = 0;
                    $videoSongs = 0;
                    // Check if there are any rows returned
                    if (mysqli_num_rows($result) > 0) {
                        // Through rows, count total songs and video songs
                        while ($row = mysqli_fetch_assoc($result)) {
                            $totalSongs++;
                            if (!empty($row["songVideoLink"])) {
                                $videoSongs++;
                            }
                        }
                    }
                    // Close the connection
                    mysqli_close($conn);
                    ?>
                    <!-- Display statistics -->
                    <div class="col-sm-6">
                        <div class="d-grid justify-content-center mx-2 p-3 rad-10 shadow bg-transparent-black4 bg-bodi">
                            <span class="fw-bold fs-5">All songs</span>
                            <span class="display-3 mx-auto text-primaryClr"><?php echo $totalSongs; ?></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-grid justify-content-center mx-2 p-3 rad-10 shadow bg-transparent-black4 bg-bodi">
                            <span class="fw-bold fs-5">Video songs</span>
                            <span class="display-3 mx-auto text-primaryClr"><?php echo $videoSongs; ?></span>
                        </div>
                    </div>
                </div>

                <!-- Carousel -->
                <div id="compositionsCarousel" class="mask-bottom overflow-hidden carousel slide carousel-fade carousel-dark" data-bs-ride="carousel" data-bs-interval="5000" data-bs-keyboard="true" data-bs-touch="true" data-bs-wrap="true" data-bs-pause="false" style="height: 215px; animation: slideInBottom 3s 1; box-shadow: 0 -1rem 5rem var(--black3); border-radius: 1rem 1rem 0 0">
                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <div class="bg-black2 h-100 carousel-item active">
                            <img src="assets/images/musical_notes.jpg" alt="music sheet" class="d-block w-100 h-100">
                        </div>
                        <div class="bg-black2 h-100 carousel-item">
                            <img src="assets/images/compositions/ntakiri_mu_mva-image.png" alt="music sheet" class="d-block w-100 h-100">
                        </div>
                        <div class="bg-black2 h-100 carousel-item">
                            <img src="assets/images/compositions/tugutuye_aba_bageni-image.png" alt="music sheet" class="d-block w-100 h-100">
                        </div>
                        <div class="bg-black2 h-100 carousel-item">
                            <img src="assets/images/compositions/nyagasani_utubabarire-image.png" alt="music sheet" class="d-block w-100 h-100">
                        </div>
                        <div class="bg-black2 h-100 carousel-item">
                            <img src="assets/images/compositions/komeza_abana_bawe-image.png" alt="music sheet" class="d-block w-100 h-100">
                        </div>
                    </div>
                    <!-- controls -->
                    <button class="btn btn-lg fs-2 blur-bg-5px rad-10 carousel-control-prev" type="button" data-bs-target="#compositionsCarousel" data-bs-slide="prev" style="opacity: 1; height: 3rem; top: 50%; left: 7%; translate-y: -50%;">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="btn btn-lg fs-2 blur-bg-5px rad-10 carousel-control-next" type="button" data-bs-target="#compositionsCarousel" data-bs-slide="next" style="opacity: 1; height: 3rem; top: 50%; right: 7%; translate-y: -50%;">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
            <section class="container mx-md-4">
                <h1 class="display-5 my-5 text-primaryClr fw-bold">MY MUSIC</h1>
                <p class="fs-4 mx-3 mx-md-0 mb-4 pt-xl-5">
                    Each song I create is carefully made to make you feel something special. I mix different sounds and feelings to make something unique.<br><br>
                    In my songs, you can experience the Joy of Singing Beautiful Melodies to the Lord.
                </p>
                <div class="d-flex flex-wrap">
                    <a href="#allCompositionsList" class="fs-5 mb-2 text-primaryClr bounceClick">My music</a>
                    <a href="services.html" class="fs-5 mb-2 ms-3 ms-md-3 text-primaryClr bounceClick">Services</a>
                    <a href="contact.html" class="fs-5 mb-2 ms-5 ms-md-3 text-primaryClr bounceClick">Contact me</a>
                </div>
            </section>
        </div>
        
        <!-- Display existing songs -->
        <div class="my-5">
            <h2 class="fs-1 fw-bold ms-3 ms-sm-5 py-2 section-title">List of compositions</h2>
            <!-- Offcanvas filter -->
            <div class="offcanvas offcanvas-end bg-secondaryClr text-light blur-bg-5px" id="compositionFilter">
                <div class="py-2 offcanvas-header">
                    <h3 class="offcanvas-title">Filter compositions by</h3>
                    <button type="button" class="btn-close text-reset bg-white3" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body" style="border-radius: 1rem 1rem 0 0; animation: flyInBottom 4s 1;">
                    <!-- <h4 class="mb-3 toggle-next"><span class="fa fa-angle-down pe-2"></span> Category</h4>
                    <ul class="mb-4 list-flexible collapse show composition-category">
                        <li class="px-3 py-1">Kwinjira</li>
                        <li class="px-3 py-1">Guhazwa</li>
                        <li class="px-3 py-1">Gutura</li>
                        <li class="px-3 py-1">Agnus dei</li>
                    </ul> -->
                    <h4 class="mb-3 toggle-next"><span class="fa fa-angle-down pe-2"></span> Year</h4>
                    <ul class="mb-4 list-flexible collapse show reduceOpacityNotHovered composition-years">
                        <?php
                        include 'connect.php';
                        $query = "SELECT DISTINCT songDateYear FROM compositions ORDER BY songDateYear DESC";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<li class="px-3 py-1" title="Published in ' . $row['songDateYear'] . '" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom">' . $row['songDateYear'] . '</li>';
                            }
                        }
                        mysqli_close($conn);
                        ?>
                    </ul>
                    <h4 class="mb-3 toggle-next"><span class="fa fa-angle-down pe-2"></span> Media</h4>
                    <ul class="mb-4 list-flexible collapse show reduceOpacityNotHovered composition-media-type">
                        <li class="px-3 py-1" title="With audio file" data-bs-toggle="tooltip" data-bs-placement="bottom">Audio</li>
                        <li class="px-3 py-1" title="With watch option" data-bs-toggle="tooltip" data-bs-placement="bottom">Video</li>
                    </ul>
                </div>
            </div>
            
            <?php
            include 'connect.php';
            // Query to fetch existing songs
            $query = "SELECT * FROM compositions ORDER BY songDateYear DESC, STR_TO_DATE(CONCAT(songDateYear, '-', songDateMonth, '-', songDateDay), '%Y-%m-%d') DESC";
            $result = mysqli_query($conn, $query);
            // Check if there are any rows returned
            if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result) > 2) {
                    // Show song searcher
                    echo '<div class="position-sticky inx-2 d-sm-flex gap-2 col-lg-8 mx-2 ms-md-5 me-lg-auto my-5 pb-1 pb-sm-0 bg-bodi rad-30" style="top: 3.65rem">';
                    echo '    <div class="col-sm-8 rad-100vw shadow">';
                    echo '        <div class="position-relative p-1 target-input border-3 search-box">';
                    echo '            <span class="fa fa-search grid-center"></span>';
                    echo '            <input type="text" placeholder="Find a composition" class="borderless search-box__input" id="songSearcher">';
                    echo '        </div>';
                    echo '    </div>';
                    echo '    <div class="mt-1 mt-sm-0 flex-grow-1 align-self-center song-filter-tools">';
                    echo '        <button class="btn btn-sm align-self-center rad-10 bordered-bottom border-black3 clickDown shadow" data-bs-toggle="tooltip" data-bs-html="true" title="<span class=\'kbd bg-white3 text-light\'>alt</span> + <span class=\'kbd bg-white3 text-light\'>r</span>" onclick="reset_filter_user()"><span class="fa fa-refresh me-2"></span> Show all</button>';
                    echo '        <button class="btn btn-sm align-self-center rad-10 bordered-bottom border-black3 clickDown shadow" data-bs-toggle="offcanvas" data-bs-target="#compositionFilter" onclick="reset_filter_user()">Filter</button>';
                    echo '    </div>';
                    echo '</div>';
                }
                echo '<div class="d-lg-flex compositions-space">';
                echo '    <div class="col-lg-9 d-md-flex flex-wrap mb-4" id="allCompositionsList">';
                // Loop through the rows to display each song
                while ($row = mysqli_fetch_assoc($result)) {
                    // Map month numbers to month names
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
                    // Display song details
                    echo '    <div class="col-md-12 mb-4 song-element">';
                    echo '        <div class="d-md-flex">';
                    echo '            <div class="col-md-3 mb-3 mb-md-0 p-5 flex-center rounded">';
                    echo '                <span class="fa fa-music display-2"> <span class="d-md-none">🎶</span></span>';
                    echo '            </div>';
                    echo '            <div class="col-md-9 px-4 item-primaryClr">';
                    echo '                <h3 class="fs-2 text-secondaryClr notranslate song-title">' . $row["songName"] . '</h3>';
                    echo '                <p class="text-justify notranslate">' . $row["songAbout"] . '</p>';
                    echo '                <p class="fst-italic" style="text-decoration: 2px dotted var(--black3) underline; text-underline-offset: .25rem;">';
                    echo '                    Published on <span class="date-composed fw-bold">' . $row["songDateDay"] . ' ' . $monthName . ', ' . $row["songDateYear"] . '</span>';
                    echo '                </p>';
                    echo '                <div class="d-flex flex-wrap align-items-center gap-2 my-3">';
                    echo '                    <a href="' . $row["songFileLink"] . '" class="btn btn-md bg-black4 rad-0 composition-file-downloader"><span class="fa fa-download me-2"></span> Download file</a>';
                    echo '                    <a href="' . $row["songFileLink"] . '" target="_blank" class="btn btn-md bg-black4 rad-0"><span class="fa fa-eye me-2"></span> Preview</a>';
                    if (!empty($row["songAudioLink"])) {
                        // Display the "Play" button only if a audio link is provided
                        echo '    <audio controls controlsList="noplaybackrate" class="h-2rem"><source src="' . $row["songAudioLink"] . '" type="audio/mpeg">Your browser does not support the audio element.</audio>';
                    }
                    if (!empty($row["songVideoLink"])) {
                        // Display the "Watch" button only if a video link is provided
                        echo '                    <a href="' . $row["songVideoLink"] . '" target="_blank" class="btn btn-md bg-black4 rad-0 watch-composition-video-link"><span class="fab fa-youtube me-2"></span> Watch</a>';
                    }
                    echo '                </div>';
                    echo '            </div>';
                    echo '        </div>';
                    echo '    </div>';
                }
                echo '    </div>';
                echo <<<HTML
                <div class="col-sm-8 col-md-6 col-lg-3 mx-sm-auto my-item border border-top-0 border-bottom-0 rad-0 audio-songs__media-player">
                    <!-- <div class="my-item-header">
                        <h4 class="h-3rem my-item-header__title">Audio songs</h4>
                    </div> -->
                    <div class="px-3 mySbar-sm my-item-body">
                        <div class="rad-10 overflow-hidden current-music-player">
                            <div class="d-flex align-items-center p-3 h-80 pb-1">
                                <div class="col-4 h-100 position-relative rad-10 current-music-player__player-disk"></div>
                                <div class="col-8 align-items-center h-fit p-2 overflow-hidden current-music-player__music-info">
                                    <div class="small mb-2 text-truncate music-name">Current song</div>
                                    <div class="flex-center align-items-center justify-content-around gap-1 px-2 music-controlls">
                                        <button class="fa fa-step-backward grid-center bg-none border-0 ratio-1-1 rounded-circle music-controlls__navigator" onclick="play_another_song('previous')"></button>
                                        <button class="fa fa-play flex-center border-0 w-2_5rem h-2_5rem rounded-circle music-controlls__player" onclick="toggle_current_audio_state()"></button>
                                        <button class="fa fa-step-forward grid-center bg-none border-0 ratio-1-1 rounded-circle music-controlls__navigator" onclick="play_another_song('next')"></button>
                                    </div>
                                </div>
                            </div>
                            <audio src="" controls controlsList="nodownload noplaybackrate" class="w-100 h-20" id="pageAudioPlayer"></audio>
                        </div>
                        <div class="p-3 pt-3 pb-4 mt-3 rad-10 audio-songs-list">
                            <div class="h5 audio-songs-list__header">Audio songs <span class="badge bg-light text-secondaryClr border border-dark rounded-pill audio-songs-list__header_counter"></span></div>
                            <hr class="my-2">
                            <div class="audio-songs-list__body"></div>
                        </div>
                    </div>
                </div>
                HTML;
                echo '</div>';
            } else {
                // No songs found
                echo '<div>No compositions found at the time</div>';
            }
            // Close connection
            mysqli_close($conn);
            ?>
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
                    <li class="py-2"><a href="index.html">Home</a></li>
                    <li class="py-2 Here"><a href="#" aria-current="page">Music</a></li>
                    <li class="py-2"><a href="contact.html">Contact</a></li>
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
    <script src="myScripts.js"></script>
    <script src="scripts/music.js"></script>
</body>
</html>