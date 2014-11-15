<?php
include('./header1.inc');
include('query.php');

if(isset($_GET['individual_id']) && strlen($_GET['individual_id']) > 0) {
	$individual_id1 = $_GET['individual_id'];
}
if(isset($_GET['gene_name']) && strlen($_GET['gene_name']) > 0) {
	$gene_name1 = $_GET['gene_name'];
}

$error_message = "No results found";

if($individual_id1 && $gene_name1) {
	require_once('../mysql_connect.php');

	$query = "SELECT genename, individual_id, multi_var_filt.trans_id, set_id, score FROM multi_var_filt LEFT JOIN transcript ON multi_var_filt.trans_id=transcript.trans_id WHERE individual_id LIKE \"$individual_id1%\" AND genename LIKE \"$gene_name1%\"";

	$result = @mysql_query($query); // Run the query.

	if(mysql_num_rows($result) == 0) {
		echo "<script type='text/javascript'>alert('$error_message');</script>";
	}
	elseif($result) { // If it ran OK, display the records.
		echo '<div id="results"><table border="2" align="center" cellspacing="3" cellpadding="5">
		<tr><td align="left"><b>Gene Name</b></td>
			<td align="left"><b>Individual Id</b></td>
			<td align="left"><b>Reference Transcript Sequence</b></td>
			<td align="left"><b>Set Id</b></td>
			<td align="left"><b>HMMvar Score</b></td></tr>';
		while($row = mysql_fetch_array($result, MYSQL_NUM)) {
			echo "<tr><td align=\"left\"><a href=\"http://www.genecards.org/cgi-bin/carddisp.pl?gene=$row[0]\">$row[0]</a></td>
			<td align=\"left\">$row[1]</td>
			<td align=\"left\"><a href=\"http://bioinformatics.cs.vt.edu/~treiter/cds_display.php?trans_id=$row[2]\">$row[2]</a></td>
			<td align=\"left\"><a href=\"http://bioinformatics.cs.vt.edu/~treiter/variant_set_display.php?set_id=$row[3]&set_score=$row[4]\">$row[3]</a></td>
			<td align=\"left\">$row[4]</td></td>\n";
		}
		echo '</table></div>';
	}
} elseif($individual_id1) {
	require_once('../mysql_connect.php');

	$query = "SELECT genename, individual_id, multi_var_filt.trans_id, set_id, score FROM multi_var_filt LEFT JOIN transcript ON multi_var_filt.trans_id=transcript.trans_id WHERE individual_id LIKE \"$individual_id1%\"";

	$result = @mysql_query($query); // Run the query.

	if(mysql_num_rows($result) == 0) {
		echo "<script type='text/javascript'>alert('$error_message');</script>";
	}
	elseif($result) { // If it ran OK, display the records.
		echo '<div id="results"><table border="2" align="center" cellspacing="3" cellpadding="5">
		<tr><td align="left"><b>Gene Name</b></td>
			<td align="left"><b>Individual Id</b></td>
			<td align="left"><b>Reference Transcript Sequence</b></td>
			<td align="left"><b>Set Id</b></td>
			<td align="left"><b>HMMvar Score</b></td></tr>';
		while($row = mysql_fetch_array($result, MYSQL_NUM)) {
			echo "<tr><td align=\"left\"><a href=\"http://www.genecards.org/cgi-bin/carddisp.pl?gene=$row[0]\">$row[0]</a></td>
			<td align=\"left\">$row[1]</td>
			<td align=\"left\"><a href=\"http://bioinformatics.cs.vt.edu/~treiter/cds_display.php?trans_id=$row[2]\">$row[2]</a></td>
			<td align=\"left\"><a href=\"http://bioinformatics.cs.vt.edu/~treiter/variant_set_display.php?set_id=$row[3]&set_score=$row[4]\">$row[3]</a></td>
			<td align=\"left\">$row[4]</td></td>\n";
		}
		echo '</table></div>';
	}
	else {
		echo '<p>Error in individual id search.</p>';
	}
} elseif($gene_name1) {
	require_once('../mysql_connect.php');
	$query = "SELECT genename, individual_id, transcript.trans_id, set_id, score FROM transcript LEFT JOIN multi_var_filt ON transcript.trans_id=multi_var_filt.trans_id WHERE genename LIKE \"$gene_name1%\"";
	$result = @mysql_query($query); // Run the query.
	if(mysql_num_rows($result) == 0) {
		echo "<script type='text/javascript'>alert('$error_message');</script>";
	}
	elseif($result) { // If it ran OK, display the records.
		echo '<div id="results"><table border="2" align="center" cellspacing="3" cellpadding="5">
		<tr><td align="left"><b>Gene Name</b></td>
			<td align="left"><b>Individual Id</b></td>
			<td align="left"><b>Reference Transcript Sequence</b></td>
			<td align="left"><b>Set Id</b></td>
			<td align="left"><b>HMMvar Score</b></td></tr>';
		while($row = mysql_fetch_array($result, MYSQL_NUM)) {
			echo "<tr><td align=\"left\"><a href=\"http://www.genecards.org/cgi-bin/carddisp.pl?gene=$row[0]\">$row[0]</a></td>
			<td align=\"left\">$row[1]</td>
			<td align=\"left\"><a href=\"cds_display.php?trans_id=$row[2]\">$row[2]</a></td>
			<td align=\"left\"><a href=\"variant_set_display.php?set_id=$row[3]&set_score=$row[4]\">$row[3]</a></td>
			<td align=\"left\">$row[4]</td></td>\n";
		}
		echo '</table></div>';
	} else {
		echo "<p>Error in gene name search.</p>";
	}
} else {
	echo "<p>No gene name or individual id!</p>";
}
include('./footer1.inc');
?>