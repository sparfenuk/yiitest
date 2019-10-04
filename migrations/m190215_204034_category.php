<?php

use yii\db\Migration;

/**
 * Class m190215_204034_category
 */
class m190215_204034_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        $this->createTable('{{%category}}',[
            'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
            'name' => $this->string()->notNull(),
            'parent_id' => $this->integer()->notNull()->defaultValue(0)// табличка зсилається сама на себе
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190215_204034_category cannot be reverted.\n";

        return false;
    }
    */
}
