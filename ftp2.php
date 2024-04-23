<?php
// Vulnerable PHP script that allows file upload via FTP without proper validation

// FTP server settings
$ftp_server = "example.com";
$ftp_username = "username";
$ftp_password = "password";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    // Get the uploaded file details
    $file_name = $_FILES["file"]["name"];
    $file_tmp = $_FILES["file"]["tmp_name"];

    // Connect to the FTP server
    $conn_id = ftp_connect($ftp_server);
    if ($conn_id) {
        // Login to the FTP server
        $login_result = ftp_login($conn_id, $ftp_username, $ftp_password);
        if ($login_result) {
            // Attempt to upload the file
            if (ftp_put($conn_id, $file_name, $file_tmp, FTP_BINARY)) {
                echo "File uploaded successfully!";
            } else {
                echo "Failed to upload file.";
            }
        } else {
            echo "Failed to login to FTP server.";
        }

        // Close the FTP connection
        ftp_close($conn_id);
    } else {
        echo "Failed to connect to FTP server.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload via FTP</title>
</head>
<body>
    <h2>Upload a file via FTP</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit">Upload</button>
    </form>
</body>
</html>