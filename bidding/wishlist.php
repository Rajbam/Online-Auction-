<!DOCTYPE html>
<body lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
    "width=device-width, initial-scale=1.0">
    <title>Online Auction</title>
    <?php include('admin\db_connect.php');?>
    <style>
        td{
            vertical-align: middle !important;
        }
        td p{
            margin: unset
        }
        img{
            max-width:100px;
            max-height: :150px;
        }
#div1{
    background-image: background: rgba(167, 41, 42, 1.0);
    background-image: -webkit-linear-gradient(bottom left, rgba(167, 41, 42, 1.0), rgba(96, 89, 132, 1.0));
    background-image: -moz-linear-gradient(bottom left, rgba(167, 41, 42, 1.0), rgba(96, 89, 132, 1.0));
    background-image: linear-gradient(to top right, rgba(167, 41, 42, 1.0), rgba(96, 89, 132, 1.0));
}

        #div2{
            background-image: radial-gradient(#380036, #0cbaba);
        }
        #div2 p{
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
        .close {
            cursor: pointer;
            position: absolute;
            top: 50%;
            right: 0%;
            padding: 12px 16px;
            transform: translate(0%, -50%);
        }

        .close:hover {background: #bbb;}

        #btn{
            margin-right: 10px;
        }

    </style>
</head>
<body>
<div class="container-fluid">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">

            </div>
        </div>
        <div class="row">
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-12">
                <br>
                <div class="card">
                    <div id="div2" class="card-header" align="center">

                        <h3> <b>Order WishList</b></h3>

                    </div>
                    <div class="card-body">
                        <table id="div1" class="table table-condensed table-bordered table-dark">
                            <thead>
                            <tr>
                                <th class="text-center">S.No.</th>
                                <th class="">Product Name <i class="fa fa-list-alt"></i></th>
                                <th class="">UserName <i class="fas fa-user"></i></th>
                                <th class="">Amount <i class="fas fa-dollar-sign"></i></th>
                                <th class="">Shipping <i class="fa fa-shopping-cart"></i></th>
                                <th class="text-center">Apply/Cancel Your Order<i class="fab fa-cc-amazon-pay"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $cat = array();
                            $cat[] = '';
                            $qry = $conn->query("SELECT * FROM categories ");
                            while($row = $qry->fetch_assoc()){
                                $cat[$row['id']] = $row['name'];
                            }
                            $books = $conn->query("SELECT b.*, u.name as uname,p.name,p.bid_end_datetime bdt FROM bids b inner join users u on u.id = b.user_id inner join products p on p.id = b.product_id ");
                            while($row=$books->fetch_assoc()):
                                $get = $conn->query("SELECT * FROM bids where product_id = {$row['product_id']} order by bid_amount desc limit 1 ");
                                $uid = $get->num_rows > 0 ? $get->fetch_array()['user_id'] : 0 ;
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="">
                                        <p> <b><?php echo ucwords($row['name']) ?></b></p>
                                    </td>
                                    <td class="">
                                        <p> <b><?php echo ucwords($row['uname']) ?></b></p>
                                    </td>
                                    <td class="text-right">
                                        <p> <b><?php echo number_format($row['bid_amount'],2) ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <?php if($row['status'] == 1): ?>
                                            <?php if(strtotime(date('Y-m-d H:i')) < strtotime($row['bdt'])): ?>
                                                <span class="badge badge-secondary">Bidding Stage</span>
                                            <?php else: ?>
                                                <?php if($uid == $row['user_id']): ?>
                                                    <span class="badge badge-success">Shipping Your Product</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary">Loose in Bidding</span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php elseif($row['status'] == 2): ?>
                                            <span class="badge badge-primary">Confirmed</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Canceled</span>
                                        <?php endif; ?>
                                    </td>
                                    <td align="center">
                                        <a href="index.php?page=wishlist"><button class="btn btn-primary btn-sm view_user" type="button"><i class="fa fa-sync"></i>Apply</button></a>
                                        <button class="btn btn-danger btn-sm view_user" type="button" data-id ='<?php echo $row['user_id'] ?>'><i class="fa fa-times"></i>Cancel</button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
        </div>
    </div>

</div>
<p id="btn" align="right">
<a href="index.php?page=checkout"> <button class="btn btn-success btn-sm view_user"  type="button" data-id ='<?php echo $row['user_id'] ?>'>Online Payment <i class="fas fa-dollar-sign"></i></button></a>
&nbsp;&nbsp;<a href="index.php?page=checkout"> <button class="btn btn-danger btn-sm view_user"  type="button" data-id ='<?php echo $row['user_id'] ?>'>Cash On Delivery <i class="fas fa-dollar-sign"></i></button></a>
</p>
</body>
<script>
    $(document).ready(function(){
        $('table').dataTable()
    })

    $('.view_user').click(function(){
        uni_modal("<i class'fa fa-card-id'></i> Buyer Details","view_udet.php?id="+$(this).attr('data-id'))

    })
    $('#new_book').click(function(){
        uni_modal("New Book","manage_booking.php","mid-large")

    })
    $('.edit_book').click(function(){
        uni_modal("Manage Book Details","manage_booking.php?id="+$(this).attr('data-id'),"mid-large")

    })
    $('.delete_book').click(function(){
        _conf("Are you sure to delete this book?","delete_book",[$(this).attr('data-id')])
    })

    function delete_book($id){
        start_load()
        $.ajax({
            url:'ajax.php?action=delete_book',
            method:'POST',
            data:{id:$id},
            success:function(resp){
                if(resp==1){
                    alert_toast("Data successfully deleted",'success')
                    setTimeout(function(){
                        location.reload()
                    },1500)

                }
            }
        })
    }
    var closebtns = document.getElementsByClassName("close");
    var i;

    for (i = 0; i < closebtns.length; i++) {
        closebtns[i].addEventListener("click", function() {
            this.parentElement.style.display = 'none';
        });
    }
</script>
</html>