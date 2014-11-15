<?php
include('header1.inc');
include('./query.php');
if(isset($_GET['set_id']) && strlen($_GET['set_id']) > 0) {
	$set_id = $_GET['set_id'];
	$set_score = $_GET['set_score'];
	unset($_GET['set_score']);
	unset($_GET['set_id']);
	require_once('../mysql_connect.php');
	$query = "SELECT variant_name, trans_id, pos, mRNAref, mRNAalt, aaCode, cosmic_mid, score FROM variants_set LEFT JOIN var_cds_pos ON var_id = variant_name WHERE set_id=$set_id ORDER BY variant_name";
	$result = @mysql_query($query);
	if($result) {
		echo '<table border="2" align="center" cellspacing="5" cellpadding=5">';
		echo "<tr><td colspan=8 align = center><b>Info for Set Id=$set_id with HMMvar Score: $set_score</b></td</tr>";
		echo "<tr>
		<td align=\"left\"><b>Variant names</b></td>
		<td align=\"left\"><b>Reference Transcript Sequence</b></td>
		<td align=\"left\"><b>Position</b></td>
		<td align=\"left\"><b>mRNAref</b></td>
		<td align=\"left\"><b>mRNAalt</b></td>
		<td align=\"left\"><b>aaCode</b></td>
		<td align=\"left\"><b>cosmic_mid</b></td>
		<td align=\"left\"><b>Score</b></td>
		</tr>";
		while($row = mysql_fetch_array($result, MYSQL_NUM)) {
			echo "<tr><td align=\"left\"><a href=\"http://bioinformatics.cs.vt.edu/~treiter/variation_display.php?name=$row[0]\">$row[0]</a></td>\n";
			echo "<td align=\"left\"><a href=\"http://bioinformatics.cs.vt.edu/~treiter/cds_display.php?trans_id=$row[1]\">$row[1]</a></td>\n";
			echo "<td align=\"left\">$row[2]</td>\n";
			echo "<td align=\"left\">$row[3]</td>\n";
			echo "<td align=\"left\">$row[4]</td>\n";
			echo "<td align=\"left\">$row[5]</td>\n";
			echo "<td align=\"left\">$row[6]</td>\n";
			echo "<td align=\"left\">$row[7]</td></tr>\n";

		}
		echo '</table>';
	} else {
		echo "<p><b>No results for Set Id = $set_id</b></p>";
	}
} else {
	echo '<font color="red"><p>Error: no Set Id.</p></font>';
}
include('./footer1.inc');
?>