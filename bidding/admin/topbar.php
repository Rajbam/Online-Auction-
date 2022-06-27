<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
    "width=device-width, initial-scale=1.0">
    <title>Online Auction</title>
<style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: grey;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: crimson;
}
    h3{
        font-size: 50px;
    }
</style>
</head>
<body>

<nav class="navbar navbar-light fixed-top bg-dark" style="padding:0;min-height: 3.5rem">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" style="display: flex;">
  		
  		</div>
      <div class="col-md-4 float-left text-white">
        <large><h3 style="font-family: 'Rockwell'"><p style="color: rgb(255,40,0);"><strong> <?php echo $_SESSION['system']['name'] ?> </strong> <i class="fa fa-gavel"></i></p></h3><b></b></large>

      </div>
	  	<div class="float-right">
        <div class=" dropdown mr-4">
<br>
            <a href="#" class="text-white dropdown-toggle"  id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-shield"></i>  <?php echo $_SESSION['login_name'] ?> </a>
              <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
                <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
              </div>
        </div>
      </div>
  </div>
  
</nav>
</body>

<script>
  $('#manage_my_account').click(function(){
    uni_modal("Manage Account","manage_user.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
  })
</script>
</html>