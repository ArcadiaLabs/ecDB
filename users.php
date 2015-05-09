<?php
	require_once('include/login/auth.php');
	require_once('include/debug.php');

	require_once('include/mysql_connect.php');
	include_once("include/include_parse_admin_options.php");

	if($_SESSION['SESS_IS_ADMIN'] == 0)
	{
		header("location: index.php");
		exit();
	}
	
	if(isset($_GET['setadmin']) && isset($_GET['admin'])) {
		$qry_setadmin = "UPDATE members SET admin = '".$_GET['admin']."' WHERE member_id = '".$_GET['setadmin']."'";
		$sql_exec_setadmin = mysqli_query($GLOBALS["___mysqli_ston"], $qry_setadmin);
		$message = '
		<div class="message blue center">
			User modified successfully.
		</div>';
	}
	
	if(isset($_GET['userdeleteconfirm'])) {
		$message = '
		<div class="message blue center">
			Do you really want to delete this user ?<br><br>
			<table>
				<tr>
					<td><a href="?userdelete='.$_GET['userdeleteconfirm'].'"><button class="button green" type="submit"><span class="icon medium checkmark"></span> Yes</button></a></td>
					<td><a href="users.php"><button class="button red" type="submit"><span class="icon medium roundMinus"></span> No</button></a></td>
				</tr>
			</table>
		</div>';
	}
	
	if(isset($_GET['userdelete'])) {
		$qry_userdelete = "DELETE FROM members WHERE member_id = '".$_GET['userdelete']."'";
		$sql_exec_userdelete = mysqli_query($GLOBALS["___mysqli_ston"], $qry_userdelete);
		$message = '
		<div class="message blue center">
			User deleted successfully.
		</div>';
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<meta name="description" content="Viwe all your added components."/>
		<meta name="keywords" content="electronics, components, database, project, inventory"/>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="img/apple.png" />
		<title>Home - ecDB</title>
		<?php include_once("include/analytics.php") ?>
	</head>
	<body>
		<div id="wrapper">
			<!-- Header -->
			<?php include 'include/header.php'; ?>
			<!-- END -->
			<!-- Main menu -->
			<?php include 'include/menu.php'; ?>
			<!-- END -->
			<!-- Main content -->
			<div id="content">
				<div class="subMenu">
					<ul>

						<?php 
						if(isset($message))
						{
							echo $message; 
						} 
						?>
						<table>
							<tr>
								<td>
									<div class="buttons">
										<div class="input">
											<form action="register.php" method="get">
												<button class="button green" type="submit"><span class="icon medium user"></span> Add New User</button>
											</form>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</ul>
				</div>
			<?php
			$qry = "SELECT * FROM members ORDER by login ASC";
			$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $qry);
			
			
			echo '
			<div>
			<table class="globalTables" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>
								Name
							</th>
							<th>
								Admin
							</th>
							<th>
								Components added
							</th>
							<th>
								Projects
							</th>
							<th>
								Delete
							</th>
						</tr>
					</thead>
			';
			while ($user = mysqli_fetch_array($sql_exec))
			{
				echo '
					<tr>
						<td>'.$user['login'].'</td>
						';
				$admin = $user['admin'];
				if ($admin == "0"){
					
					echo '	<td><a href=?setadmin='.$user['member_id'].'&admin=1><span class="icon medium checkboxUnchecked"></span></a></td>';
				}
				else{
					echo '	<td><a href=?setadmin='.$user['member_id'].'&admin=0><span class="icon medium checkboxChecked"></span></a></td>';
					
				}
				
				$qry_count_components = "SELECT * FROM data WHERE owner = '".$user['member_id']."'";
				$sql_count_components = mysqli_query($GLOBALS["___mysqli_ston"], $qry_count_components);
				$num_components = mysqli_num_rows($sql_count_components);
				echo '		<td>'.$num_components.'</td>';
				
				$qry_count_projects = "SELECT * FROM projects WHERE project_owner = '".$user['member_id']."'";
				$sql_count_projects = mysqli_query($GLOBALS["___mysqli_ston"], $qry_count_projects);
				$num_projects = mysqli_num_rows($sql_count_projects);
				echo '		<td>'.$num_projects.'</td>';
				
				echo '		<td><a href=?userdeleteconfirm='.$user['member_id'].'><span class="icon medium trash"></span></a></td>';
				echo '</tr>';
			}
			echo '
			</table>
			</div>
			';
			?>
			<!-- END -->
			<!-- Text outside the main content -->
				<?php include 'include/footer.php'; ?>
			<!-- END -->
		</div>
	</body>
</html>
