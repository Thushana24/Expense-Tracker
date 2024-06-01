<?php
include 'includes/db.php';
include 'includes/functions.php';
session_start();
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO transactions (user_id, date, type, amount, description) VALUES (?, NOW(), 'saving', ?, ?)");
    $stmt->bind_param("ids", $_SESSION['user_id'], $amount, $description);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Savings</title>
    <link rel="stylesheet" type="text/css" href="css/login_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container"><form method="POST">
        <h2>Add Savings</h2>
     <i class="fa-solid fa-magnifying-glass-dollar"></i>
        <label>Amount:</label>
        <input type="number" step="0.01" name="amount" required autocomplete="off">
        <label>Description:</label>
        <input type="text" name="description" autocomplete="off">
        <button type="submit">ADD</button>
    </form></div>
    
</body>
</html>
