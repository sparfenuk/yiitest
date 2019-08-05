<?php

use yii\db\Migration;

/**
 * Class m190215_204048_cart
 */
class m190215_204048_cart extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        $this->createTable('{{%cart}}',[
            'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'color' => $this->string(),
            'quantity' => $this->integer()->defaultValue(0)
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cart}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190215_204048_cart cannot be reverted.\n";

        return false;
    }
    */
}
