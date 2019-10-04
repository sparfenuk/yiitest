<?php

use yii\db\Migration;

/**
 * Class m190216_172135_city
 */
class m170216_172135_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        $this->createTable('{{%city}}',[
            'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
            'Ref' => $this->string(48)->notNull(),
            'Latitude' => $this->double()->notNull(),
            'Longitude' => $this->double()->notNull(),
            'Description' => $this->string(96),
            'SettlementTypeDescription' =>$this->string(16),
            'Region' => $this->string(48),
            'RegionsDescription' => $this->string(32),
            'Area' => $this->string(48),
            'AreaDescription' => $this->string(32),
            'Index' => $this->integer()
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('{{%city}}');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190216_172135_city cannot be reverted.\n";

        return false;
    }
    */
}
