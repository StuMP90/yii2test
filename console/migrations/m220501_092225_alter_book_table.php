<?php

use yii\db\Migration;

/**
 * Class m220501_092225_alter_book_table
 */
class m220501_092225_alter_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->addColumn('{{%book}}', 'notes', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m220501_092225_alter_book_table cannot be reverted.\n";

        return false;
    }
}
