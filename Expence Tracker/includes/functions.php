<?php
function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

function get_balance($user_id) {
    global $conn;
    $query = "SELECT SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) - 
                     SUM(CASE WHEN type IN ('expense', 'special_expense') THEN amount ELSE 0 END) -
                     SUM(CASE WHEN type = 'saving' THEN amount ELSE 0 END) AS balance
              FROM transactions
              WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['balance'];
}
?>
