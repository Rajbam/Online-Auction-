<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
    "width=device-width, initial-scale=1.0">
    <title>Online Auction</title>
    <?php
    session_start();
    include('admin\db_connect.php');
    ob_start();
        $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
         foreach ($query as $key => $value) {
          if(!is_numeric($key))
            $_SESSION['system'][$key] = $value;
        }
    ob_end_flush();
    include('header.php');

	
    ?>

    <style>
        #main-field {
            margin-top: 5rem !important;
        }
        #div1{

            /*background-color: red;*/
            /*background-image: linear-gradient(to right, rgba(255, 0, 0, 0.50),yellow, rgba(0, 128, 0, 0.76));*/
            /*background-image: repeating-linear-gradient( rgba(255, 0, 0, 0.50) 40%,yellow 20%, rgba(0, 128, 0, 0.76));*/
            background-image: radial-gradient(#283048, #859398);
            /* farthest-corner at 40px 50px, #f35 0%, #43e 100%*/
            /*overflow: hidden;*/
            /*overflow: scroll;*/
            overflow: auto;

        }
        #div1 p {
            text-align: justify;
        }

        h10 {
            font-size: 16px;
          background: -webkit-linear-gradient(#4CC417, #D4A017);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        h3 {
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
                       #E41B17, #FDD017);
            }

            100% {
                background: linear-gradient(
                        #FF6700, #E2F516);

            }
        }
    </style>
</head>
    <body id="page-top">
        <!-- Navigation-->
        <div id="div1">
        <div align="left" class="toast" id="alert_toast" role="alert" aria-live="asseertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-1" id="mainNav">
            <div class="container">

                <a class="navbar-brand js-scroll-trigger"  href="./"><large><h3><?php echo $_SESSION['system']['name'] ?><i class="fa fa-gavel"></i></h3></large></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-1 my-lg-0">
                        <li class="nav-item" ><a class="nav-link js-scroll-trigger" href="index.php?page=home"><i class="fa fa-home"></i><h10> Home</h10></a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about"><i class="fa fa-info-circle"></i><h10>   AboutUs</h10></a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=contactus"><i class="fa fa-address-book"></i><h10> ContactUs</h10></a></li>
                        <?php if(isset($_SESSION['login_id'])): ?>
                            &nbsp; &nbsp;<li class="nav-item"><a class="nav-link js-scroll-trigger" href="admin/ajax.php?action=logout2"><i class="fa fa-power-off"></i><h10> <?php echo "Welcome,".$_SESSION['login_name'] ?></h10></a></li>
                      <?php else: ?>
                            &nbsp; &nbsp; <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="login_now" id="login_now"><i class="fa fa-user"></i> <h10> Login</h10></a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="new_account"><i class="fas fa-user-plus"></i> <h10>SignUp</h10></a></li>
                        &nbsp; &nbsp; <li class="nav-item" ><a class="nav-link js-scroll-trigger" href="index.php?page=wishlist"><i class="fa fa-cart-plus"></i><h10>MyWishlist</h10></a></li>
                    </ul>

                </div>
            </div>
        </nav>
  <main id="main-field">
        <?php 
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        include $page.'.php';
        ?>
       
</main>
<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
  <div id="preloader"></div>
        <footer class=" py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0 text-white">Contact us</h2>
                        <hr class="divider my-4" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                        <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                        <div class="d-block" href="Callto:<?php echo $_SESSION['system']['contact'] ?>"><?php echo $_SESSION['system']['contact'] ?></div>
                    </div>
                    <div class="col-lg-4 mr-auto text-center">
                        <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                        <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                        <a class="d-block" href="mailto:<?php echo $_SESSION['system']['email'] ?>"><?php echo $_SESSION['system']['email'] ?></a>
                    </div>
                </div>
            </div>
            <br>
            <div class="container"><div class="small text-center text-muted">Copyright © 2021 - <?php echo $_SESSION['system']['name'] ?> | <a href="https://www.sourcecodester.com/" target="_blank">Students Project</a></div></div>
        </footer>
        
       <?php include('footer.php') ?>
        </div>
    </body>
    <script type="text/javascript">
      $('#login').click(function(){
        uni_modal("Login",'login.php')
      })
      $('.datetimepicker').datetimepicker({
          format:'Y-m-d H:i',
      })
      $('#find-car').submit(function(e){
        e.preventDefault()
        location.href = 'index.php?page=search&'+$(this).serialize()
      })
    </script>

    <?php $conn->close() ?>


</html>
