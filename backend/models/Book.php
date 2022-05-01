<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $isbn
 * @property string $title
 * @property string $author
 * @property int $location_id
 * @property int $created_at
 * @property int $updated_at
 * @property text $notes
 *
 * @property Bookshelf $location
 */
class Book extends \yii\db\ActiveRecord
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
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isbn', 'title', 'author', 'location_id'], 'required'],
            [['location_id'], 'integer'],
            [['isbn', 'title', 'author'], 'string', 'max' => 255],
            [['notes'], 'safe'],
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
            'isbn' => 'ISBN',
            'title' => 'Title',
            'author' => 'Author',
            'notes' => 'Notes',
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
