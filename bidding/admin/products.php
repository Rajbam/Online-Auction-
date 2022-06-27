<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
    "width=device-width, initial-scale=1.0">
    <title>Online Auction</title>
<?php include('db_connect.php');?>
    <style>

        td{
            vertical-align: middle !important;
        }
        td p{
            margin: unset
        }
        table td img{
            max-width:100px;
            max-height: :150px;
        }
        img{
            max-width:100px;
            max-height: :150px;
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
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
                        <h3 align="center">	<b>Products Lists</h3></b>
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="index.php?page=manage_product" id="new_product">
					<i class="fa fa-plus"></i> Add Products
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-active">
							<thead>
								<tr>
									<th class="text-center">S.No.</th>
									<th class="">Img</th>
									<th class="">Category</th>
									<th class="">Product<i class="fa fa-list-alt"></i></th>
									<th class="">Other Info<i class="fa fa-users"></i></th>
									<th class="text-center">Update<i class="fa fa-users"></i></th>
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
								$products = $conn->query("SELECT * FROM products order by name asc ");
								while($row=$products->fetch_assoc()):
									$get = $conn->query("SELECT * FROM bids where product_id = {$row['id']} order by bid_amount desc limit 1 ");
									$bid = $get->num_rows > 0 ? $get->fetch_array()['bid_amount'] : 0 ;
									$tbid = $conn->query("SELECT distinct(user_id) FROM bids where product_id = {$row['id']} ")->num_rows;
								?>
								<tr data-id= '<?php echo $row['id'] ?>'>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <div class="row justify-content-center">
										 	<img src="<?php echo 'assets/uploads/'.$row['img_fname'] ?>" alt="">
										 </div>
									</td>
									<td>
										 <p> <b><?php echo ucwords($cat[$row['category_id']]) ?></b></p>
									</td>
									<td class="">
										 <p>Name: <b><?php echo ucwords($row['name']) ?></b></p>
										 <p><small>Description: <b><?php echo $row['description'] ?></b></small></p>
									</td>
									<td>
										 <p><small>Regular Price: <b><?php echo number_format($row['regular_price'],2) ?></b></small></p>
										 <p><small>Start Price: <b><?php echo number_format($row['start_bid'],2) ?></b></small></p>
										 <p><small>End Date/Time: <b><?php echo date("M d,Y h:i A",strtotime($row['bid_end_datetime'])) ?></b></small></p>
										 <p><small>Highest Bid: <b class="highest_bid"><?php echo number_format($bid,2) ?></b></small></p>
										 <p><small>Total Bids: <b class="total_bid"><?php echo $tbid ?> user/s</b></small></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary edit_product" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
										<button class="btn btn-sm btn-outline-danger delete_product" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
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
</body>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	
	$('.view_product').click(function(){
		uni_modal("product Details","view_product.php?id="+$(this).attr('data-id'),'mid-large')
		
	})
	$('.edit_product').click(function(){
		location.href ="index.php?page=manage_product&id="+$(this).attr('data-id')
		
	})
	$('.delete_product').click(function(){
		_conf("Are you sure to delete this product?","delete_product",[$(this).attr('data-id')])
	})
	
	function delete_product($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_product',
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
</script>
</html>