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


            $max = \app\models\Category::find()->orderBy('id DESC')->one();

            $maxId = $max->id;
            $maxId++;
            $this->insert('{{%category}}',[
                'id' => $maxId,
                'name' => $item2->nodeValue,
                'parent_id' => $parent_id,
            ]);


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
        //

        try {
            $Lvl3 = new \DOMXPath($doc);
            $l3Cat = $Lvl3->query($query);
            $l3Links = $Lvl3->query($query . '/@href');

            for ($i = 0; $i < $l3Cat->length; $i++) {
                if ($l3Cat->item($i)->nodeValue != 'Всі товари →') {
//                echo $l3Cat->item($i)->nodeValue . '  ' . $parent_id;
//                echo '<br>';
//                $db->query("insert into `Category`(`name`, `parent_id`) values (\"{$l3Cat->item($i)->nodeValue}\",{$parent_id})");
                    $this->insert('{{%category}}', [
                        'name' => $l3Cat->item($i)->nodeValue,
                        'parent_id' => $parent_id,
                    ]);


                    $catPage = new \DOMDocument();
                    $catPage->loadHTML(mb_convert_encoding(file_get_contents('https:' . $l3Links->item($i)->nodeValue), 'HTML-ENTITIES', 'UTF-8'));
                    $catPageXpath = new \DOMXPath($catPage);
                    $productLinks = $catPageXpath->query('//div[@class="item-picture-blk"]/a/@href');
                    $ch = \random_int(5, 20);

                    for ($j = 0; $j < $ch; $j++)
                        if ($productLinks->item($j)->nodeValue)
                            $this->parseProducts('https:' . $productLinks->item($j)->nodeValue);


                }
            }
        }
        catch (\Exception $e){ echo "third level exception:".$e->getMessage();}


    }

    function parseProducts($link){

        //  price = //p/span[@class="price"]/text()
        // discount = //td/div[contains(@class,'price')]/span[contains(@class,'price')]/span[@class="sum"]
        // description = //div[@class="attr-content"]
        // color = //h3[contains(text(),"Колір")]/span


        try {
            $prev_price = null;
            $productDoc = new \DOMDocument();
            $productDoc->loadHTML(mb_convert_encoding(file_get_contents($link), 'HTML-ENTITIES', 'UTF-8'));

            $productXpath = new \DOMXPath($productDoc);


            $q = $productXpath->query('//div[@class="title-additional"]/h1');

            $name = preg_replace('/ {2,}/', ' ', trim($q->item(0)->nodeValue));

            $brand = explode(' ', trim($name));


            $q = $productXpath->query('//p/span[@class="price"]/text()');
            $price = preg_replace('/ {2,}/', ' ', trim($q->item(0)->nodeValue));
            $price = htmlentities($price, null, 'utf-8');
            $price = str_replace("&nbsp;", '', $price);


            $q = $productXpath->query('//div[@class="buy-box-price"]/div[@class="old-price-box"]/span/span[@class="sum"]');
            if($q->item(0)) {
                $prev_price = preg_replace('/ {2,}/', ' ', trim($q->item(0)->nodeValue));
                $prev_price = htmlentities($prev_price, null, 'utf-8');
                $prev_price = str_replace("&nbsp;", '', $prev_price);
            }

            $q = $productXpath->query('//div[@class="attr-content"]');

            $description = preg_replace('/ {2,}/', ' ', trim($q->item(0)->nodeValue));


            $q = $productXpath->query('//div[@class="product-img-box"]//a/@href');


            $Id = \app\models\Category::find()->orderBy('id DESC')->one();
            $categoryId = $Id->id;


            if ($price == null || $description == null)
                return;

            $this->insert('{{%product}}', [
                'name' => $name,
                'brand' => $brand[0],
                'price' => $price,
                'prev_price' => $prev_price,
                'description' => $description,
                'colors' => array_pop($brand),
                'availability' => \random_int(1, 2000),
                'category_id' => $categoryId,
            ]);

            $Id = \app\models\Product::find()->orderBy('id DESC')->one();
            $productId = $Id->id;

            foreach ($q as $a) {
                $l = $a->nodeValue;
                $l = str_replace("#", "", $l);

                if (strpos($l, "youtube") == false && strpos($l, ".jpg") !== false) {
                    $imageName = \app\controllers\AppController::generateRandomString(\random_int(10, 20)) . '.jpg';

                    $file = file_get_contents($l);

                    file_put_contents(Yii::$app->params['webPath'] . "/images/product_images/" . $imageName, $file);

                    $this->insert("{{%product_photo}}", [
                        'image_name' => $imageName,
                        'product_id' => $productId
                    ]);
                }
            }
        }
        catch (\Exception $e){
            echo "product save exception: ".$e->getMessage().' '. $e->getLine();
        }




////div[@class="product-img-box"]//a/@href


    }




    public function up()
    {
        ini_set('memory_limit','2048M');
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
    public function down()
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
