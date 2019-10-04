<?php

use yii\db\Migration;

/**
 * Class m190216_185640_Warehouse
 */
class m170216_185640_warehouse extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        $this->createTable('{{%warehouse}}',[
            'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
            'SiteKey' => $this->integer()->notNull(),
            'Description' => $this->string(255),
            'Phone' => $this->integer(12),
            'TypeOfWarehouse' => $this->string(32),
            'Ref' => $this->string(32),
            'CityRef' => $this->string(32),
            'CityDescription' => $this->string(96),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%warehouse}}');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190216_185640_Warehouse cannot be reverted.\n";

        return false;
    }
    */
}
