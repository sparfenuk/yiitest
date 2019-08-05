<?php

use yii\db\Migration;

/**
 * Class m190219_151302_pb_curs
 */
class m170219_151302_pb_curs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%curs}}',[
            'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
            'valute' => $this->string(4),
            'base' => $this->string(4),
            'buy' => $this->float(),
            'sale' => $this->float()
        ]);
        $cursStr = \json_decode(file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5'));
        //\app\controllers\AppController::debug($cursStr);
        foreach ($cursStr as $curs){
            $this->insert('{{%curs}}',[
                'valute' => $curs->ccy,
                'base' => $curs->base_ccy,
                'buy' => $curs->buy,
                'sale' => $curs->sale
            ]);
        }


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('{{%curs}}');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190219_151302_pb_curs cannot be reverted.\n";

        return false;
    }
    */
}
