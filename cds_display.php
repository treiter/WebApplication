<?php
include('./header1.inc');
include('./query.php');
if(isset($_GET['trans_id']) && strlen($_GET['trans_id']) > 0) {
	$trans_id = $_GET['trans_id'];
	unset($_GET['trans_id']);
	require_once('../mysql_connect.php');
	$query = "SELECT genename, seq_cds, cds_location FROM transcript WHERE trans_id=\"$trans_id\"";
	$result = @mysql_query($query);
	if($result) {
		while($row = mysql_fetch_array($result, MYSQL_NUM)) {
			echo "<p><b>Information on Gene: $row[0] with transcript id = $trans_id</b></p>";
			echo "<div id=\"container\"><p>Location=$row[2]</p>";
			echo "Sequence: ";
			echo "$row[1]";
			echo "</div>";
		}
	} else {
		echo "<p><b>No results for trans_id = $trans_id</b></p>";
	}
} else {
	echo '<font color="red"><p>Error: no trans_id.</p></font>';
}
include('./footer1.inc');
?>