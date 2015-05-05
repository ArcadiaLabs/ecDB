<?php
	require_once('include/login/auth.php');
	require_once('include/debug.php');
	require_once('include/mysql_connect.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<meta name="description" content="Add your projects here. You will then be able to add components to them and creat BOM-list."/>
		<meta name="keywords" content="electronics, components, database, project, inventory"/>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="img/apple.png" />
		<title>Your Projects - ecDB</title>
		<?php include_once("include/analytics.php") ?>

	</head>

	<body>
		<div id="wrapper">

<?php
if(isset($_SESSION['SESS_MEMBER_ID'])==true)
{
?>
			<!-- Header -->
			<?php include 'include/header.php'; ?>
			<!-- END -->
			<!-- Main menu -->
			<?php include 'include/menu.php'; ?>
			<!-- END -->
<?php
}
else
{

			include_once("include/include_parse_admin_options.php");
			require_once("include/logo_wrapper.php");
			?>

			<!-- Main menu -->
			<?php $selected_menu = ""; include_once('include/include_main_menu.php'); ?>
			<!-- END -->
<?php
}
?>

			<!-- Main content -->
				<div id="content">
<?php
						if(isset($_SESSION['SESS_MEMBER_ID'])==true)
						{
							include('include/include_cat_add.php');
							$AddProj = new CatAdd;
							$AddProj->AddCat();

							$cat_query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category");
							if(mysqli_num_rows($cat_query) == 0)
							{
								echo '<div class="message orange">empty message</div>';
							}
?>

					<?php
					if(isset($_GET['cat_del']) && intval($_GET['cat_del'])==1)
					{
					?>
					<div class="message red">
						Category Deleted
					</div>
					<?php
					}
					?>
					<form class="globalForms" method="post" action="">
						<div class="textInput">
							<label class="keyWord">Category name</label>
							<div class="input"><input name="name" id="name" type="text" class="medium" /></div>
						</div>
						<div class="buttons">
							<div class="input">
								<button class="button green" name="submit" type="submit"><span class="icon medium save"></span> Add Category</button>
							</div>
						</div>
					</form>

<?php
						}
						else
						{
							// nothing
						}
					?>

				</div>
				<!-- END -->
				<!-- Text outside the main content -->
					<?php include 'include/footer.php'; ?>
				<!-- END -->
		</div>
	</body>
</html>
