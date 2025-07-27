<?php
// MySQL connection settings
$host = "localhost";
$username = "root";
$password = "Nilu@2804"; // Default for XAMPP, change if needed
$database = "attendance_system";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $roll = $_POST["roll"];
  $subject = $_POST["subject"];
  $attendance = $_POST["attendance"];
  $date = $_POST["date"];

  $sql = "INSERT INTO attendance (student_name, roll_number, subject, status, date)
          VALUES (?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssss", $name, $roll, $subject, $attendance, $date);

  if ($stmt->execute()) {
    echo "<h2>Attendance Recorded Successfully</h2>";
    echo "<p>Name: $name<br>Roll: $roll<br>Subject: $subject<br>Status: $attendance<br>Date: $date</p>";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
} else {
  echo "Invalid Request.";
}
?>
