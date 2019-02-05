<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 20.01.2019
 * Time: 23:08
 */
?>


<div class="col-md-12">
    <div class="card table-card">
        <div class="card-header">
            <h5>Users edit</h5>
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
                    <?php foreach ($users as $user){ ?>
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
                            <td><?= $user->bought_items_count ?></td>
                            <td><?= $user->created_at ?></td>
                            <td>
                                <label class="badge badge-inverse-primary"><?= $user->status ?></label>
                            </td>
                            <td>
                                <?php if(Yii::$app->user->identity->status > $user->status){
                                    echo Html::a('<i class="fa fa-edit">',['/admin/user-edit?id='.$user->id]).'</i>';
                                    echo Html::a('<i class="fa fa-ban">',['/admin/user-ban?id='.$user->id]).'</i>';
                                }
                                else echo 'not enough permissions';
                                ?>
                                <?php if(Yii::$app->user->identity->status > 2 && $user->status < 2)
                                    echo Html::a('<i class="fa fa-level-up">',['/admin/user-up?id='.$user->id]).'</i>' ?>
                                <?php if(Yii::$app->user->identity->status > 3 && $user->status < 3)
                                    echo Html::a('<i class="fa fa-level-down">',['/admin/user-down?id='.$user->id]).'</i>' ?>
                            </td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
echo \sintret\chat\ChatRoom::widget([
        'url' => \yii\helpers\Url::to(['/admin/send-chat']),
        'userModel'=>  \app\models\User::className(),
    ]
);
?>


