<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php'; // connect

    // Retrieve the old song name and new song details from the form
    $currentSongName = $_POST['current_song_name'];
    $newSongName = $_POST['song_name'];
    $songDateYear = $_POST['song_date_year'];
    $songDateMonth = $_POST['song_date_month'];
    $songDateDay = $_POST['song_date_day'];
    $songFileLink = $_POST['song_file_link'];
    $songAbout = $_POST['song_about'];
    // Check for needs to upload an audio file
    $uploadOk = 1;
    $fileUploaded = false;
    if (isset($_POST['song_audio'])) {
        $songAudioLink = $_POST['song_audio'];
    } else {
        $songAudioLink = "";
    }
    $songVideoLink = $_POST['song_video_link'];

    // Combine date components into a single date string
    $songDate = "$songDateYear-$songDateMonth-$songDateDay";

    // Upload audio file if set
    if (!empty($_FILES["song_audio"]["name"]) && $_FILES["song_audio"]["error"] === UPLOAD_ERR_OK) {
        // Handle file upload
        $targetDirectory = "assets/audios/";
        $targetFile = $targetDirectory . basename($_FILES["song_audio"]["name"]);
        $audioFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "<p style='padding: 1rem;'>Sorry, the file already exists.</p>";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["song_audio"]["size"] > 7000000) {
            echo "<p style='padding: 1rem;'>Sorry, your file size (" . round(($_FILES["song_audio"]["size"] / 1000000), 2) . "MBs) is too large. Use less or 7 MBs</p>";
            $uploadOk = 0;
        }
        // Allow only certain file formats
        if (!in_array($audioFileType, array("mp3", "wav", "ogg"))) {
            echo "<p style='padding: 1rem;'>Sorry, only MP3, WAV, and OGG files are allowed.</p>";
            $uploadOk = 0;
        }
        // Check if no restrictions
        if ($uploadOk == 1) {
            // Attempt to upload file
            if (move_uploaded_file($_FILES["song_audio"]["tmp_name"], $targetFile)) {
                // File uploaded successfully
                $songAudioLink = $targetFile;
                $fileUploaded = true;
            } else {
                echo "<p style='padding: 1rem;'>Sorry, there was an error uploading your file.</p>";
            }
        }
    }

    if (!empty($_FILES["song_audio"]["name"]) && ($uploadOk == 1) && ($fileUploaded === true)) {
        // Database statement when file was uploaded
        $stmt = $conn->prepare("UPDATE compositions 
                                SET songName=?, songDateYear=?, songDateMonth=?, songDateDay=?, songFileLink=?, songAbout=?, songAudioLink=?, songVideoLink=?
                                WHERE songName=?");
        $stmt->bind_param("sssssssss", $newSongName, $songDateYear, $songDateMonth, $songDateDay, $songFileLink, $songAbout, $songAudioLink, $songVideoLink, $currentSongName);

    } else {
        // Database statement when no file provided
        $stmt = $conn->prepare("UPDATE compositions 
                                SET songName=?, songDateYear=?, songDateMonth=?, songDateDay=?, songFileLink=?, songAbout=?, songVideoLink=?
                                WHERE songName=?");
        $stmt->bind_param("ssssssss", $newSongName, $songDateYear, $songDateMonth, $songDateDay, $songFileLink, $songAbout, $songVideoLink, $currentSongName);
    }


    if ($stmt->execute()) {
        // Update successful
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <title>Composition updated</title>
        
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
                
                <!-- Upload status -->
                <div class="justify-content-center mt-5 col-md-6 container">
                    <img src="assets/images/eliazar_logo-tranparent.png" alt="" class="w-3rem ratio-1-1 mx-auto mb-3">
                    <h1 class="display-5 my-5">Composition updated</h1>            
                    <div class="alert alert-success d-sm-flex gap-3">
                        <span class="fa fa-edit display-1 mb-4"></span>
                        <div class="m-0">
                            <p>
                                Composition <b>"' . $currentSongName . '"</b> was updated successfully.
                            </p>';
        // Check if audio file was set and uploaded;
        if (!empty($_FILES["song_audio"]["name"])) {
            if (($uploadOk == 1) && ($fileUploaded === true)) {
                echo '<p class="text-success">The audio file was uploaded successfully.</p>';
            } else {
                echo '<p class="text-danger fs-5">The audio file upload failed.</p>';
            }
        }
        echo '<p>
                                <a href="admin_cpanel.php" class="btn btn-outline-success d-block mx-auto my-2 text-start" class="btn btn-primary"><span class="fa fa-angle-left me-2"></span> Go Back</a>
                                <a href="music.php" class="btn btn-outline-secondary d-block mx-auto my-2 text-end" class="btn btn-primary"> Go to my music <span class="fa fa-angle-right ms-2"></span></a>                    
                            </p>
                        </div>
                    </div>
                </div>
            </main>
            <script src="myScripts.js"></script>
            <script src="scripts/music.js"></script>
        </body>        
        </html>';
    } else {
        // Error occurred
        echo "Error: " . $conn->error;
    }
    // Close prepared statement
    $stmt->close();
    // Close MySQL connection
    $conn->close();
} else {
    // Handle invalid requests
    http_response_code(405);
    echo json_encode(array("error" => "Method Not Allowed"));
}

?>