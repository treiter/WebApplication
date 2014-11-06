<!DOCTYPE html>
<html>
<body>
<br />
<?php
if(isset($_GET['set_id']) && strlen($_GET['set_id']) > 0) {
	$set_id = $_GET['set_id'];
	require_once('../mysql_connect.php');
	$query = "SELECT set_id, variant_name FROM variants_set WHERE set_id=$set_id";
	$result = @mysql_query($query);
	if($result) {
		echo '<table border="2" align="center" cellspacing="5" cellpadding=5">';
		echo "<tr><td align=\"left\">Variant names for set_id=$set_id</td></tr>";
		while($row = mysql_fetch_array($result, MYSQL_NUM)) {
			echo "<tr><td align=\"left\">$row[1]</td></tr>\n";
		}
		echo '</table>';
	} else {
		echo "<p><b>No results for set_id = $set_id</b></p>";
	}
} else {
	echo '<font color="red"><p>Error: no set_id.</p></font>';
}
?>
</body>
</html>