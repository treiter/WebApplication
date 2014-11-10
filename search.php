<?php # main.php
include('./header1.inc');
//Set the page title
//$page_title = 'Main';

//Create input form

if(isset($_POST['submit'])) { //Handle the form.
	$message = NULL; // Create an empty new variable.

	//Check if form was filled out
	if(!empty($_POST['individual_id'])) {
		$individual_id = $_POST['individual_id'];
	}
	if(!empty($_POST['gene_name'])) {
		$gene_name = $_POST['gene_name'];
	}
	if(!empty($_POST['variant_name'])) {
		$variant_name = $_POST['variant_name'];
	} 
	if(!($individual_id || $gene_name || $variant_name)) {
		$message .= '<p>You forgot to enter an individual id, gene name, or variant name!</p>';
	}

//	else {
//		$id = $_POST['individual_id'];
//	}

	if($message != NULL) {
		$message .= '<p>Please try again.</p>';
	}
} //End of the submit conditional.
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend><b>Enter the individual id, gene name, or variant name you'd like to see information about below:</b></legend>

<p><b>Individual id:&nbsp;&nbsp;&nbsp;&nbsp;</b> <input type="text" id="individualid" name="individual_id" size="20" maxlength="20"
value="<?php if (isset($_POST['individual_id'])) echo $_POST['individual_id']; ?>" /></p>

<p><b>Gene Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <input type="text" id="genename" name="gene_name" size="20" maxlength="20"
value="<?php if (isset($_POST['gene_name'])) echo $_POST['gene_name']; ?>" /></p>

<p><b>Variant Name:&nbsp;&nbsp;</b> <input type="text" id="variantname" name="variant_name" size="20" maxlength="20"
value="<?php if (isset($_POST['variant_id'])) echo $_POST['variant_id']; ?>" /></p>

</fieldset>

<div align="center"><input type="submit" name="submit" value="Search" /></div>

</form><!-- End of Form -->


<!-- Print the message if there is one -->
<?php
$error_message = "No results found";
if(isset($message)) {
	echo $message;

} elseif($individual_id && $gene_name) {
	require_once('../mysql_connect.php');

	$query = "SELECT genename, individual_id, multi_var_filt.trans_id, set_id, score FROM multi_var_filt LEFT JOIN transcript ON multi_var_filt.trans_id=transcript.trans_id WHERE individual_id LIKE \"$individual_id%\" AND genename LIKE \"$gene_name%\"";

	$result = @mysql_query($query); // Run the query.

	if(mysql_num_rows($result) == 0) {
		echo "<script type='text/javascript'>alert('$error_message');</script>";
	}
	elseif($result) { // If it ran OK, display the records.
		echo '<table border="2" align="center" cellspacing="3" cellpadding="5">
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
		echo '</table>';
	}
} elseif($individual_id) {
	require_once('../mysql_connect.php');

	$query = "SELECT genename, individual_id, multi_var_filt.trans_id, set_id, score FROM multi_var_filt LEFT JOIN transcript ON multi_var_filt.trans_id=transcript.trans_id WHERE individual_id LIKE \"$individual_id%\"";

	$result = @mysql_query($query); // Run the query.

	if(mysql_num_rows($result) == 0) {
		echo "<script type='text/javascript'>alert('$error_message');</script>";
	}
	elseif($result) { // If it ran OK, display the records.
		echo '<table border="2" align="center" cellspacing="3" cellpadding="5">
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
		echo '</table>';
	}
	else {
		echo '<p>Error in individual id search.</p>';
	}
} elseif($gene_name) {
	require_once('../mysql_connect.php');
	$query = "SELECT genename, individual_id, transcript.trans_id, set_id, score FROM transcript LEFT JOIN multi_var_filt ON transcript.trans_id=multi_var_filt.trans_id WHERE genename LIKE \"$gene_name%\"";
	$result = @mysql_query($query); // Run the query.
	if(mysql_num_rows($result) == 0) {
		echo "<script type='text/javascript'>alert('$error_message');</script>";
	}
	elseif($result) { // If it ran OK, display the records.
		echo '<table border="2" align="center" cellspacing="3" cellpadding="5">
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
		echo '</table>';
	} else {
		echo "<p>Error in gene name search.</p>";
	}
} elseif($variant_name) {
	//require_once("./variation_display.php?name=$variant_name");
	header("Location:http://bioinformatics.cs.vt.edu/~treiter/variation_display.php?name=$variant_name");
}

include('./footer1.inc');
?>