<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "webapp");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_name = $_POST['service_name'];
    $description = $_POST['description'];
    $experience = $_POST['experience'];
    $contact = $_POST['contact'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Save the image in the "uploads" folder
    $upload_dir = "uploads/" . basename($image);
    if (move_uploaded_file($image_tmp, $upload_dir)) {
        // Save details in the database
        $sql = "INSERT INTO services (service_name, description, experience, contact, image) 
                VALUES ('$service_name', '$description', '$experience', '$contact', '$image')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Service added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading image.";
    }
}

$conn->close();
?>
