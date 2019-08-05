<?php

namespace app\models\PB;

use Yii;

/**
 * This is the model class for table "curs".
 *
 * @property int $id
 * @property string $valute
 * @property string $base
 * @property double $buy
 * @property double $sale
 */
class Curs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['buy', 'sale'], 'number'],
            [['valute', 'base'], 'string', 'max' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valute' => 'Valute',
            'base' => 'Base',
            'buy' => 'Buy',
            'sale' => 'Sale',
        ];
    }
}
