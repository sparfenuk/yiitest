<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 20.01.2019
 * Time: 23:08
 */
use yii\helpers\Html;
?>


<div class="col-md-12">
    <div class="card table-card">
        <div class="card-header">
            <h5>ORDERS MANAGEMENT</h5>
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                    <li><i class="feather icon-maximize full-card"></i></li>
                    <li><i class="feather icon-minus minimize-card"></i></li>
                    <li><i class="feather icon-refresh-cw reload-card"></i></li>
                    <li><i class="feather icon-trash close-card"></i></li>
                    <li><i class="feather icon-chevron-left open-card-option"></i></li>
                </ul>
            </div>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="table table-hover m-b-0">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Product</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
<?php foreach ($orders as $order){
    $user = \app\models\User::find()->where(['id' => $order->user_id])->one();
    $product = \app\models\Product::find()->where(['id'=>$order->product_id])->one();

    ?>

                  <tr><!-- user widget -->
                          <td>
                               <div class="d-inline-block align-middle">
                                    <?= Html::img('@web/images/user_images/'.$user->photo_name,['alt' => 'user image', 'class' => 'img-radius img-40 align-top m-r-15','height' => 50,'width'=> 50])?>
                                    <div class="d-inline-block">
                                       <h6>Usnm:<br><?= $user->username ?></h6>
                                        <p class="text-muted m-b-0">Loc:<br><?=  $user->location ?></p>
                                    </div>
                               </div>
                           </td>
                           <td><?= $user->email ?></td>
                          <td>
                              <div class="d-inline-block align-middle">
                                  <?= Html::img('@web/images/product_images/'.\app\models\ProductPhoto::find()->where(['product_id'=>$product->id])->one()->image_name,['alt' => 'user image', 'class' => 'img-radius img-40 align-top m-r-15','height' => 50,'width'=> 50])?>
                                  <div class="d-inline-block">
                                      <h6>Product link:<br> <?= Html::a($product->name,['/goods/product?id='.$product->id]) ?> </h6>
                                      <h6>Price:<br><?=  round($product->price).' ₴' ?></h6>
                                  </div>
                              </div>
                          </td>
                            <td><?= $order->created_at ?></td>
                           <td>
                               <label class="badge badge-inverse-primary"><?= $order->status ?></label>
                            </td>
                           <td>
                               <?php switch ($order->status) {
                                   case \app\models\Order::CREATED:
                                       echo Html::a('<i class="fa fa-level-up"> ', ['/admin/change-order-status?orderId=' . $order->id . '&status=' . \app\models\Order::PAYED]) . '</i>';
                                       echo Html::a(' <i class="fa fa-ban"> ', ['/admin/change-order-status?orderId=' . $order->id . '&status=DELETED']) . '</i>';
                                       break;
                                   case \app\models\Order::PAYED:
                                       echo Html::a('<i class="fa fa-level-up"> ', ['/admin/change-order-status?orderId=' . $order->id . '&status=' . \app\models\Order::SEND]) . '</i>';
                                       break;
                                   case \app\models\Order::SEND:
                                       echo Html::a('<i class="fa fa-level-up"> ', ['/admin/change-order-status?orderId=' . $order->id . '&status=' . \app\models\Order::ARRIVED]) . '</i>';
                                       break;
                                   case \app\models\Order::ARRIVED:
                                       echo Html::a('<i class="fa fa-level-up">', ['/admin/change-order-status?orderId=' . $order->id . '&status=' . \app\models\Order::FINISHED]) . '</i>';
                                       echo Html::a(' <i class="fa fa-level-down"> ', ['/admin/change-order-status?orderId=' . $order->id . '&status=' . \app\models\Order::SEND]) . '</i>';
                                       break;
                                   case \app\models\Order::FINISHED:
                                       echo Html::a('<i class="fa fa-level-edit"> ', ['/admin/change-order-status?orderId=' . $order->id . '&status=' . \app\models\Order::DISPUTED]) . '</i>';
                                       echo Html::a(' <i class="fa fa-ban"> ', ['/admin/change-order-status?orderId=' . $order->id . '&status=DELETED']) . '</i>';
                                       break;
                                   case \app\models\Order::DISPUTED:
                                       echo Html::a('<i class="fa fa-level-up">  ', ['/admin/change-order-status?orderId=' . $order->id . '&status=' . \app\models\Order::FINISHED]) . '</i>';
                                       break;
                               }
                               ?>
                            </td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




