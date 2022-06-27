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
    <form action="" id="signup-frm">
        <div class="form-group">
            <label for="" class="control-label">Name</label>
            <input type="text" required name="name" placeholder="Full Name" required="" class="form-control">
        </div>
        <div class="form-group">
            <label for="" class="control-label">Contact</label>
            <input type="text" required name="contact" placeholder="Contact Number" required="" class="form-control">
        </div>
        <div class="form-group">
            <label for="" class="control-label">Address</label>
            <textarea cols="30" rows="3" required name="address" placeholder="Full Address with(Town/city,Area/village,Building/Apartment/ House N.o.,Pincode)" required="" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="" class="control-label">Email</label>
            <input type="email" required name="email" placeholder="OnlineAuc00@gmail.com" required="" class="form-control">
        </div>
        <div class="form-group">
            <label>Gender</label>
            <div>
                <input type="radio" checked name="gender" id="male" value="Male"> <label for="male">Male</label>
                <input type="radio" name="gender" id="female" value="Female"> <label
                        for="female">Female</label>
            </div>
            <div class="form-group">
                <label for="" class="control-label"><i class="fa fa-user" aria-hidden="true"></i> Username</label>
                <input type="text" required name="username" placeholder="Username" required="" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="control-label"><i class="fa fa-lock"></i> Password</label>
                <input type="password" required name="password" placeholder="Password" required="" class="form-control">
            </div>
            <div class="form-group" align="right">
                <small><a href="javascript:void(0)" id="new_account">Change Password</a></small>
            </div>
            <button onclick="showMessagewithDelay()" onmouseover="startBlink()"
                    onmouseout="stopBlink()" id="btn1"
                    class="button btn btn-primary btn-sm">Sign up <i class="fas fa-user-plus"></i></button>
            <button onclick="showMessagewithDelay()" onmouseover="startBlink()"
                    onmouseout="stopBlink()" id="btn2" class="button btn btn-danger btn-sm" type="button" data-dismiss="modal">Close <i class="fas fa-times"></i></button>

    </form>
</div>
</body>
<script>
    $('#signup-frm').submit(function(e){
        e.preventDefault()
        start_load()
        if($(this).find('.alert-danger').length > 0 )
            $(this).find('.alert-danger').remove();
        $.ajax({
            url:'admin/ajax.php?action=signup',
            method:'POST',
            data:$(this).serialize(),
            error:err=>{
                console.log(err)
                $('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');

            },
            success:function(resp){
                if(resp == 1){
                    location.reload();
                }else{
                    $('#signup-frm').prepend('<div class="alert alert-danger">Sorry,ERROR OCCURED!!</div>')
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
            alert('You have Successfully Signed up, Lets do some Bidding & Auction Here.. ')
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
            alert('Dear User, You Have to Login/Sign up First... ')
        }, 1000)

    }

</script>
</html>