<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $material_id
 * @property int $is_water_proof
 * @property int $price
 * @property int $brand_id
 * @property string $dimensions
 * @property string $weight
 * @property int $screen_type_id
 * @property string $screen_size
 * @property string $screen_resolution
 * @property string $main_camera
 * @property string $front_camera
 * @property int $autofocus
 * @property int $flash
 * @property string $cpu
 * @property int $cores
 * @property string $processor_frequency
 * @property int $ram
 * @property string $memory
 * @property int $memory_card_slot
 * @property int $max_memory_card_capacity
 * @property int $platform_id
 * @property string $os
 * @property string $connection_type
 * @property int $number_of_sim_cards
 * @property int $sim_card_type_id
 * @property int $wifi
 * @property int $bluetooth
 * @property string $headphone_out
 * @property string $battery_capacity
 * @property int $charging_port_id
 * @property int $is_fast_charge
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'material_id', 'is_water_proof', 'price', 'brand_id', 'dimensions', 'weight', 'screen_type_id', 'screen_size', 'screen_resolution', 'main_camera', 'front_camera', 'autofocus', 'flash', 'cpu', 'cores', 'processor_frequency', 'ram', 'memory', 'memory_card_slot', 'platform_id', 'os', 'connection_type', 'number_of_sim_cards', 'sim_card_type_id', 'wifi', 'bluetooth', 'headphone_out', 'battery_capacity', 'charging_port_id', 'is_fast_charge'], 'required'],
            [['material_id', 'is_water_proof', 'price', 'brand_id', 'screen_type_id', 'autofocus', 'flash', 'cores', 'ram', 'memory_card_slot', 'max_memory_card_capacity', 'platform_id', 'number_of_sim_cards', 'sim_card_type_id', 'wifi', 'bluetooth', 'charging_port_id', 'is_fast_charge'], 'integer'],
            [['name', 'description', 'dimensions', 'weight', 'screen_size', 'screen_resolution', 'main_camera', 'front_camera', 'cpu', 'processor_frequency', 'memory', 'os', 'connection_type', 'headphone_out', 'battery_capacity'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'material_id' => 'Material ID',
            'is_water_proof' => 'Is Water Proof',
            'price' => 'Price',
            'brand_id' => 'Brand ID',
            'dimensions' => 'Dimensions',
            'weight' => 'Weight',
            'screen_type_id' => 'Screen Type ID',
            'screen_size' => 'Screen Size',
            'screen_resolution' => 'Screen Resolution',
            'main_camera' => 'Main Camera',
            'front_camera' => 'Front Camera',
            'autofocus' => 'Autofocus',
            'flash' => 'Flash',
            'cpu' => 'Cpu',
            'cores' => 'Cores',
            'processor_frequency' => 'Processor Frequency',
            'ram' => 'Ram',
            'memory' => 'Memory',
            'memory_card_slot' => 'Memory Card Slot',
            'max_memory_card_capacity' => 'Max Memory Card Capacity',
            'platform_id' => 'Platform ID',
            'os' => 'Os',
            'connection_type' => 'Connection Type',
            'number_of_sim_cards' => 'Number Of Sim Cards',
            'sim_card_type_id' => 'Sim Card Type ID',
            'wifi' => 'Wifi',
            'bluetooth' => 'Bluetooth',
            'headphone_out' => 'Headphone Out',
            'battery_capacity' => 'Battery Capacity',
            'charging_port_id' => 'Charging Port ID',
            'is_fast_charge' => 'Is Fast Charge',
        ];
    }
}
