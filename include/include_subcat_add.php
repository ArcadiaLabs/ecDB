<?php
class SubcatAdd {
	public function AddSubcat() {

		require_once('include/login/auth.php');
		include('include/mysql_connect.php');

		if(isset($_POST['submit'])) {
			$owner			=	$_SESSION['SESS_MEMBER_ID'];
			$category_id	= 	mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['category_id']);
			$subcategory	= 	mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['subcategory']);

			if ($subcategory == '') {
				echo '<div class="message red">';
				echo 'You have to specify a name !';
				echo '</div>';
			}
			else {
				$sql="INSERT into category_sub (category_id, subcategory) VALUES ('$category_id', '$subcategory')";
				$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

				$cat_id = ((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);

				echo ''.$category_id.', '.$subcategory.'';
				echo '<div class="message green center">';
				echo 'Sub-category added !';
				echo '</div>';
			}
		}
	}
}
?>
