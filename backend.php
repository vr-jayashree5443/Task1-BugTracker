<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "test"; 
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["action"] == "add_project") {
    $projectName = $_POST["projectName"];
    addProject($conn, $projectName);
  }

  if ($_POST["action"] == "add_task") {
    $projectName = $_POST["projectName"];
    $taskName = $_POST["taskName"];
    $assignedPerson = $_POST["assignedPerson"];
    $taskStatus = $_POST["taskStatus"];
    addTask($conn, $projectName, $taskName, $assignedPerson, $taskStatus);
  }
}
function addProject($conn, $projectName) {
  // Create the project's table in the database using the project name
  $tableName = str_replace(' ', '_', strtolower($projectName));
  $sql = "CREATE TABLE IF NOT EXISTS $tableName (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            task_name VARCHAR(255) NOT NULL,
            assigned_person VARCHAR(255) NOT NULL,
            status ENUM('pending', 'completed') NOT NULL
          )";

  try {
    $conn->exec($sql);
    echo "Table for project '$projectName' created successfully.<br>";
  } catch(PDOException $e) {
    echo "Error creating table: " . $e->getMessage() . "<br>";
  }
  $sql = "INSERT INTO projects (project_name) VALUES (:project_name)";
  try {
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':project_name', $projectName);
    $stmt->execute();
    echo "Project '$projectName' added successfully.<br>";
  } catch(PDOException $e) {
    echo "Error adding project: " . $e->getMessage() . "<br>";
  }
}
function addTask($conn, $projectName, $taskName, $assignedPerson, $taskStatus) {
  $tableName = str_replace(' ', '_', strtolower($projectName));
  $sql = "INSERT INTO $tableName (task_name, assigned_person, status) VALUES (:task_name, :assigned_person, :status)";
  try {
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':task_name', $taskName);
    $stmt->bindParam(':assigned_person', $assignedPerson);
    $stmt->bindParam(':status', $taskStatus);
    $stmt->execute();
    echo "Task '$taskName' added to project '$projectName' successfully.<br>";
  } catch(PDOException $e) {
    echo "Error adding task: " . $e->getMessage() . "<br>";
  }
}
?>
