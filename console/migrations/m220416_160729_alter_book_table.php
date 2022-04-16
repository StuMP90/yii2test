<?php

use yii\db\Migration;

/**
 * Class m220416_160729_alter_book_table
 */
class m220416_160729_alter_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        // change column `isbn` to string
        $this->alterColumn(
            '{{%book}}',
            'isbn',
            'string not null',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m220416_160729_alter_book_table cannot be reverted.\n";

        return false;
    }
}
