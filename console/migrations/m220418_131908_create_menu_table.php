<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menu}}`.
 */
class m220418_131908_create_menu_table extends Migration
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
        
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'order' => $this->integer()->notNull(),
            'label' => $this->string(128)->notNull(),
            'url' => $this->string(128)->notNull(),
            'permission' => $this->string(128),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%menu}}');
    }
}
