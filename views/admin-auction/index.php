<?php
/* @var $products /app/models/ProductAuction */
use yii\helpers\Html;
//var_dump($products);
?>
<div class="col-md-12">
    <div class="card table-card">
<!--        <a href="admin-auction/create" class="btn btn-primary">Add new</a>-->
        <?= Html::a('Add new',['admin-auction/create'], ['class' => 'btn btn-primary']) ?>
        <div class="card-header">
            <h5>Products</h5>
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
                        <th>Id</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Start price</th>
                        <th>Current price</th>
                        <th>Max price</th>
                        <th>End price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product){ ?>
                    <tr>
                        <td><?= $product->id ?></td>
                        <td>
                            <div class="d-inline-block align-middle">
                                 <div class="d-inline-block">
                                    <h6>Name: <br><?= $product->name ?></h6>
                                </div>
                            </div>
                        </td>
                        <td><?= $product->category_name ?></td>
                        <td><?= $product->start_price ?></td>
                        <td><?= $product->current_price ?></td>
                        <td><?= $product->end_price ?></td>
                        <td><?= $product->description ?></td>
                        <td>
                            <?=isset($product->images[0])? Html::img('@web/images/product_images/'.$product->images[0],['alt' => 'image', 'height' => 50,'width'=> 50]) : Html::img('@web/images/no-photo-available.png',['alt' => 'image', 'height' => 50,'width'=> 50])?>
                        </td>
                        <td>
                            <?= Html::a('<i class="fa fa-edit">',['admin-auction/update?id='.$product->id]).'</i>' ?>
                            <?= Html::a('<i class="fa fa-trash">',['admin-auction/delete?id='.$product->id]).'</i>' ?>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>