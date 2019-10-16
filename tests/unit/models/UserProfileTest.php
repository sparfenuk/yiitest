<?php

namespace app\tests\unit\models;

use yii\Codeception\DbTestCase;
use app\tests\unit\fixtures\UserFixture;

class UserProfileTest extends DbTestCase
{
    public function load()
    {
        return [
            'users' => UserFixture::className(),
        ];
    }

//
}