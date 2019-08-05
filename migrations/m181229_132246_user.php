<?php
use yii\db\Migration;
/**
 * Class m181229_132246_user
 */
class m181229_132246_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
            $this->createTable('{{%user}}', [
                'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
                'username' => $this->string(32)->notNull()->unique(),
                'password' => $this->string()->notNull(),
                'photo_name' => $this->string(),
                'mobile_number' => $this->integer(),
                'location' => $this->string(),
                'email' => $this->string(255)->notNull()->unique(),
                'status' => $this->smallInteger()->notNull()->defaultValue(0),//0 - unconfirmed email, 1 - confirmed email, 2-admin
                'auth_key' => $this->string()->notNull()->unique(), //created for confirming email and changing password via email
                'bought_items_count' => $this->integer()->defaultValue(0),
                'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP').' ON UPDATE CURRENT_TIMESTAMP'
            ],
                $tableOptions);



//            $this->createTable('{{%address}}',[
//                'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
//                'user_id' => $this->integer()->notNull(),
//
//            ],$tableOptions);



    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
        return true;

    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
    }
    public function down()
    {
        echo "m181229_132246_user cannot be reverted.\n";
        return false;
    }
    */
}
