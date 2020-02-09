<?php

use yii\db\Migration;

/**
 * Class m191205_152054_auction_bit
 */
class m191205_152054_auction_bit extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        $this-> createTable('{{%auction_bit}}',[
            'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'amount' => $this->integer()->notNull()
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%auction_bit}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191205_152054_auction_bit cannot be reverted.\n";

        return false;
    }
    */
}
