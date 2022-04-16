<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bookshelf}}`.
 */
class m220416_115324_create_bookshelf_table extends Migration
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
        
        $this->createTable('{{%bookshelf}}', [
            'id' => $this->primaryKey(),
            'location' => $this->string()->notNull()->unique(),
            'slug' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%bookshelf}}');
    }
}
