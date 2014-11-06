<?php
include('./header1.inc');

if(isset($_GET['name']) && strlen($_GET['name']) > 0) {
	$var_name = $_GET['name'];
	unset($_GET['name']);
	require_once('../mysql_connect.php');
	$query = "SELECT variation_id, chrom, pos, ref, alt, qual, filter, info FROM variation WHERE name=\"$var_name\"";
	$result = @mysql_query($query);
	if($result) {
		echo '<table border="2" align="center" cellspacing="5" cellpadding=5">';
		echo "<tr><td colspan=10 align = center>Information for variant name = $var_name</td</tr>";
		echo "<tr>
		<td align=\"left\">Variation id</td>
		<td align=\"left\">chrom</td>
		<td align=\"left\">Position</td>
		<td align=\"left\">ref</td>
		<td align=\"left\">alt</td>
		<td align=\"left\">qual</td>
		<td align=\"left\">filter</td>
		<td align=\"left\">VT</td>
		<td align=\"left\">AA</td>
		<td align=\"left\">AF</td>
		</tr>";
		while($row = mysql_fetch_array($result, MYSQL_NUM)) {
			echo "<tr><td align=\"left\">$row[0]</td>\n";
			echo "<td align=\"left\">$row[1]</td>\n";
			echo "<td align=\"left\">$row[2]</td>\n";
			echo "<td align=\"left\">$row[3]</td>\n";
			echo "<td align=\"left\">$row[4]</td>\n";
			echo "<td align=\"left\">$row[5]</td>\n";
			echo "<td align=\"left\">$row[6]</td>\n";
			$vtLoc = strrpos($row[7], "VT=");
			$vtEnd = strpos($row[7], ";", $vtLoc);
			if($vtEnd) {
				$vt = substr($row[7], $vtLoc+3, $vtEnd - $vtLoc - 3);
			} else {
				$vt = substr($row[7], $vtLoc+3);
			}
			echo "<td align=\"left\">$vt</td>\n";
			$aaLoc = strrpos($row[7], "AA=");
			$aaEnd = strpos($row[7], ";", $aaLoc);
			if($aaEnd) {
				$aa = substr($row[7], $aaLoc+3, $aaEnd - $aaLoc - 3);
			} else {
				$aa = substr($row[7], $aaLoc+3);
			}
			echo "<td align=\"left\">$aa</td>\n";
			$afLoc = strrpos($row[7], "AF=");
			$afEnd = strpos($row[7], ";", $afLoc);
			if($afEnd) {
				$af = substr($row[7], $afLoc+3, $afEnd - $afLoc - 3);
			} else {
				$af = substr($row[7], $afLoc+3);
			}
			echo "<td align=\"left\">$af</td>\n";
			//echo "<td colspan=3 rowspan=2 align=\"left\">$row[7]</td></tr>\n";
		}
	} else {
		echo "<p><b>No results for variant name = $var_name</b></p>";
	}
} else {
	echo '<font color="red"><p>Error: no variant name.</p></font>';
}
include('./footer1.inc');
?>