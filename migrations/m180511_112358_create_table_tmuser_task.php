<?php

use yii\db\Migration;

class m180511_112358_create_table_tmuser_task extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tmuser_task}}', [
            'tmuser_task_task' => $this->integer()->notNull(),
            'tmuser_task_tmuser' => $this->integer()->notNull(),
            'tmuser_task_order' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('PRIMARYKEY', '{{%tmuser_task}}', ['tmuser_task_task', 'tmuser_task_tmuser']);
        $this->createIndex('tmuser_task_tmuser', '{{%tmuser_task}}', 'tmuser_task_tmuser');
        $this->createIndex('tmuser_task_task', '{{%tmuser_task}}', 'tmuser_task_task');
        $this->addForeignKey('tmuser_task_fk_tmuser', '{{%tmuser_task}}', 'tmuser_task_task', '{{%task}}', 'task_id', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('tmuser_task_fk_task', '{{%tmuser_task}}', 'tmuser_task_tmuser', '{{%tmuser}}', 'tmuser_id', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%tmuser_task}}');
    }
}
