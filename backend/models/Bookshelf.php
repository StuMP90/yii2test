<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "bookshelf".
 *
 * @property int $id
 * @property string $location
 * @property string $slug
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Book[] $books
 */
class Bookshelf extends \yii\db\ActiveRecord
{
    /**
     * Auto set timestamps
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bookshelf';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location', 'slug'], 'required'],
            [['location', 'slug'], 'string', 'max' => 255],
            [['location'], 'unique'],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location' => 'Location',
            'slug' => 'Slug',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['location_id' => 'id']);
    }
}
