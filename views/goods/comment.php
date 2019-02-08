<?php
use yii\widgets\LinkPager;
echo '<div class="col-md-6">
    <div class="product-reviews">

        ';

//echo var_dump($reviewDataProvider);

foreach ($reviewDataProvider->models as $review) {

    $user = $review->getUser();
    //  echo var_dump($user);
    echo '<div class="single-review">
            <div class="review-heading">
                <div><a href="#"><i class="fa fa-user-o"></i>' . $user->username . '</a></div>
                <div><a href="#"><i class="fa fa-clock-o"></i>' . $review->created_at . '</a></div>
                <div class="review-rating pull-right">
                    ';


    for ($i = 0; $i < 5; $i++) {
        if ($i < $review->mark)
            echo '<i class="fa fa-star"></i>';
        else
            echo '<i class="fa fa-star-o empty"></i>';
    }


    echo '


                </div>
            </div>
            <div class="review-body">
                <p>' . $review->description . '</p>
            </div>
        </div>';

}


echo ' ' . LinkPager::widget(['pagination' => $reviewDataProvider->pagination]) . '
    </div>
</div>';
?>