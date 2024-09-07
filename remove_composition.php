<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php'; // Connect

    // Retrieve the song name from the AJAX request
    $songName = $_POST['songName'];

    // Fetch the songAudioLink from the database
    $stmt = $conn->prepare("SELECT songAudioLink FROM compositions WHERE songName = ?");
    $stmt->bind_param("s", $songName);
    $stmt->execute();
    $stmt->bind_result($songAudioLink);
    $stmt->fetch();
    $stmt->close();

    // Function to delete the database record
    function deleteRecord($conn, $songName) {
        $stmt = $conn->prepare("DELETE FROM compositions WHERE songName = ?");
        $stmt->bind_param("s", $songName);
        if ($stmt->execute()) {
            return array("success" => true, "message" => "🗑️ Composition \"" . $songName . "\" was removed successfully");
        } else {
            return array("success" => false, "message" => "Error: " . $conn->error);
        }
        $stmt->close();
    }

    if ($songAudioLink) {
        // Attempt to delete the file
        if (unlink($songAudioLink)) {
            // File deletion successful, proceed to delete the database record
            $response = deleteRecord($conn, $songName);
        } else {
            // File deletion failed
            $response = array("success" => false, "message" => "Error: Unable to delete the audio file.");
        }
    } else {
        // No audio file to delete, directly delete the database record
        $response = deleteRecord($conn, $songName);
    }

    $conn->close();
    // Provide a response
    echo json_encode($response);
} else {
    // Handle invalid requests
    http_response_code(405);
    echo json_encode(array("error" => "Method Not Allowed"));
}