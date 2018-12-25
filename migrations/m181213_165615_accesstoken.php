<?php

use yii\db\Migration;

/**
 * Class m181213_165615_accesstoken
 */
class m181213_165615_accesstoken extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'AccessToken', 'string');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'AccessToken');
        echo "m181213_165615_accesstoken cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181213_165615_accesstoken cannot be reverted.\n";

        return false;
    }
    */
}
