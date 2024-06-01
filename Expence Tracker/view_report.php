<?php
include 'includes/db.php';
include 'includes/functions.php';
session_start();
check_login();

$user_id = $_SESSION['user_id'];

$query = "SELECT date, type, amount, description FROM transactions WHERE user_id = ? ORDER BY date";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();


$total_income = 0;
$total_expense = 0;

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Report</title>
    <link rel="stylesheet" type="text/css" href="./css/report_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <h1>Income-Expense Report</h1>
    <table>
        <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Description</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo ucfirst($row['type']); ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['description']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
