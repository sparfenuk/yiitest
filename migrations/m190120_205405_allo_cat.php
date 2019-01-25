<?php

use yii\db\Migration;
//use DOMDocument;

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
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';


        //$this->dropIndex('idx-product-category','product');
        //$this->dropForeignKey('fk-product-category','product');



        $this->dropTable('{{%category}}');

        $this->createTable('{{%category}}',[
            'id' => $this->integer()->notNull().' PRIMARY KEY AUTO_INCREMENT',
            'name' => $this->string()->notNull(),
            'parent_id' => $this->integer()->notNull()->defaultValue(0)// табличка зсилається сама на себе
        ],$tableOptions);

        $this->createIndex('idx-product-category',
            '{{%product}}',
            'category_id');
        $this->addForeignKey('fk-product-category',
            '{{%product}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );
}

function firstLevel($doc)
{
    $xpath = new \DOMXPath($doc);
    $l1 = $xpath->query('//a[@class = "level-top"]');

    $i = 1;
    foreach ($l1 as $item) {
        $this->insert('{{%category}}',[
            'id' => $i,
           'name' => $item->nodeValue,
           'parent_id' => $i,
        ]);
//        Yii::$app->db->createCommand("insert into `Category`(`name`, `parent_id`) values (\"{$item->nodeValue}\",{$i})");
       
        $i++;
    }
   

}
    function secondLevel($doc,$parent_id,$query){

        $Lvl2 = new \DOMXPath($doc);

        $l2 = $Lvl2->query($query);

        foreach ($l2 as $item2){

//            $stmt = Yii::$app->db->createCommand("SELECT MAX(id) AS max_id FROM category");
//            $invNum = $stmt -> fetch(PDO::FETCH_ASSOC);
//            $maxId = $invNum['max_id'];
            $max = \app\models\Category::find()->orderBy('id DESC')->one();

            $maxId = $max->id;
            $maxId++;
            $this->insert('{{%category}}',[
                'id' => $maxId,
                'name' => $item2->nodeValue,
                'parent_id' => $parent_id,
            ]);
//            Yii::$app->db->createCommand("insert into `Category`(`id` , `name`, `parent_id`) values ($maxId ,\"{$item2->nodeValue}\",{$parent_id})");
            
            switch ($item2->nodeValue){
                case 'Смартфони':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 smartfonu_i_telefonu-smartfonu"]');
                    break;
                case 'Чохли для телефонів':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 smartfonu_i_telefonu-mobilnue_telefonu"]');
                    break;


                case 'Аксесуари':

                    $maxId < 60 ?
                        $this->thirdLevel($doc,$maxId,'//a[@class="level2 smartfonu_i_telefonu-aksessyaru_k_telefonam"]')
                        :
                        $this->thirdLevel($doc,$maxId,'//a[@class="level2 televizoru_i_foto-aksessyaru_k_tv"]');

                    break;

                case 'Power Bank':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 smartfonu_i_telefonu-universalnue_batarei"]');
                    break;
                case 'Телевізори':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 televizoru_i_foto-televizoru"]');
                    break;
                case 'Проекційне обладнання':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 televizoru_i_foto-proekcuonnoe_oborydovanie"]');
                    break;
                case 'Аудіосистеми':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 televizoru_i_foto-kinosistemu"]');
                    break;
                case 'Ігрова зона':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 televizoru_i_foto-igrovue_pristavki_i_igru"]');
                    break;
                case 'Фото і відеотехніка':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 televizoru_i_foto-fotoapparatu"]');
                    break;
                case 'Навушники по брендам':
                    $this-> thirdLevel($doc,$maxId,'//a[@class="level2 naushniki_i_akustika-naushniki"]');
                    break;
                case 'Портативна акустика':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 naushniki_i_akustika-akustika"]');
                    break;
                case 'Навушники Bluetooth':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 naushniki_i_akustika-naushniki_besprovodnye"]');
                    break;
                case 'Тип акустики':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 naushniki_i_akustika-tip_akustiki"]');
                    break;
                case 'Навушники дротяні':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 naushniki_i_akustika-provodnye_naychniki"]');
                    break;
                case 'Домашні аудіосистеми':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 naushniki_i_akustika-audiosistemy"]');
                    break;
                case 'Планшети':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 plansheti_notebooks_pk-plansheti"]');
                    break;
                case 'Аксесуари до планшетів':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 plansheti_notebooks_pk-accessorize_planshetu"]');
                    break;
                case 'Ноутбуки':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 plansheti_notebooks_pk-notebooks"]');
                    break;
                case 'Аксесуари для ноутбуків і ПК':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 plansheti_notebooks_pk-accessorize_pk"]');
                    break;
                case "Комп'ютери":
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 plansheti_notebooks_pk-computers"]');
                    break;
                case 'Мережеве обладнання':
                    $this->thirdLevel($doc,$maxId,'//a[@class="level2 plansheti_notebooks_pk-seti"]');
                    break;
//             case '':
//                thirdLevel($doc,$maxId,'//a[@class=""]');
//              break;
            }



            

        }

    }

    function thirdLevel($doc,$parent_id,$query){
        

        $Lvl3 = new \DOMXPath($doc);
        $l3 = $Lvl3->query($query);

        foreach ($l3 as $item3){
            if($item3->nodeValue != 'Всі товари →') {
                $this->insert('{{%category}}',[
                    'name' => $item3->nodeValue,
                    'parent_id' => $parent_id,
                ]);
//                Yii::$app->db->createCommand("insert into `Category`(`name`, `parent_id`) values (\"{$item3->nodeValue}\",{$parent_id})");
            }

        }
    }








    public function safeUp()
    {
        libxml_use_internal_errors(true);
        $doc = new \DOMDocument();
        $doc->loadHTML(mb_convert_encoding(file_get_contents('https://allo.ua/'), 'HTML-ENTITIES', 'UTF-8'));

        $this->firstLevel($doc);
        $this->secondLevel($doc,1,'//a[@class="level1 smartfonu_i_telefonu"]');
        $this->secondLevel($doc,2,'//a[@class="level1 televizoru_i_foto"]');
        $this->secondLevel($doc,3,'//a[@class="level1 naushniki_i_akustika"]');
        $this->secondLevel($doc,4,'//a[@class="level1 plansheti_notebooks_pk"]');

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
