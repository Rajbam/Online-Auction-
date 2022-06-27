<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
    "width=device-width, initial-scale=1.0">
    <title>Online Auction</title>
    <style>
    h4 {
    font-size: 30px;
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
    -webkit-background-clip: text;
    }

    100% {
    background: linear-gradient(
    #FF6700, #E2F516);
    -webkit-background-clip: text;
    }
    }
    </style>
</head>
<body>
<!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">

                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                    	 <h1 class="text-uppercase text-white-50 font-weight-bold">About Us</h1>
                        <hr class="divider my-4" />
                    </div>
                    
                </div>
            </div>
        </header>

    <section class="page-section">
        <div class="container">
    <?php echo html_entity_decode($_SESSION['system']['about_content']) ?>

        </div>
        </section>
</body>
</html>