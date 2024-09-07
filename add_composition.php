<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php'; // Connect

    // Handle form submission
    $songName = $_POST["song_name"];
    $songDateYear = $_POST["song_date_year"];
    $songDateMonth = $_POST["song_date_month"];
    $songDateDay = $_POST["song_date_day"];
    $songFileLink = $_POST["song_file_link"];
    $songAbout = $_POST["song_about"];
    $songVideoLink = $_POST["song_video_link"];

    // Combine date components into a single date string
    $songDate = "$songDateYear-$songDateMonth-$songDateDay";

    // Check if the audio file is set
    if (isset($_FILES["song_audio"]) && $_FILES["song_audio"]["error"] === UPLOAD_ERR_OK) {
        // Handle file upload
        $targetDirectory = "assets/audios/"; // Adjust the path as per your directory structure
        $targetFile = $targetDirectory . basename($_FILES["song_audio"]["name"]);
        $uploadOk = 1;
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

        // Allow only certain file formats (you can adjust as per your requirements)
        if ($audioFileType != "mp3" && $audioFileType != "wav" && $audioFileType != "ogg") {
            echo "<p style='padding: 1rem;'>Sorry, only MP3, WAV, and OGG files are allowed.</p>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<p style='padding: 1rem;'>Sorry, your file was not uploaded.</p>";
        } else {
            // Attempt to upload file
            if (move_uploaded_file($_FILES["song_audio"]["tmp_name"], $targetFile)) {
                // File uploaded successfully, continue with inserting data into database
                $songAudioLink = $targetFile;
            } else {
                echo "<p style='padding: 1rem;'>Sorry, there was an error uploading your file.</p>";
                exit; // Exit script if file upload fails
            }
        }
    } else {
        // Audio file is not set or an error occurred during upload
        $songAudioLink = ""; // Set default value for audio link
    }

    // Check if the song already exists
    $sql = "SELECT * FROM compositions WHERE songName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $songName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Song doesn't exist, insert into compositions table using prepared statement
        $sql = "INSERT INTO compositions (songName, songDateYear, songDateMonth, songDateDay, songFileLink, songAbout, songAudioLink, songVideoLink) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $songName, $songDateYear, $songDateMonth, $songDateDay, $songFileLink, $songAbout, $songAudioLink, $songVideoLink);
        if ($stmt->execute()) {
            // echo "New song \"" . $songName . "\" is added successfully";
            header("location: composition_added.html");
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "The song already exists";
    }

    // Close prepared statement
    $stmt->close();

    // Close MySQL connection
    $conn->close();
}
?>
