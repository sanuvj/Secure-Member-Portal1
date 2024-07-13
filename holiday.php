<?php
session_start();
if (!isset($_SESSION['user'])) {
header('Location: welcome.php');
exit;
}
include 'header.php';
try {
$api_url =
'https://data.gov.sg/api/action/datastore_search?resource_id=6228c3c5-03bd-4747-bb10-85140
f87168b&limit=10';
$response = file_get_contents($api_url);
if ($response === FALSE) {
throw new Exception("Error fetching holidays.");
}
$data = json_decode($response, true);
$holidays = $data['result']['records'];
} catch (Exception $e) {
echo "Error: " . $e->getMessage();
$holidays = [];
}
?>
<h1>Public Holidays</h1>
<table>
<thead>
<tr>
<th>Date</th>
<th>Holiday Name</th>
<th>Day</th>
</tr>
</thead>
<tbody>
<?php foreach ($holidays as $holiday): ?>
<tr>
<td><?php echo htmlspecialchars($holiday['date']); ?></td>
<td><?php echo htmlspecialchars($holiday['holiday']); ?></td>
<td><?php echo htmlspecialchars($holiday['day']); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php include 'footer.php'; ?>