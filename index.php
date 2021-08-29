<?php

include("login.php");
include("header.php");

?>
<div data-role="page">
<div data-role="header">
<h2>Nigun List</h2>
</div>
<div data-role="main" class="ui-content">
<?php

$random_list=5;

if ($belepve == 1) {
	
	# ================ add new ================
	
	if (isset($_POST['add_song_title'])) {
		if (isset($_GET['nig'])) {
			# ============= modify nigun =============
			
			$nig=mysqli_real_escape_string($sql, $_GET['nig']);
			$title=mysqli_real_escape_string($sql, $_POST['add_song_title']);
			
			$q="UPDATE `nigunlist_nigun` SET `title`='$title' WHERE id='$nig'";
			mysqli_query($sql, $q) or print(mysqli_error($sql));

			$q="DELETE FROM `nigunlist_categ_nigun` WHERE nigun='$nig'";
			mysqli_query($sql, $q) or print(mysqli_error($sql));
			
			if (isset($_POST['categ'])) {
				foreach ($_POST['categ'] as $id) {
					$id=mysqli_real_escape_string($sql, $id);
					$q="INSERT INTO nigunlist_categ_nigun (categ, nigun) VALUES ('$id', '$nig');";
					mysqli_query($sql, $q) or print(mysqli_error($sql));
				}
			}
			unset($_GET['nig']);
		} else {
			# ============= add nigun =============

			$title=mysqli_real_escape_string($sql, $_POST['add_song_title']);
			$q="INSERT INTO `nigunlist_nigun` (`title`, `datetime`) VALUES ('$title', now());";
			mysqli_query($sql, $q) or print(mysqli_error($sql));
			$nigun_id=mysqli_insert_id($sql);
			
			if (isset($_POST['categ'])) {
				foreach ($_POST['categ'] as $id) {
					$id=mysqli_real_escape_string($sql, $id);
					$q="INSERT INTO nigunlist_categ_nigun (categ, nigun) VALUES ('$id', '$nigun_id');";
					mysqli_query($sql, $q) or print(mysqli_error($sql));
				}
			}
		}
	} elseif (isset($_POST['categname'])) {
		# ============= add categ =============
		
		$title=mysqli_real_escape_string($sql, $_POST['categname']);
		$q="INSERT INTO `nigunlist_categ` (`categ`) VALUES ('$title');";
		mysqli_query($sql, $q) or print(mysqli_error($sql));
		$categ_id=mysqli_insert_id($sql);
		
		if (isset($_POST['nigun'])) {
			foreach ($_POST['nigun'] as $id) {
				$id=mysqli_real_escape_string($sql, $id);
				$q="INSERT INTO nigunlist_categ_nigun (categ, nigun) VALUES ('$categ_id', '$id');";
				mysqli_query($sql, $q) or print(mysqli_error($sql));
			}
		}
	}
	
	$saved_categs=array();
	
	if (isset($_GET['nig'])) {
		# ============= load song to modify =============
		
		$nig=mysqli_real_escape_string($sql, $_GET['nig']);
		$q="SELECT title FROM `nigunlist_nigun` WHERE id='$nig';";
		$r=mysqli_query($sql, $q) or print(mysqli_error($sql));
		$rec=mysqli_fetch_array($r);
		
		echo "<form method=\"post\" action=\"?nig={$_GET['nig']}\">\n".
			"<input type=\"text\" name=\"add_song_title\" value=\"{$rec['title']}\">\n".
			"<fieldset data-role=\"controlgroup\" data-type=\"horizontal\">\n";
		
		$q="SELECT categ FROM `nigunlist_categ_nigun` WHERE nigun='$nig';";
		$r=mysqli_query($sql, $q) or print(mysqli_error($sql));
		
		while ($rec=mysqli_fetch_array($r)) {
			$saved_categs[$rec['categ']]="";
		}
	} else {
		echo "<form method=\"post\" action=\"?$to_post\">\n".
			"<input type=\"text\" name=\"add_song_title\" placeholder=\"Title\">\n".
			"<fieldset data-role=\"controlgroup\" data-type=\"horizontal\">\n";
	}
	
	$categs=array();
	$categ_id=array();
	
	$q="SELECT id, categ FROM `nigunlist_categ` ORDER BY categ";
	$r=mysqli_query($sql, $q) or print(mysqli_error($sql));

	while ($rec=mysqli_fetch_array($r)) {
		$id=$rec['id'];
		$categs[$id]=$rec['categ'];
		$categ_id[]=$id;
		
		$checked="";
		if (isset($saved_categs[$id])) { $checked=" checked"; }
		
		echo "<input type=\"checkbox\" name=\"categ[]\" value=\"$id\" id=\"checkbox-categ-$id\"$checked>\n".
			"<label for=\"checkbox-categ-$id\">{$rec['categ']}</label>\n";
	}
	
	echo "<a href=\"add_categ.php\" class=\"ui-btn\">Add new</a>";
	
	echo "</fieldset>\n</form>\n";
	
?>

<?php

	# ================ list existing ================
	
	$q="SELECT id, title FROM `nigunlist_nigun` ORDER BY `title`;";
	
	if (isset($_GET['cat'])) {
		# ============= filter nigunim by categ =============
		$cat=mysqli_real_escape_string($sql, $_GET['cat']);
		$q="SELECT nigunlist_nigun.id, nigunlist_nigun.title FROM `nigunlist_nigun` LEFT JOIN `nigunlist_categ_nigun` ON nigunlist_nigun.id=nigunlist_categ_nigun.nigun WHERE nigunlist_categ_nigun.categ='$cat' ORDER BY `title`;";
	}
	
	$r=mysqli_query($sql, $q) or print(mysqli_error($sql));
	
	$songs=array();
	$out="<p><ul>\n";
	
	while ($rec=mysqli_fetch_array($r)) {
		$out.="<li><a href=\"?nig={$rec['id']}\">{$rec['title']}</a></li>\n";
		$songs[]=$rec['title'];
	}
	
	$out.="</ul></p>\n";

	# ================ random list ================
	
	shuffle($songs);
	
	echo "<p><ul>\n";
	
	for ($i=0;$i<$random_list;$i++) {
		echo "<li>{$songs[$i]}</li>\n";		
	}
	
	echo "</ul></p>\n<hr>\n<br>\n";

	# ================ category-wise listing ================

	$q="SELECT categ, COUNT(`nigun`) as count FROM `nigunlist_categ_nigun` GROUP BY categ";
	$r=mysqli_query($sql, $q) or print(mysqli_error($sql));

	echo "<a href=\"index.php?\" class=\"ui-btn ui-btn-inline\">All (".count($songs).")</a>\n";
	$categ_links=array();

	while ($rec=mysqli_fetch_array($r)) {
		$categ_links[$rec['categ']]="<a href=\"?cat={$rec['categ']}\" class=\"ui-btn ui-btn-inline\">{$categs[$rec['categ']]} ({$rec['count']})</a>\n";
	}
	
	foreach ($categ_id as $id) {
		echo $categ_links[$id];
	}


	echo $out;
}

?>

</div>
</div>

</body>
</html>
