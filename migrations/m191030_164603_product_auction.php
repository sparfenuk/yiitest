<?php

use yii\db\Migration;

/**
 * Class m191030_164603_product_auction
 */
class m191030_164603_product_auction extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        $this->createTable('{{%product_auction}}',[
            'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
            'name' => $this->string(100)->notNull(),
            'category_id' => $this->integer()->notNull(),
            'start_price' => $this->money()->notNull(),
            'current_price' => $this->money()->notNull()->defaultValue(0),
            'end_price' => $this->money()->notNull()->defaultValue(0),
            'max_price' => $this->money()->defaultValue(0),
            'description' => $this->string(1000)->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'time' => $this->time(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP').' ON UPDATE CURRENT_TIMESTAMP'
        ],
            $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191030_164603_product_auction cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191030_164603_product_auction cannot be reverted.\n";

        return false;
    }
    */
}
