<?php

include("login.php");
include("header.php");

?>
<div data-role="page">
<div data-role="header">
<h2>Nigun List – Add category</h2>
</div>
<div data-role="main" class="ui-content">
<?php

if ($belepve == 1) {
	
	# ================ add new ================
	
	echo "<form method=\"post\" action=\"index.php\">\n".
		"<input type=\"text\" name=\"categname\" placeholder=\"Category name\">\n".
		"<fieldset data-role=\"controlgroup\" data-type=\"horizontal\">\n";

	$q="SELECT id, title, datetime FROM `nigunlist_nigun` ORDER BY `title`;";
	$r=mysqli_query($sql, $q) or print(mysqli_error($sql));

	while ($rec=mysqli_fetch_array($r)) {
		$id=$rec['id'];
		echo "<input type=\"checkbox\" name=\"nigun[]\" value=\"$id\" id=\"checkbox-nigun-$id\">\n".
			"<label for=\"checkbox-nigun-$id\">{$rec['title']}</label>\n";
	}
	
	echo "</fieldset>\n</form>\n";
	
?>

</div>
</div>

<?php

}

?>

</body>
</html>
