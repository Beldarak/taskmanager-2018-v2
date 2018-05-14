<?php

use yii\db\Migration;

class m180511_112358_create_table_task extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%task}}', [
            'task_id' => $this->primaryKey(),
            'task_name' => $this->string()->notNull(),
            'task_description' => $this->string()->notNull(),
            'task_creator' => $this->integer()->notNull(),
            'task_parent' => $this->integer(),
            'task_limit' => $this->dateTime()->notNull(),
            'task_status' => $this->tinyInteger()->defaultValue('0'),
            'task_emergency' => $this->tinyInteger()->defaultValue('0'),
            'task_end' => $this->timestamp(),
            'task_priority' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('task_creator', '{{%task}}', 'task_creator');
        $this->createIndex('task_parent', '{{%task}}', 'task_parent');
        $this->addForeignKey('task_fk_creator', '{{%task}}', 'task_creator', '{{%tmuser}}', 'tmuser_id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('task_fk_task', '{{%task}}', 'task_parent', '{{%task}}', 'task_id', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%task}}');
    }
}
