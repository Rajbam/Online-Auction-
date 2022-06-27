<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
    "width=device-width, initial-scale=1.0">
    <title>Online Auction</title>
    <?php session_start() ?>
    <style>
        #uni_modal .modal-footer{
            display:none;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <form action="" id="login-frm">
        <div class="form-group">
            <label for="" class="control-label"><i class="fa fa-user" aria-hidden="true"></i> Username</label>
            <input type="text" name="username"  placeholder="Username" required="" class="form-control">
        </div>
        <div class="form-group">
            <label for="" class="control-label"><i class="fa fa-lock"></i> Password</label>
            <input type="password" name="password"  autocomplete="current-password" placeholder="Password " required="" class="form-control">
        </div>
        <div class="form-group" align="right">
            <small><a href="javascript:void(0)" id="new_account">Forgot Password?</a></small>
        </div>
        <br>
        <button onclick="showMessagewithDelay()" onmouseover="startBlink()"
                onmouseout="stopBlink()" id="btn1"
                class="button btn btn-primary btn-sm">Login <i class="fas fa-sign-in-alt"></i></button>
        <button onclick="showMessagewithDelay()" onmouseover="startBlink()"
                onmouseout="stopBlink()" id="btn2" class="button btn btn-danger btn-sm" type="button" data-dismiss="modal">Cancel <i class="fas fa-times"></i></button>
        <br>
        <br>
    </form>
</div>
</body>

<script>
    $('#new_account').click(function(){
        uni_modal("Create an Account",'signup.php?redirect=index.php?page=checkout')
    })
    $('#login-frm').submit(function(e){
        e.preventDefault()
        start_load()
        if($(this).find('.alert-danger').length > 0 )
            $(this).find('.alert-danger').remove();
        $.ajax({
            url:'admin/ajax.php?action=login2',
            method:'POST',
            data:$(this).serialize(),
            error:err=>{
                console.log(err)
                end_load()

            },
            success:function(resp){
                if(resp == 1){
                    location.href ='<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home' ?>';
                }else{
                    $('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>')
                    end_load()
                }
            }
        })
    })
    function changeColor() {
        console.log('function called')
        let btn = document.getElementById('btn1');
        if (btn.className === 'btn btn-primary') {
            btn.className = 'btn btn-danger';
        } else {
            btn.className = 'btn btn-primary';
        }
    }

    var timer

    function startBlink() {
        timer = setInterval(changeColor, 300);
    }
    function stopBlink() {
        clearInterval(timer)
    }
    function showMessagewithDelay() {
        setTimeout(function () {
            alert('You Have Successfully Logged in...')
        }, 1000)

    }
    function changeColor() {
        console.log('function called')
        let btn = document.getElementById('btn2');
        if (btn.className === 'btn btn-primary') {
            btn.className = 'btn btn-danger';
        } else {
            btn.className = 'btn btn-primary';
        }
    }

    var timer

    function startBlink() {
        timer = setInterval(changeColor, 300);
    }
    function stopBlink() {
        clearInterval(timer)
    }
    function showMessagewithDelay() {
        setTimeout(function () {
            alert('Dear User, You Have to Login/Sign up to Join us.. ')
        }, 1000)

    }

</script>
</html>