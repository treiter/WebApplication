<?php # main.php
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
if(isset($message)) {
	echo $message;
	header("Location:http://bioinformatics.cs.vt.edu/~treiter/search.php");
} elseif($individual_id && $gene_name) {
	header("Location:http://bioinformatics.cs.vt.edu/~treiter/results.php?individual_id=$individualid&gene_name=$gene_name");
} elseif($individual_id) {
	header("Location:http://bioinformatics.cs.vt.edu/~treiter/results.php?individual_id=$individual_id");
} elseif($gene_name) {
	header("Location:http://bioinformatics.cs.vt.edu/~treiter/results.php?gene_name=$gene_name");
} elseif($variant_name) {
	//require_once("./variation_display.php?name=$variant_name");
	header("Location:http://bioinformatics.cs.vt.edu/~treiter/variation_display.php?name=$variant_name");
}

?>