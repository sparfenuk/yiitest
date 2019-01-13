<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $is_admin
 * @property string $photo_name
 * @property int $mobile_number
 * @property string $location
 * @property string $email
 * @property int $status
 * @property int $bought_items_count
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Favourites[] $favourites
 */
class SignupForm extends \yii\db\ActiveRecord
{
    public $username;
    public $password;
    public $password_confirm;
    public $email;
    public $mobile_number;
    /**
     * @var uploadedAvatar
     */
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'username', 'password', 'email'], 'required'],
            [['id', 'is_admin', 'mobile_number', 'status', 'bought_items_count'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username'], 'string', 'max' => 32],
            [['password', 'photo_name', 'location', 'email'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['photo_name'], 'unique'],
            [['mobile_number'], 'unique'],
            [['id'], 'unique'],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'is_admin' => 'Is Admin',
            'photo_name' => 'Photo Name',
            'mobile_number' => 'Mobile Number',
            'location' => 'Location',
            'email' => 'Email',
            'status' => 'Status',
            'bought_items_count' => 'Bought Items Count',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavourites()
    {
        return $this->hasMany(Favourites::className(), ['user_id' => 'id']);
    }



    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
