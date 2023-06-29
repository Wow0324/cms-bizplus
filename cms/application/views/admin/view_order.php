<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().M_REWRITE.'admin');
}
?>

<?php
$CI =& get_instance();
$CI->load->model('admin/Model_order');
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Orders</h1>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">

			<?php
			if($this->session->flashdata('error')) {
				?>
				<div class="callout callout-danger">
					<p><?php echo safe_data($this->session->flashdata('error')); ?></p>
				</div>
				<?php
			}
			if($this->session->flashdata('success')) {
				?>
				<div class="callout callout-success">
					<p><?php echo safe_data($this->session->flashdata('success')); ?></p>
				</div>
				<?php
			}
			?>


			<div class="box box-info">
				<div class="box-body table-responsive">

					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>SL</th>
								<th>Customer Information</th>
								<th>Payment Date time</th>
								<th>Paid Amount</th>
								<th>Fee Amount</th>
								<th>Net Amount</th>
								<th>Payment Method</th>
								<th>Payment Status</th>
								<th>Order Number</th>
								<th width="140">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;
							foreach ($order as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo safe_data($i); ?></td>
									<td>
										Type: <br>
										<?php echo safe_data($row['customer_type']); ?><br>
										Name: <br>
										<?php echo safe_data($row['customer_name']); ?><br>
										Email: <br>
										<?php echo safe_data($row['customer_email']); ?><br>
										
									</td>
									<td><?php echo safe_data($row['payment_date_time']); ?></td>
									<td><?php echo '$'.safe_data($row['paid_amount']); ?></td>
									<td><?php echo '$'.safe_data($row['fee_amount']); ?></td>
									<td><?php echo '$'.safe_data($row['net_amount']); ?></td>
									<td><?php echo safe_data($row['payment_method']); ?></td>
									<td><?php echo safe_data($row['payment_status']); ?></td>
									<td><?php echo safe_data($row['order_no']); ?></td>
									<td>
										<a href="" class="btn btn-primary btn-xs btn-block" data-toggle="modal" data-target="#myModal<?php echo safe_data($i); ?>">See Detail</a>
										<a href="<?php echo base_url().M_REWRITE; ?>admin/order/delete/<?php echo safe_data($row['id']); ?>" class="btn btn-danger btn-xs btn-block" onClick="return confirm('Are you sure?');">Delete</a>
									</td>
								</tr>
								
								<!-- Modal -->
								<div class="modal fade" id="myModal<?php echo safe_data($i); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Order Detail</h4>
											</div>
											<div class="modal-body">
												<h4>Customer Information</h4>
												<div class="rTable">
													<div class="rTableRow">
														<div class="rTableCell">Customer Type</div>
														<div class="rTableCell"><?php echo safe_data($row['customer_type']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Customer Name</div>
														<div class="rTableCell"><?php echo safe_data($row['customer_name']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Customer Email</div>
														<div class="rTableCell"><?php echo safe_data($row['customer_email']); ?></div>
													</div>
												</div>

												<h4>Billing Information</h4>
												<div class="rTable">
													<div class="rTableRow">
														<div class="rTableCell">Name</div>
														<div class="rTableCell"><?php echo safe_data($row['billing_name']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Email</div>
														<div class="rTableCell"><?php echo safe_data($row['billing_email']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Phone</div>
														<div class="rTableCell"><?php echo safe_data($row['billing_phone']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Country</div>
														<div class="rTableCell"><?php echo safe_data($row['billing_country']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Address</div>
														<div class="rTableCell"><?php echo safe_data($row['billing_address']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">State</div>
														<div class="rTableCell"><?php echo safe_data($row['billing_state']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">City</div>
														<div class="rTableCell"><?php echo safe_data($row['billing_city']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Zip</div>
														<div class="rTableCell"><?php echo safe_data($row['billing_zip']); ?></div>
													</div>
												</div>

												<h4>Shipping Information</h4>
												<div class="rTable">
													<div class="rTableRow">
														<div class="rTableCell">Name</div>
														<div class="rTableCell"><?php echo safe_data($row['shipping_name']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Email</div>
														<div class="rTableCell"><?php echo safe_data($row['shipping_email']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Phone</div>
														<div class="rTableCell"><?php echo safe_data($row['shipping_phone']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Country</div>
														<div class="rTableCell"><?php echo safe_data($row['shipping_country']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Address</div>
														<div class="rTableCell"><?php echo safe_data($row['shipping_address']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">State</div>
														<div class="rTableCell"><?php echo safe_data($row['shipping_state']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">City</div>
														<div class="rTableCell"><?php echo safe_data($row['shipping_city']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Zip</div>
														<div class="rTableCell"><?php echo safe_data($row['shipping_zip']); ?></div>
													</div>
												</div>

												<h4>Other Information</h4>
												<div class="rTable">
													<div class="rTableRow">
														<div class="rTableCell">Order No</div>
														<div class="rTableCell"><?php echo safe_data($row['order_no']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Order Note</div>
														<div class="rTableCell"><?php echo safe_data($row['order_note']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Payment Date and Time</div>
														<div class="rTableCell"><?php echo safe_data($row['payment_date_time']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Transaction Id</div>
														<div class="rTableCell"><?php echo safe_data($row['txnid']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Shipping Cost</div>
														<div class="rTableCell"><?php echo safe_data($row['shipping_cost']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Coupon Code</div>
														<div class="rTableCell"><?php echo safe_data($row['coupon_code']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Coupon Discount</div>
														<div class="rTableCell"><?php echo safe_data($row['coupon_discount']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Paid Amount</div>
														<div class="rTableCell"><?php echo '$'.safe_data($row['paid_amount']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Fee Amount</div>
														<div class="rTableCell"><?php echo '$'.safe_data($row['fee_amount']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Net Amount</div>
														<div class="rTableCell"><?php echo '$'.safe_data($row['net_amount']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Payment Method</div>
														<div class="rTableCell"><?php echo safe_data($row['payment_method']); ?></div>
													</div>

													<div class="rTableRow">
														<div class="rTableCell">Card Number</div>
														<div class="rTableCell"><?php echo safe_data($row['card_number']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Card CVC</div>
														<div class="rTableCell"><?php echo safe_data($row['card_cvc']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Card Expiry Month</div>
														<div class="rTableCell"><?php echo safe_data($row['card_expiry_month']); ?></div>
													</div>
													<div class="rTableRow">
														<div class="rTableCell">Card Expiry year</div>
														<div class="rTableCell"><?php echo safe_data($row['card_expiry_year']); ?></div>
													</div>
												</div>

												<h4>Product Information</h4>
												<div class="rTable">
													<div class="rTableRow">
														<div class="rTableCell">SL</div>
														<div class="rTableCell">Name</div>
														<div class="rTableCell">Price</div>
														<div class="rTableCell">Quantity</div>
														<div class="rTableCell">Subtotal</div>
													</div>
													
													<?php
													$product = $CI->Model_order->get_product($row['id']);
													?>
													<?php
													$j=0;
													foreach($product as $pr) {
														$j++;
														?>
														<div class="rTableRow">
															<div class="rTableCell"><?php echo safe_data($j); ?></div>
															<div class="rTableCell"><?php echo safe_data($pr['product_name']); ?></div>
															<div class="rTableCell"><?php echo '$'.safe_data($pr['product_price']); ?></div>
															<div class="rTableCell"><?php echo safe_data($pr['product_qty']); ?></div>
															<div class="rTableCell">
																<?php
																$sub = $pr['product_price']*$pr['product_qty'];
																?>
																<?php echo '$'.safe_data($sub); ?>
															</div>
														</div>
														<?php
													}
													?>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
							?>							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


</section>