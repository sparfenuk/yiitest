<?php

use yii\db\Migration;

/**
 * Class m190216_180713_np_test
 */
class m270216_180713_np_test extends Migration
{

    private $request;
    private $requestURL = 'https://api.novaposhta.ua/v2.0/json/';
    private $api = "be646b318ee08fda8c48ab0679d396b9";


    private function SetSitites()
    {

        for ($i = 1; $i < 184; $i++) {
            $this->request = '{
                            "apiKey": "' . $this->api . '",
                            "modelName": "AddressGeneral",
                            "calledMethod": "getSettlements",
                            "methodProperties": {
                            "Page": "' . $i . '"
                            }
                        }';

            $curl = \curl_init();
            \curl_setopt_array($curl, array(
                CURLOPT_URL => $this->requestURL,
                CURLOPT_RETURNTRANSFER => True,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $this->request,
                CURLOPT_HTTPHEADER => array("content-type: application/json",),
            ));


            $rets = json_decode(curl_exec($curl));



            foreach ($rets->data as $ret) {
//            $city = new \app\models\NP\City();

//            $city->Ref = $ret->Ref;
//            $city->Latitude = $ret->Latitude;
//            $city->Longitude = $ret->Longitude;
//            $city->Description = $ret->Description;
//            $city->SettlementTypeDescription = $ret->SettlementTypeDescription;
//            $city->Region = $ret->Region;
//            $city->RegionsDescription = $ret->RegionsDescription;
//            $city->Area = $ret->Area;
//            $city->AreaDescription = $ret->AreaDescription;
//            $city->Index = $ret->Index;
                //            $city->save();

//                $this->insert('{{%city}}', [
//                    'Ref' => $ret['Ref'],
//                    'Latitude' => $ret['Latitude'],
//                    'Longitude' => $ret['Longitude'],
//                    'Description' => $ret['Description'],
//                    'SettlementTypeDescription' => $ret['SettlementTypeDescription'],
//                    'Region' => $ret['Region'],
//                    'RegionsDescription' => $ret['RegionsDescription'],
//                    'Area' => $ret['Area'],
//                    'AreaDescription' => $ret['AreaDescription'],
//                    'Index' => $ret['Index'],
//                ]);

                $this->insert('{{%city}}', [
                    'Ref' => $ret->Ref,
                    'Latitude' => $ret->Latitude,
                    'Longitude' => $ret->Longitude,
                    'Description' => $ret->Description,
                    'SettlementTypeDescription' => $ret->SettlementTypeDescription,
                    'Region' => $ret->Region,
                    'RegionsDescription' => $ret->RegionsDescription,
                    'Area' => $ret->Area,
                    'AreaDescription' => $ret->AreaDescription,
                    'Index' => $ret->Index1,
                ]);


            }


            \curl_close($curl);
        }


        /*
         * [116] => stdClass Object
        (
            [Ref] => 0dd80058-4b3a-11e4-ab6d-005056801329
            [SettlementType] => 563ced13-f210-11e3-8c4a-0050568002cf
            [Latitude] => 49.807894000000000
            [Longitude] => 23.393657000000000
            [Description] => Бортятин
            [DescriptionRu] => Бортятин
            [SettlementTypeDescription] => село
            [SettlementTypeDescriptionRu] => село
            [Region] => e4ad17ab-4b33-11e4-ab6d-005056801329
            [RegionsDescription] => Мостиський р-н
            [RegionsDescriptionRu] => Мостиский р-н
            [Area] => dcaadd3a-4b33-11e4-ab6d-005056801329
            [AreaDescription] => Львівська область
            [AreaDescriptionRu] => Львовская область
            [Index1] => 81343
            [Index2] => 81343
            [IndexCOATSU1] => 4622482402
            [Delivery1] =>
            [Delivery2] =>
            [Delivery3] =>
            [Delivery4] =>
            [Delivery5] =>
            [Delivery6] =>
            [Delivery7] =>
            [SpecialCashCheck] => 1
            [Warehouse] => 0
        )
         */
        //curl_close($curl);
    }


    private function SetWarehouses()
    {
        $this->request =
'{
    "modelName": "AddressGeneral",
    "calledMethod": "getWarehouses",
    "methodProperties": {
         "Language": "ua"
    },
    "apiKey": "' . $this->api . '"
}';

        $curl = \curl_init();
        \curl_setopt_array($curl, array(
            CURLOPT_URL => $this->requestURL,
            CURLOPT_RETURNTRANSFER => True,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $this->request,
            CURLOPT_HTTPHEADER => array("content-type: application/json",),
        ));


        $rets = \json_decode(\curl_exec($curl));

//            \app\controllers\AppController::debug($rets);


        foreach ($rets->data as $ret) {
            $this->insert('{{%warehouse}}',[
                'SiteKey' => $ret->SiteKey ,
                'Description' => $ret->Description ,
                'Phone' => $ret->Phone ,
                'TypeOfWarehouse' => $ret->TypeOfWarehouse ,
                'Ref' => $ret->Ref ,
                'CityRef' => $ret->CityRef ,
                'CityDescription' => $ret->CityDescription
            ]);


        }
    }



/**
 * {@inheritdoc}
 */
public
function Up()
{
    //$this->SetSitites();
    $this->SetWarehouses();
    }

/**
 * {@inheritdoc}
 */
public
function safeDown()
{
    $this->delete('{{%city}}', '1');
    return true;
}

/*
// Use up()/down() to run migration code without a transaction.
public function up()
{

}

public function down()
{
    echo "m190216_180713_np_test cannot be reverted.\n";

    return false;
}
*/
}
