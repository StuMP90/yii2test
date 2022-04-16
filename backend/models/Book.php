<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property int $isbn
 * @property string $title
 * @property string $author
 * @property int $location_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Bookshelf $location
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isbn', 'title', 'author', 'location_id', 'created_at', 'updated_at'], 'required'],
            [['isbn', 'location_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'author'], 'string', 'max' => 255],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bookshelf::className(), 'targetAttribute' => ['location_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'isbn' => 'Isbn',
            'title' => 'Title',
            'author' => 'Author',
            'location_id' => 'Location ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Bookshelf::className(), ['id' => 'location_id']);
    }
}
