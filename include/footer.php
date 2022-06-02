<div id="copyText">
    <div class="leftBox">
       
<?php if(isset($_SESSION['SESS_IS_ADMIN']) && $_SESSION['SESS_IS_ADMIN'] == 1 ) { ?>
        <div class="stats">
            <?php include_once('include/mysql_connect.php'); ?>

        	<span class="boldText">
        	<?php $members = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT member_id FROM members")); echo $members; ?>
        	</span>
			members,

			<span class="boldText">
			<?php $components = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT id FROM data")); echo $components; ?>
			</span>
			components and

			<span class="boldText">
			<?php $projects = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT project_id FROM projects")); echo $projects; ?>
			</span>
			projects.</br>

			<?php 
			if($_SESSION['SESS_IS_ADMIN'] == 1)
			{
				$total_price = 0;
				$total_quantity = 0;
				$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT price, quantity FROM data");
				while($showDetails = mysqli_fetch_array($sql_exec))
				{
					$total_price+=$showDetails['price']*$showDetails['quantity'];
					$total_quantity+=$showDetails['quantity'];
				}
				$member_id = $_SESSION['SESS_MEMBER_ID'];
				$currency_sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT currency FROM members WHERE member_id = ".$member_id."");
				$currency = mysqli_fetch_array($currency_sql);
				?>
				Stock : 
				<span class="boldText">
				<?php echo $total_quantity; ?>
				</span>
				 components for 
				<span class="boldText">
				<?php echo $total_price; ?> 
				</span>
				<?php echo $currency['currency']; 
			}
			?>
        </div>
<?php } ?>
		</br>
		<div>© 2010 - <?php echo date('Y'); ?> ecDB - Created by <a href="http://nilsf.se">Nils Fredriksson</a>, maintained by <a href="https://arcadia-labs.com">Stéphane Guerreau</a> - <a href="contact.php">Contact us</a> - <a href="terms.php">Terms & Privacy</a> - <a href="about.php">About</a></div>
    </div>
    <div class="rightBox">
        <!--Design by <a href="http://www.buildlog.eu"><span class="blIcon"></span></a>-->
    </div>
</div>
