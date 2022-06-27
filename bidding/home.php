<!DOCTYPE html>
<body lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
    "width=device-width, initial-scale=1.0">
    <title>Online Auction</title>
    <?php include 'admin/db_connect.php'; ?>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
        }

        .wrapper {
            width: 100%;
            max-width: 31.25rem;
            margin: 6rem auto;
        }

        .label {
            font-size: .625rem;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: +1.3px;
            margin-bottom: 1rem;
        }

        .searchBar {
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        #searchQueryInput {
            width: 100%;
            height: 2.8rem;
            background: #f5f5f5;
            outline: none;
            border: none;
            border-radius: 1.625rem;
            padding: 0 3.5rem 0 1.5rem;
            font-size: 1rem;
        }

        #searchQuerySubmit {
            width: 3.5rem;
            height: 2.8rem;
            margin-left: -3.5rem;
            background: none;
            border: none;
            outline: none;
        }

        #searchQuerySubmit:hover {
            cursor: pointer;
        }
        #cat-list li{
            cursor: pointer;
        }
        #cat-list li:hover {
            color: red;
            background: #BFE97E;
        }
        .prod-item p{
            margin: unset;
        }
        .bid-tag {
            position: absolute;
            right: .5em;
        }
        #div1{
            background-image: background: rgba(167, 41, 42, 1.0);
            background-image: -webkit-linear-gradient(bottom left, rgba(167, 41, 42, 1.0), rgba(96, 89, 132, 1.0));
            background-image: -moz-linear-gradient(bottom left, rgba(167, 41, 42, 1.0), rgba(96, 89, 132, 1.0));
            background-image: linear-gradient(to top right, rgba(167, 41, 42, 1.0), rgba(96, 89, 132, 1.0));

        }
        overflow: auto;

        }
        #div1 p {
            text-align: justify;
        }

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
<br>
<?php
$cid = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
?>
<div class="contain-fluid">
    <div class="col-lg-14" style="color: #E238EC">
        <div class="row" >
            <div class="col-md-3">
                <div id="div1" class="card" style="color: #36013F">
                    <span class="badge badge-pill">
                    <div class="card-header" style="font-size: 50px;" align="center">
                        <h4>Products On Auction</h4> <i style="font-size: 40px;" class="fa fa-gavel"></i>
                    </div>
                    <div class="card-body">
                        <ul class='list-group' id='cat-list'>
                            <li class='list-group-item' data-id='all' data-href="index.php?page=home&category_id=all">All Products  <i class="fa fa-list-alt"></i></li>
                            <?php
                            $cat = $conn->query("SELECT * FROM categories order by name asc");
                            while($row=$cat->fetch_assoc()):
                                $cat_arr[$row['id']] = $row['name'];
                                ?>
                                <li class='list-group-item' data-id='<?php echo $row['id'] ?>' data-href="index.php?page=home&category_id=<?php echo $row['id'] ?>"><?php echo ucwords($row['name']) ?></li>

                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div id="div1" class="card">

                        <div class="card-body" align="center">
                            <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

                            <div class="wrapper">
                                <div class="label"></div>
                                <div class="searchBar">
                                    <input id="searchQueryInput" type="text" name="search" autocomplete="on" placeholder="Search Your Products Here" data-id='all' data-href="index.php?page=home&category_id=all" style="width: 50% value="" />
                                    <button id="searchQuerySubmit" type="submit" name="searchQuerySubmit">
                                        <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#666666" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="result"></div>


                    <div class="card-body">
                        <div class="row">
                            <?php
                            $where = "";
                            if($cid > 0){
                                $where  = " and category_id =$cid ";
                            }
                            $cat = $conn->query("SELECT * FROM products where unix_timestamp(bid_end_datetime) >= ".strtotime(date("Y-m-d H:i"))." $where order by name asc");
                            if($cat->num_rows <= 0){
                                echo "<center><h4><i>No Products Avialable for Auction</i></h4></center>";
                            }

                            while($row=$cat->fetch_assoc()):
                                ?>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="float-right align-top bid-tag">
                                            <span class="badge badge-pill badge-primary text-white"><i class="fa fa-tag"></i> <?php echo number_format($row['start_bid']) ?></span>
                                        </div>
                                        <img class="card-img-top" src="admin/assets/uploads/<?php echo $row['img_fname'] ?>" alt="Card image cap">
                                        <div class="float-right align-top d-flex">
                                            <span class="badge badge-pill badge-success text-white"><i class="fa fa-hourglass-half"></i> <?php echo date("M d,Y h:i A",strtotime($row['bid_end_datetime'])) ?></span>
                                        </div>
                                        <div class="card-body prod-item">
                                            <p><?php echo $row['name'] ?></p>
                                            <p><small><?php echo $cat_arr[$row['category_id']] ?></small></p>
                                            <p class="truncate"><?php echo $row['description'] ?></p>
                                            <button class="btn btn-dark btn-sm view_prod" type="button" style="color: deepskyblue;" data-id="<?php echo $row['id'] ?>">View <i class="fas fa-eye"></i></button>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    $('#cat-list li').click(function(){
        location.href = $(this).attr('data-href')
    })
    $('#cat-list li').each(function(){
        var id = '<?php echo $cid > 0 ? $cid : 'all' ?>';
        if(id == $(this).attr('data-id')){
            $(this).addClass('active')
        }
    })
    $('.view_prod').click(function(){
        uni_modal_right('View Product','view_prod.php?id='+$(this).attr('data-id'))
    })

</script>

</html>