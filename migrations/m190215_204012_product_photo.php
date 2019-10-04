<?php

use yii\db\Migration;

/**
 * Class m190215_204012_product_photo
 */
class m190215_204012_product_photo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        $this-> createTable('{{%product_photo}}',[
            'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
            'image_name' => $this->string(200)->notNull(),
            'product_id' => $this->integer()->notNull(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_photo}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190215_204012_product_photo cannot be reverted.\n";

        return false;
    }
    */
}
