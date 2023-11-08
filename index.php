<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "edge";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $cni = $_POST["cni"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $rendement = $_POST["rendement"];
    $obj = $_POST["objectif"];
    $atteint= floor(($rendement*100)/$obj);
    
    // Insert data into the database
    $sql = $conn->prepare("INSERT INTO employees (cni, nom, prenom, rendement, objectif, atteint) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssiii", $cni, $nom, $prenom, $rendement, $obj, $atteint);
    if ($sql->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql->error;
    }

    // qst part
    $questionCount=$_POST['questionCount'];
    for ($i = 1; $i <= $questionCount; $i++) {
        // Get the question from the POST data
        $question = $_POST["question" . $i];

        // Insert the question into the database
        $insertQuery = "INSERT INTO questions (employeID, question) VALUES (?, ?)";
        $stmt = $conn->prepare($insertQuery);

        $stmt->bind_param("ss", $cni, $question);
        
        // Execute the query
        if ($stmt->execute()) {
            echo "Question inserted successfully: " . $question . "<br>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement after each iteration
        $stmt->close();
    }

}

header("Location: dashboard.html");

exit();
?>