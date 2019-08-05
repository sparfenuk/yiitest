<?php

use yii\db\Migration;

/**
 * Class m190215_203924_review
 */
class m190215_203924_review extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        $this->createTable('{{%review}}',[
            'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'mark' => $this->integer()->notNull()->defaultValue(0),
            'description' => $this->string(1000),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ],
            $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%review}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190215_203924_review cannot be reverted.\n";

        return false;
    }
    */
}
