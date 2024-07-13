<?php
session_start();
include 'header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
include 'conn.php';
$email = $_POST['email'];
$password = $_POST['password'];
$remember = isset($_POST['remember']);
try {
$stmt = $pdo->prepare('SELECT * FROM tbl_users WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch();
if ($user && password_verify($password, $user['password'])) {
$_SESSION['user'] = $user;
if ($remember) {
setcookie('user', $user['userId'], time() + (86400 * 30), "/"); // 30 days
}
header('Location: protected-home.php');
exit;
} else {
echo "Invalid email or password.";
}
} catch (Exception $e) {
echo "Error: " . $e->getMessage();
}
}
?>
<form method="POST" action="">
<label for="email">Email:</label>
<input type="email" id="email" name="email" required>
<label for="password">Password:</label>
<input type="password" id="password" name="password" required>
<label for="remember">
<input type="checkbox" id="remember" name="remember"> Remember me
</label>
<button type="submit">Login</button>
</form>
<?php include 'footer.php'; ?>
