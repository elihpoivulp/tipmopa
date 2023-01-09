<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSchedules extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'itt_start' => [
                'type' => 'time',
                'null' => false
            ],
            'itt_end' => [
                'type' => 'time',
                'null' => false
            ],
            'tti_start' => [
                'type' => 'time',
                'null' => false
            ],
            'tti_end' => [
                'type' => 'time',
                'null' => false
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('schedules');
    }

    public function down()
    {
        $this->forge->dropTable('schedules');
    }
}
