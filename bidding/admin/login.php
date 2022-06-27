<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
ob_start();
if(!isset($_SESSION['system'])){
    $system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
    foreach($system as $k => $v){
        $_SESSION['system'][$k] = $v;
    }
}
ob_end_flush();
?>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $_SESSION['system']['name'] ?></title>

    <?php include('./header.php'); ?>
    <?php
    if(isset($_SESSION['login_id']))
        header("location:index.php?page=home");

    ?>

<style>

    body{
        width: 100%;
        height: calc(100%);
        /*background: #007bff;*/
    }
    main#main{
        width: 100%;
        height: calc(100%);

    }
    #login-right{
        position: absolute;
        right:0;
        width:36%;
        height: calc(100%);
        display: flex;
        align-items: center;
    }
    #login-left{
        position: absolute;
        left:0;
        width:100%;
        height: calc(100%);
        background:#59b6ec61;
        display: flex;
        align-items: center;
        background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>);
        background-repeat: no-repeat;
        background-size: cover;
    }
    #login-right .card{
        margin: auto;
        z-index: 1
    }
    .logo {
        margin: auto;
        font-size: 8rem;
        background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>);
        padding: .5em 0.7em;
        border-radius: 20% 20%;
        color: #000000b3;
        z-index: 10;
    }
    div#login-right::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: calc(100%);
        height: calc(100%);

    }
    .main{
        text-align: center;
    }

    .marq{
        padding-top: 30px;
        padding-bottom: 30px;
    }
    h2 {
        font-size: 50px;
        font-family: Rockwell;
        color: transparent;
        text-align: center;
        animation: effect 2s linear infinite;
        \
    }

    @keyframes effect {
        0% {
            background: linear-gradient(
                    #ffc371, #ed4264);
            -webkit-background-clip: text;
        }

        100% {
            background: linear-gradient(
                     #43cea2, #aa076b);
            -webkit-background-clip: text;

        }
    }
</style>
</head>

<body id="page-top">
<div class="toast" id="alert_toast" role="alert" aria-live="asseertive" aria-atomic="true">
    <div class="toast-body text-white">
    </div>
</div>
<nav class=" navbar-danger fixed-top py-3" id="mainNav">
<div class="main">
    <h2>
    Online Auction.com
    </h2>
    <i style="font-size: 70;" class="fa fa-gavel"></i>
</div>
</nav>
<main id="main"  class=" bg-dark">
    <div id="login-left">
    </div>

    <div id="login-right">

        <div class="card col-md-8" >
            <div class="card-body" >

                <form id="login-form" >
                    <div class="form-group" >
                        <h1 align="center"><i class="fas fa-user"></i> Login</h1>
                        <div class="form-group">
                        <label for="username" class="control-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                    </div>
                    <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login <i class="fas fa-sign-in-alt"></i></button></center>
                </form>
            </div>

        </div>
    </div>

</main>

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>



</body>

<script>
    $('#login-form').submit(function(e){
        e.preventDefault()
        $('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
        if($(this).find('.alert-danger').length > 0 )
            $(this).find('.alert-danger').remove();
        $.ajax({
            url:'ajax.php?action=login',
            method:'POST',
            data:$(this).serialize(),
            error:err=>{
                console.log(err)
                $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

            },
            success:function(resp){
                if(resp == 1){
                    location.href ='index.php?page=home';
                }else{
                    $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
                    $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
                }
            }
        })
    })
</script>


</html>