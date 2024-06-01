<?php
include 'includes/db.php';
include 'includes/functions.php';
session_start();
check_login();

$user_id = $_SESSION['user_id'];
$balance = get_balance($user_id);
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
} else {
    // Handle the case if user's name is not found
    $username = "User";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/dashboard_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <h1>Welcome <?php echo $username; ?>!</h1>
    <div class="balance"><p>Your Available Balance: Rs.<?php echo $balance; ?></p></div>
    <div class="container">
        <div class="card"><a href="add_income.php">Add Income</a></div>
        <div class="card"><a href="add_expense.php">Add Expense</a></div>
        <div class="card"><a href="add_savings.php">Add Savings</a></div>
        <div class="card"><a href="special_expense.php">Add Special Expense</a></div>
        <div class="card"> <a href="view_report.php">View Report</a></div>
        
    </div>
    <div class="logout">  <a href="logout.php">Logout</a></div>
  
</body>
</html>
