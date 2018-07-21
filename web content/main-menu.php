<!--<link rel="stylesheet" type="text/css" href="stylesheet/main-menu.css"/>-->
<div id="section-topbar" align="center">
			<div id="topbar-inner">
			      <table width="1000px" >
				      <tr>
				        <td width="134" align="left"><a href="http://kis.orgfree.com/index.php">
                        <img src="http://kis.orgfree.com/images/etc/logo.png" /></a></td>
				        <td width="55" align="left" class="hed"><a href="http://kis.orgfree.com/shop/shop.php" target="_blank">shop</a></td>
				        <td width="45"  align="left" class="hed"><a href="http://kis.orgfree.com/shop/cart.php" target="_blank">cart</a></td>
				        <td width="45"  align="left" class="hed"><a href="http://kis.orgfree.com/shop/order.php" target="_blank">order</a></td>
				        <td width="712" align="right">
<?php
	if(isset($_SESSION["username"])){
		echo "<a href='http://kis.orgfree.com/member/profile.php'>คุณ ".$_SESSION['name']."</a> | 
		<a href='http://kis.orgfree.com/member/logout.php'>Logout</a>";
	}
	else{
		echo "<a href='http://kis.orgfree.com/member/login.php'>Login</a> | 
		<a href='http://kis.orgfree.com/form/formRegister.php'>Register</a>";
	}
?>
</td></tr>
			      </table>
			</div>
</div><!--section-topbar-->