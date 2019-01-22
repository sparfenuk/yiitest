<?php

use yii\db\Migration;

/**
 * Class m190120_205405_allo_cat
 */
class m190120_205405_allo_cat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public static function debug($arr){
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }



    function reCreateTables()
    {
        Yii::$app->db->createCommand("DROP TABLE IF EXISTS `category`")->execute();
        Yii::$app->db->createCommand("CREATE TABLE `category` ( 
                    `id` INT NOT NULL AUTO_INCREMENT , 
                    `name` VARCHAR(100) NOT NULL ,
                    `parent_id` INT NOT NULL,
                     PRIMARY KEY (`id`), 
                     UNIQUE `UNIQ` (`Name`)) 
                     ENGINE = MyISAM;
      )"
    )->execute();
}

function firstLevel($doc)
{
    $xpath = new DOMXPath($doc);
    $l1 = $xpath->query('//ul[@id="nav"]/li/div/a/span');
    self::debug($l1);
    foreach ($l1 as $item) {
       Yii::$app->db->createCommand("insert into `Category`(`Name`) values ('{$item->nodeValue}')")->execute();
        echo $item->nodeValue;
        echo '<br>';
    }
    echo '<hr>';

}
function secondLevel($doc){
    $Lvl2 = new DOMXPath($doc);
    $l2 = $Lvl2->query('//p[@class="level1"]/a');

    foreach ($l2 as $item2){
        print_r($item2->nodeValue);
        echo '<br>';
       Yii::$app->db->createCommand("insert into `Category`(`Name`) values ('{$item2->nodeValue}')")->execute();
    }
    echo '<hr>';


}

function thirdLevel($doc){
    //

    $Lvl3 = new DOMXPath($doc);
    $l3 = $Lvl3->query('//td/ul/li/a');

    foreach ($l3 as $item3){
        if($item3->nodeValue !="Всі товари →" ) {
            print_r($item3->nodeValue);
            echo '<br>';
           Yii::$app->db->createCommand("insert into `Category`(`Name`) values ('{$item3->nodeValue}')")->execute();
        }

    }
    echo '<hr>';
}








    public function safeUp()
    {

        $doc = new DOMDocument();
        $doc->loadHTML(mb_convert_encoding(file_get_contents('https://allo.ua/'), 'HTML-ENTITIES', 'UTF-8'));

        $this->firstLevel($doc);
//        $this->secondLevel($doc);
//        $this->thirdLevel($doc);

    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190120_205405_allo_cat cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190120_205405_allo_cat cannot be reverted.\n";

        return false;
    }
    */
}
