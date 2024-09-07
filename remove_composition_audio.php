<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php'; // Connect to the database

    // Retrieve and sanitize the song name from the AJAX request
    $songName = filter_input(INPUT_POST, 'songName', FILTER_SANITIZE_STRING);
    $songName = html_entity_decode($songName);
    
    if ($songName) {
        // Fetch the songAudioLink from the database
        $stmt = $conn->prepare("SELECT songAudioLink FROM compositions WHERE songName = ?");
        $stmt->bind_param("s", $songName);
        $stmt->execute();
        $stmt->bind_result($songAudioLink);
        $stmt->fetch();
        $stmt->close();

        // Ensure songAudioLink is sanitized
        // $songAudioLink = filter_var($songAudioLink, FILTER_SANITIZE_STRING);

        if ($songAudioLink) {
            // Attempt to delete the file
            if (unlink($songAudioLink)) {
                // File deletion successful, proceed to delete the database record
                $response = removeAudioLink($conn, $songName);
            } else {
                // File deletion failed
                $response = array("success" => false, "message" => "❌ Unable to delete the audio file. Try again.");
            }
        } else {
            // No audio file to delete
            // $response = array("success" => false, "message" => "❌ No audio file found.");
            $response = array("success" => false, "message" => "❌ No audio file found for " . $songAudioLink . ' from ' .$songName);
        }
    } else {
        $response = array("success" => false, "message" => "Invalid song name.");
    }

    $conn->close();
    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(array("error" => "Method Not Allowed"));
}

// Function to delete the database record
function removeAudioLink($conn, $songName)
{
    $stmt = $conn->prepare("UPDATE compositions SET songAudioLink = NULL WHERE songName = ?");
    $stmt->bind_param("s", $songName);
    $result = $stmt->execute();
    $stmt->close();
    if ($result) {
        return array("success" => true, "message" => "✔️ Audio file removed successfully.");
    } else {
        return array("success" => false, "message" => "❌ Error: " . $conn->error);
    }
}