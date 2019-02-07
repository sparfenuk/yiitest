<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $photo_name
 * @property int $mobile_number
 * @property string $location
 * @property string $email
 * @property int $status
 * @property int $bought_items_count
 * @property string $created_at
 * @property string $updated_at
 *  @property string $auth_key
 * @property Favourites[] $favourites
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $password2;


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
            [['username', 'email'], 'required'],
            [['id', 'mobile_number', 'status', 'bought_items_count'], 'integer'],
            [['created_at', 'updated_at', 'auth_key'], 'safe'],
            [['username'], 'string', 'max' => 32],
            [['password', 'photo_name', 'location', 'email'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['id'], 'unique'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
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
            'photo_name' => 'Photo Name',
            'mobile_number' => 'Mobile Number',
            'location' => 'Location',
            'email' => 'Email',
            'status' => 'Status',
            'auth_key' => 'Auth Key',
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

    public function getAvatarImage(){
        return '\images\user_images\\'.$this->photo_name;
    }

    public static function findIdentity($id)
    {

        $user = self::find()
            ->where([

                "id" => $id

            ])
            ->one();


        return ($user);

    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = self::find()->where(['AccessToken' => $token])->one();
        return $user;
    }


    public static function findByAuthKey($authKey)
    {
        $user = self::find()->where(['auth_key' => $authKey])->one();
        return $user;

    }

    public function validatePassword($password)
    {

        return $this->password === md5($password . Yii::$app->params['SALT']);

    }



    /**
     * Finds user by username
     *
     * @param  string $username
     * @return static|null
     */

    public static function findByUsername($username)
    {

        $user = self::find()
            ->where([

                "username" => $username

            ])
            ->one();


        return  ($user);

    }


    /**
     * @inheritdoc
     */

    public function getId()
    {

        return $this->id;

    }


    /**
     * @inheritdoc
     */

    public function getUserName()
    {
        return $this->username;
    }

    public function getAuthKey()
    {

        return $this->authKey;

    }


    /**
     * @inheritdoc
     */

    public function validateAuthKey($authKey)
    {

        return $this->authKey === $authKey;

    }


}
