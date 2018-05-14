<?php

use yii\db\Migration;

class m180511_112358_create_table_tmuser extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tmuser}}', [
            'tmuser_id' => $this->primaryKey(),
            'tmuser_name' => $this->string()->notNull(),
            'tmuser_first_name' => $this->string()->notNull(),
            'tmuser_login' => $this->string()->notNull(),
            'tmuser_password' => $this->string()->notNull(),
            'tmuser_role' => $this->integer()->notNull()->defaultValue('1'),
            'tmuser_type' => $this->integer()->notNull()->defaultValue('0'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%tmuser}}');
    }
}
