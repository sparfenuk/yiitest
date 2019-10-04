<?php

use yii\db\Migration;

/**
 * Class m190215_203939_favourites
 */
class m190215_203939_favourites extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        $this->createTable('{{%favourites}}',[ // якщо запис існує то продукт є улюбленим
            'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull()
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%favourites}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190215_203939_favourites cannot be reverted.\n";

        return false;
    }
    */
}
