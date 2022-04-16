<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m220416_120122_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'isbn' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'author' => $this->string()->notNull(),
            'location_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        
        // creates index for column `isbn`
        $this->createIndex(
            'idx-isbn',
            '{{%book}}',
            'isbn'
        );
        
        // creates index for column `author`
        $this->createIndex(
            'idx-author',
            '{{%book}}',
            'author'
        );
        
        // creates index for column `title`
        $this->createIndex(
            'idx-title',
            '{{%book}}',
            'title'
        );
        
        // creates index for column `location_id`
        $this->createIndex(
            'idx-location_id',
            '{{%book}}',
            'location_id'
        );
        
        // creates index for column `location_id` against the location table
        $this->addForeignKey(
            'key-location',
            '{{%book}}',
            'location_id',
            '{{%bookshelf}}',
            'id',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%book}}');
    }
}
