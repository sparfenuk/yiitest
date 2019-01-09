<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m181227_175759_goods
 */
class m181227_175759_goods extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      /*$tableOptions=null;
      if($this->db->driverName==='mysql')
      {
          $tableOptions='CHARSET utf8 COLLATE utf8_unicode_ci';
      }
      $this->createTable('goods',[
          'id'=>Schema::TYPE_PK,
          'name'=>$this->string()->notNull(),
          'description'=>$this->string()->notNull(),
          'material_id'=>$this->integer()->notNull(),
          'is_water_proof'=>$this->boolean()->notNull(),
          'price'=>$this->integer()->notNull(),
          'brand_id'=>$this->integer()->notNull(),
          'dimensions'=>$this->string()->notNull(),
          'weight'=>$this->string()->notNull(),
          'screen_type_id'=>$this->integer()->notNull(),
          'screen_size'=>$this->string()->notNull(),
          'screen_resolution'=>$this->string()->notNull(),
          'main_camera'=>$this->string()->notNull(),
          'front_camera'=>$this->string()->notNull(),
          'autofocus'=>$this->boolean()->notNull(),
          'flash'=>$this->boolean()->notNull(),
          'cpu'=>$this->string()->notNull(),
          'cores'=>$this->smallInteger()->notNull(),
          'processor_frequency'=>$this->string()->notNull(),
          'ram'=>$this->smallInteger()->notNull(),
          'memory'=>$this->string()->notNull(),
          'memory_card_slot'=>$this->boolean()->notNull(),
          'max_memory_card_capacity'=>$this->smallInteger(),
          'platform_id'=>$this->integer()->notNull(),
          'os'=>$this->string()->notNull(),
          'connection_type'=>$this->string()->notNull(),
          'number_of_sim_cards'=>$this->integer()->notNull(),
          'sim_card_type_id'=>$this->integer()->notNull(),
          'wifi'=>$this->boolean()->notNull(),
          'bluetooth'=>$this->boolean()->notNull(),
          'headphone_out'=>$this->string()->notNull(),
          'battery_capacity'=>$this->string()->notNull(),
          'charging_port_id'=>$this->integer()->notNull(),
          'is_fast_charge'=>$this->boolean()->notNull()
      ],$tableOptions);

        $this->createTable('materials', [
            'id'=>Schema::TYPE_PK,
            'name'=>$this->string()->notNull()
        ],$tableOptions);

        $this->createTable('brands', [
            'id'=>Schema::TYPE_PK,
            'name'=>$this->string()->notNull()
        ],$tableOptions);

        $this->createTable('screen_types', [
            'id'=>Schema::TYPE_PK,
            'name'=>$this->string()->notNull()
        ],$tableOptions);

        $this->createTable('platforms', [
            'id'=>Schema::TYPE_PK,
            'name'=>$this->string()->notNull()
        ],$tableOptions);

        $this->createTable('sim_card_types', [
            'id'=>Schema::TYPE_PK,
            'name'=>$this->string()->notNull()
        ],$tableOptions);

        $this->createTable('charging_ports', [
            'id'=>Schema::TYPE_PK,
            'name'=>$this->string()->notNull()
        ],$tableOptions);
    */
    }

    /**ma
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181227_175759_goods cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181227_175759_goods cannot be reverted.\n";

        return false;
    }
    */
}
