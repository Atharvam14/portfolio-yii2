<?php

use yii\db\Migration;

class m260404_121342_add_status_to_project_table extends Migration
{
    public function safeUp()
    {
        $table = $this->db->schema->getTableSchema('project', true);
        if ($table !== null && !isset($table->columns['status'])) {
            $this->addColumn('project', 'status', $this->string()->defaultValue('pending'));
        }
    }

    public function safeDown()
    {
        $table = $this->db->schema->getTableSchema('project', true);
        if ($table !== null && isset($table->columns['status'])) {
            $this->dropColumn('project', 'status');
        }
    }
}
