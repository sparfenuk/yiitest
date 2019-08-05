<?php

use yii\db\Migration;

/**
 * Class m190215_204100_order
 */
class m190215_204100_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        $this->createTable('{{%order}}',[ // ім'я order є зарезервованим словом MYSQL але воно працює
            'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull()->defaultValue(1),
            'color' => $this->string()->defaultValue(null),
            'status' => $this->string()->defaultValue('CREATED'), //created;payed;processed;send;arrived;finished;disputed;
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP').' ON UPDATE CURRENT_TIMESTAMP'
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');


        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190215_204100_order cannot be reverted.\n";

        return false;
    }
    */
}
