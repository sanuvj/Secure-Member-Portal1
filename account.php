<?php
session_start();
if (!isset($_SESSION['user'])) {
header('Location: welcome.php');
exit;
}
include 'header.php';
include 'conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];
if (password_verify($oldPassword, $_SESSION['user']['password'])) {
$newPasswordHashed = password_hash($newPassword, PASSWORD_BCRYPT);
try {
$stmt = $pdo->prepare('UPDATE tbl_users SET password = ? WHERE userId = ?');
$stmt->execute([$newPasswordHashed, $_SESSION['user']['userId']]);
$_SESSION['user']['password'] = $newPasswordHashed;
echo "Password updated successfully.";
} catch (Exception $e) {
echo "Error: " . $e->getMessage();
}
} else {
echo "Old password is incorrect.";
}
}
?>
<form method="POST" action="">
<label for="oldPassword">Old Password:</label>
<input type="password" id="oldPassword" name="oldPassword" required>
<label for="newPassword">New Password:</label>
<input type="password" id="newPassword" name="newPassword" required>
<button type="submit">Update Password</button>
</form>
<?php include 'footer.php'; ?>