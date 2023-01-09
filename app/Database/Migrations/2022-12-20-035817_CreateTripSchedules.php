<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTripSchedules extends Migration
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
            'boat_id' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true,
            ],
            'schedule_id' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true,
            ],
            'start_location_id' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true,
            ],
            'departed_1' => [
                'type' => 'tinyint',
                'constraint' => '1',
                'null' => true,
                'default' => 0
            ],
            'departed_2' => [
                'type' => 'tinyint',
                'constraint' => '1',
                'null' => true,
                'default' => 0
            ],
            'schedule_date' => [
                'type' => 'date',
                'null' => false,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('boat_id', 'boats', 'id');
        $this->forge->addForeignKey('schedule_id', 'schedules', 'id');
        $this->forge->addForeignKey('start_location_id', 'locations', 'id');
        $this->forge->createTable('trip_schedules');
    }

    public function down()
    {
        $this->forge->dropTable('trip_schedules');
    }
}
