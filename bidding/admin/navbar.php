<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
    "width=device-width, initial-scale=1.0">
    <title>Online Auction</title>
<style>
	.collapse a{
		text-indent:10px;
        background: rgb(red,yellow,green);
	}
</style>
</head>
<body>
<nav id="sidebar" class='mx-lt-8 bg bg-light' >
    <br> <br>
		<div class="sidebar-fill">
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-list"></i></span> Categories</a>
				<a href="index.php?page=products" class="nav-item nav-products"><span class='icon-field'><i class="fa fa-th-list"></i></span> Products</a>
            <a href="index.php?page=deals" class="nav-item nav-Hot Deals"><span class='icon-field'><i class="fa fa-fire-alt"></i></span> Hot Deals</a>
				<a href="index.php?page=bids" class="nav-item nav-bids"><span class='icon-field'><i class="fa fa-money-bill-alt"></i></span> Bids</a>
            <a href="index.php?page=order" class="nav-item nav-Order details"><span class='icon-field'><i class="fa fa-money-check-alt"></i></span> Order Details</a>
				<?php if($_SESSION['login_type'] == 1): ?>
                    <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Manage Users</a>

                    <a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs"></i></span> Settings</a>
			<?php endif; ?>
		</div>

</nav>
</body>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
</html>
