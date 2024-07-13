<?php
session_start();
if (!isset($_SESSION['user']) && !isset($_COOKIE['user'])) {
header('Location: welcome.php');
exit;
}
include 'header.php';
?>
<h1>Welcome, <?php echo $_SESSION['user']['fullName']; ?>!</h1>
<ul>
<li><a href="profile.php">Update Profile</a></li>
<li><a href="account.php">Change Password</a></li>
<li><a href="holiday.php">View Public Holidays</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
<?php include 'footer.php'; ?>
