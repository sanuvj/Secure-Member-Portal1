<?php
session_start();
if (!isset($_SESSION['user'])) {
header('Location: welcome.php');
exit;
}
include 'header.php';
include 'conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$email = $_POST['email'];
$fullName = $_POST['fullName'];
$city = $_POST['city'];
try {
$stmt = $pdo->prepare('UPDATE tbl_users SET email = ?, fullName = ?, city = ?
WHERE userId = ?');
$stmt->execute([$email, $fullName, $city, $_SESSION['user']['userId']]);
$_SESSION['user']['email'] = $email;
$_SESSION['user']['fullName'] = $fullName;
$_SESSION['user']['city'] = $city;
echo "Profile updated successfully.";
} catch (Exception $e) {
echo "Error: " . $e->getMessage();
}
}
?>
<form method="POST" action="">
<label for="email">Email:</label>
<input type="email" id="email" name="email" value="<?php echo
$_SESSION['user']['email']; ?>" required>
<label for="fullName">Full Name:</label>
<input type="text" id="fullName" name="fullName" value="<?php echo
$_SESSION['user']['fullName']; ?>" required>
<label for="city">City:</label>
<input type="text" id="city" name="city" value="<?php echo $_SESSION['user']['city'];
?>" required>
<button type="submit">Update Profile</button>
</form>
<?php include 'footer.php'; ?>
