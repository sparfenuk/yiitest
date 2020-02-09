<?php

use yii\db\Migration;

/**
 * Class m200208_175911_end_date_auction_product
 */
class m200208_175911_end_date_auction_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        $this->addColumn('{{%product_auction}}', 'date_end',$this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200208_175911_end_date_auction_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200208_175911_end_date_auction_product cannot be reverted.\n";

        return false;
    }
    */
}
