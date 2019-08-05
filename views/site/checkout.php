<?php
/* @var $product \app\models\Product*/
/* @var $cart \app\models\Cart*/
/* @var $model app\models\User */


use yii\helpers\Html;
use yii\helpers\Url;
?>


	<!-- BREADCRUMB -->
<!--	<div id="breadcrumb">-->
<!--		<div class="container">-->
<!--			<ul class="breadcrumb">-->
<!--				<li><a href="#">Home</a></li>-->
<!--				<li class="active">Checkout</li>-->
<!--			</ul>-->
<!--		</div>-->
<!--	</div>-->
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<form id="checkout-form" class="clearfix">
					<div class="col-md-6">
						<div class="billing-details">
							<p>Already a customer ? <a href="#">Login</a></p>
							<div class="section-title">
								<h3 class="title">Billing Details</h3>
							</div>

							<div class="form-group">
								<input class="input" type="text" name="last-name" placeholder="Username" value="<?= Yii::$app->user->identity->username ?>">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email" value="<?= Yii::$app->user->identity->email ?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address">
							</div>

							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country" value="<?= Yii::$app->user->identity->location ?>">
							</div>

							<div class="form-group">
								<input class="input" type="tel" name="tel" placeholder="Telephone" value="<?= Yii::$app->user->identity->mobile_number ?>">
							</div>
							<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" id="register">
									<label class="font-weak" for="register">Create Account?</label>
									<div class="caption">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.
											<p>
												<input class="input" type="password" name="password" placeholder="Enter Your Password">
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="shiping-methods">
							<div class="section-title">
								<h4 class="title">Shiping Methods</h4>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="shipping" id="shipping-1" checked>
								<label for="shipping-1">Free Shiping -  $0.00</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
										<p>
								</div>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="shipping" id="shipping-2">
								<label for="shipping-2">Standard - $4.00</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
										<p>
								</div>
							</div>
						</div>

						<div class="payments-methods">
							<div class="section-title">
								<h4 class="title">Payments Methods</h4>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="payments" id="payments-1" checked>
								<label for="payments-1">Direct Bank Transfer</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
										<p>
								</div>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="payments" id="payments-2">
								<label for="payments-2">Cheque Payment</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
										<p>
								</div>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="payments" id="payments-3">
								<label for="payments-3">Paypal System</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
										<p>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Order Review</h3>
							</div>
							<table class="shopping-cart-table table">
								<thead>
									<tr>
										<th>Product</th>
										<th></th>
										<th class="text-center">Price</th>
										<th class="text-center">Quantity</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>


                                <?php
                                if($_SESSION['cartProducts'])
                                    foreach ($_SESSION['cartProducts'] as $product) {
                                    $image = \app\models\ProductPhoto::find()->where(['product_id' => $product->id])->one();
                                    ?>
                                    <tr>

                                        <td class="thumb"><?= Html::img('@web/images/product_images/'.$image->image_name) ?></td>
                                        <td class="details">
                                            <a href="/goods/product?id=<?= $product->id ?>"><?= $product->name ?></a>

                                            <ul>
                                                <li><span> <?= $product->cartColor ?></span></li>
                                            </ul>
                                        </td>
                                        <td class="price text-center"><strong><?= round($product->price) ?> ₴</strong><br></td>
                                        <td class="qty text-center"><input class="input" type="number" value="<?=  $product->cartQuantity ?>"></td>
                                        <td class="total text-center"><strong class="primary-color"><?= $AllTotal = $product->price*$product->cartQuantity ?> ₴</strong></td>
                                        <?php $id = Yii::$app->user->isGuest ? $product->id : $product->cartId; ?>
                                        <td class="text-right"><button class="main-btn icon-btn"> <?= Html::a('X',['site/delete-from-cart?id='.$id])?></button></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>

									<tr>
										<th class="empty" colspan="3"></th>
										<th>SHIPING</th>
										<td colspan="2">Free Shipping</td>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>TOTAL</th>
										<th colspan="2" class="total"><?= $_SESSION['cartSum'] ?>₴</th>
									</tr>
								</tfoot>
							</table>

							<div class="pull-right">
                                <?= Html::a('<button class="primary-btn" type="button">Place Order</button>',['/site/send-checkout-email']) ?>
							</div>

						</div>

					</div>
				</form>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->
