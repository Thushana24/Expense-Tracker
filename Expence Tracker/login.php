<?php
include 'includes/db.php';
session_start();

$error_message = ''; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: dashboard.php");
        } else {
            $error_message = "Invalid password";
        }
    } else {
        $error_message = "Invalid username";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/login_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container"><form method="POST">
        <h2>Login</h2>
        <i class="fa fa-user" aria-hidden="true"></i>
        <label>Username:</label>
        <input type="text" name="username" required autocomplete="off">
        <label>Password:</label>
        <input type="password" name="password" required autocomplete="off">
       <button type="submit">Login</button>
       <?php if (!empty($error_message)): ?>
                <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </form>
    </div>
    
 
    
</body>
</html>
