<?php

session_start();
include('admin/functions/functions.php');
include('config/dbcon.php');
include_once("header.php");
$sql_product_details = "SELECT * FROM `products` where id=" . $_GET['product_id'];

$row_product_details = getQueryDataList($sql_product_details);



?>
<div class="content_wrapper bg_homebefore pt-0">
	<div class="container-fluid">
		<div class="row mt-2">
			<div class="col-sm-5 p-0 col-12">
				<?php
				if ((!empty($row_product_details[0]['chlide_model_id']))) {
				?>
					<a href="products.php?chlide_model_id=<?php echo $row_product_details[0]['chlide_model_id']; ?>"><i class="fa fa-arrow-left"> </i> Back</a>
				<?php
				} else {
				?>
					<a href="models-details.php?company_id=<?php echo $row_product_details[0]['company_id']; ?>&model_id=<?php echo $row_product_details[0]['model_id']; ?>"><i class="fa fa-arrow-left"></i> Back</a>

				<?php
				}
				?>


				<span class="float-right">
					<a href="javascript:void(0);" id="shareButton" onclick="shareProduct()">
						<i class="fa fa-share"></i>
					</a>
				</span>
			</div>
		</div>

		<div class="content-bar">
			<!-- Start row -->
			<div class="row">
				<!-- Start col -->
				<div class="col-lg-12 col-xl-3 p-1">

					<div class="card m-b-5">
						<div class="card-body">
							<?php
							if (!empty($row_product_details)) {

							?>
								<div class="product-img1">
									<img class="img-fluid" src="<?php echo 'admin/uploads/products/' . $row_product_details[0]['image']; ?>" />
								</div>
								<div class="product-content1">

									<table class="table table-stripped">
										<tr>
											<td>Category</td>
											<?php
											$sql_category_name = "SELECT * FROM `categories` where id=" . $row_product_details[0]['category_id'];

											$row_category_name  = getQueryData($sql_category_name);
											?>
											<td><?php echo $row_category_name['name']; ?></td>
										</tr>
										<tr>
											<td>Company</td>


											<?php
											$sql_Company_name = "SELECT * FROM `companies` where id=" . $row_product_details[0]['company_id'];

											$row_Company_name  = getQueryData($sql_Company_name);
											?>
											<td><?php echo $row_Company_name['name']; ?></td>
										</tr>

										<tr>
											<td>Car</td>

											<?php
											$sql_model_name = "SELECT * FROM `models` where id=" . $row_product_details[0]['model_id'];

											$row_model_name  = getQueryData($sql_model_name);
											?>
											<td><?php echo $row_model_name['name']; ?></td>

										</tr>
										<tr>
											<td>Product Name</td>
											<td><?php echo $row_product_details[0]['name']; ?></td>
										</tr>
										<tr>
											<td>Product Code</td>
											<td><?php echo $row_product_details[0]['code']; ?></td>
										</tr>
										<tr>
											<td>Packing Unit</td>
											<td><?php echo $row_product_details[0]['unit']; ?></td>
										</tr>
										<tr>
											<td>MRP</td>
											<td><?php echo number_format($row_product_details[0]['mrp'], 0, '', ''); ?></td>

										</tr>
									</table>
								<?php
							}
								?>
								</div>

						</div>
					</div>
				</div>


			</div>
			<!-- End row -->
		</div>
		<!-- End Rightbar -->
	</div>


</div>


<script>
	function shareProduct() {
		if (navigator.share) {

			var shareContent = `
Category: <?php echo $row_category_name['name']; ?>\n
Company: <?php echo $row_Company_name['name']; ?>\n
Car: <?php echo $row_model_name['name']; ?>\n
Product Name: <?php echo $row_product_details[0]['name']; ?>\n
Product Code: <?php echo $row_product_details[0]['code']; ?>\n
Packing Unit: <?php echo $row_product_details[0]['unit']; ?>\n
MRP: Rs.<?php echo number_format($row_product_details[0]['mrp'], 0, '', ''); ?>`;

			navigator.share({
					title: 'Product Details',
					text: shareContent,
				})
				.then(() => console.log('Successfully shared'))
				.catch((error) => console.error('Error sharing:', error));
		} else {
			alert('Web Share API is not supported on this browser.');
		}
	}
</script>






<?php include_once("footer.php") ?>