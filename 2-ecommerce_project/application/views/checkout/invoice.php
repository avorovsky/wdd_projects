<?php
$invoice = \Models\Checkout::getInvoice($data);
$invoice[0];
$info = json_decode($invoice[0]['cart']);
$cart = (array) $info->cart;
$payment = $info->payment;
$user = \Models\User::getById(intval($invoice[0]['user_id']));
$date = date_create($invoice[0]['created_at']);
?>
<div class="container">
    <div class="row">
      <div class="alert alert-success">
        <strong>Payment was successful!</strong> Order placed.
      </div>

        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order # <?=$invoice[0]['id']?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					<?=$user['first_name']?>&nbsp;<?=$user['last_name']?><br>
    					<?=$user['address']?><br>
    					<?=$user['city']?>, <?=$user['province']?><br>
    					<?=$user['postal_code']?>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
              <?=$user['first_name']?>&nbsp;<?=$user['last_name']?><br>
    					<?=$user['address']?><br>
    					<?=$user['city']?>, <?=$user['province']?><br>
    					<?=$user['postal_code']?>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					<?=ucfirst($payment->card_type)?>&nbsp;ending<?=$payment->card_num?><br>
    					<?=ucfirst($payment->card_name)?>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					<?=date_format($date,"F d, Y");?><br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
                  <?php foreach ($cart as $item) :?>
                    <tr>
      								<td><?=$item->name?></td>
      								<td class="text-center">$<?=number_format($item->price,2,'.',',')?></td>
      								<td class="text-center"><?=$item->quantity?></td>
      								<td class="text-right">$<?=number_format($item->sub_total,2,'.',',')?></td>
      							</tr>
                  <?php endforeach;?>
                  <tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Taxes</strong></td>
    								<td class="no-line text-right">$<?=number_format($invoice[0]['taxes'],2,'.',',')?></td>
    							</tr>
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">$<?=number_format($invoice[0]['total_price'],2,'.',',')?></td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping</strong></td>
    								<td class="no-line text-right">$<?=number_format($invoice[0]['shipping_method_id'],2,'.',',')?></td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">$<?=number_format($invoice[0]['total_paid'],2,'.',',')?></td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
