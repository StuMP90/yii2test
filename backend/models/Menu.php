<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int $order
 * @property string $label
 * @property string $url
 * @property string|null $permission
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order', 'label', 'url'], 'required'],
            [['order'], 'integer'],
            [['label', 'url', 'permission'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order' => 'Order',
            'label' => 'Label',
            'url' => 'Url',
            'permission' => 'Permission',
        ];
    }
}
