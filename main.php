<?php # main.php

//Set the page title
$page_title = 'Main';

//Create input form

if(isset($_POST['submit'])) { //Handle the form.
	$message = NULL; // Create an empty new variable.

	//Check if form was filled out
	if(empty($_POST['individual_id'])) {
		$id = FALSE;
		$message .= '<p>You forgot to enter an id or gene name!</p>';
	} else {
		$id = $_POST['individual_id'];
	}

	if(!$id) {
		$message .= '<p>Please try again.</p>';
	}
} //End of the submit conditional.
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Enter the individual id or gene name you'd like to see information about below:</legend>

<p><b>Individual id or Gene Name:</b> <input type="text" name="individual_id" size="20" maxlength="20"
value="<?php if (isset($_POST['individual_id'])) echo $_POST['individual_id']; ?>" /></p>

</fieldset>

<div align="center"><input type="submit" name="submit" value="Search" /></div>

</form><!-- End of Form -->

<!-- Print the message if there is one -->
<?php
if(isset($message)) {
	echo '<font color="red">', $message, '</font>';
} elseif($id) {
	require_once('../mysql_connect.php');

	$query = "SELECT genename, individual_id, multi_var_filt.trans_id, set_id, score FROM multi_var_filt LEFT JOIN transcript ON multi_var_filt.trans_id=transcript.trans_id WHERE individual_id LIKE \"%$id%\"";

	$result = @mysql_query($query); // Run the query.
	$num_results = mysql_num_rows($result);
	if($result && $num_results > 0) { // If it ran OK, display the records.
		echo '<table border="2" align="center" cellspacing="5" cellpadding="5">
		<tr><td align="left"><b>Gene Name</b></td>
			<td align="left"><b>individual_id</b></td>
			<td align="left"><b>trans_id</b></td>
			<td align="left"><b>set_id</b></td>
			<td align="left"><b>score</b></td></tr>';
		while($row = mysql_fetch_array($result, MYSQL_NUM)) {
			echo "<tr><td align=\"left\">$row[0]</td>
			<td align=\"left\">$row[1]</td>
			<td align=\"left\"><a href=\"cds_display.php/?trans_id=$row[2]\">$row[2]</a></td>
			<td align=\"left\"><a href=\"variant_set_display.php/?set_id=$row[3]&set_score=$row[4]\">$row[3]</a></td>
			<td align=\"left\">$row[4]</td></td>\n";
		}
		echo '</table>';
	} else {
		$query = "SELECT genename, individual_id, transcript.trans_id, set_id, score FROM transcript LEFT JOIN multi_var_filt ON transcript.trans_id=multi_var_filt.trans_id WHERE genename LIKE \"%$id%\"";
		$result = @mysql_query($query); // Run the query.
		if($result) { // If it ran OK, display the records.
			echo '<table border="2" align="center" cellspacing="5" cellpadding="5">
			<tr><td align="left"><b>Gene Name</b></td>
				<td align="left"><b>individual_id</b></td>
				<td align="left"><b>trans_id</b></td>
				<td align="left"><b>set_id</b></td>
				<td align="left"><b>score</b></td></tr>';
			while($row = mysql_fetch_array($result, MYSQL_NUM)) {
				echo "<tr><td align=\"left\">$row[0]</td>
				<td align=\"left\">$row[1]</td>
				<td align=\"left\"><a href=\"cds_display.php/?trans_id=$row[2]\">$row[2]</a></td>
				<td align=\"left\"><a href=\"variant_set_display.php/?set_id=$row[3]&set_score=$row[4]\">$row[3]</a></td>
				<td align=\"left\">$row[4]</td></td>\n";
			}
		} else {
			echo "<p>Query didn\'t work for id: $id</p>";
		}
		echo '</table>';

	}
}
?>