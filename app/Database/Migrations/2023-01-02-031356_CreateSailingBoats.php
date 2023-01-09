<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateSailingBoats extends Migration
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
            'trip_schedule_id' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true
            ],
            'location_points_arrival_sequence' => [
                'type' => 'varchar',
                'constraint' => '10',
                'null' => true,
                'default' => null
            ],
            'depart_type' => [
                'type' => 'enum',
                'constraint' => ['1', '2'],
                'default' => 1
            ],
            'date_departed' => [
                'type' => 'timestamp',
                'default' => new RawSql('current_timestamp'),
                'null' => false
            ],
            'point_a_date_arrived' => [
                'type' => 'timestamp',
                'default' => null,
                'null' => true
            ],
            'point_b_date_arrived' => [
                'type' => 'timestamp',
                'default' => null,
                'null' => true
            ],
            'point_c_date_arrived' => [
                'type' => 'timestamp',
                'default' => null,
                'null' => true
            ],
            'last_point_date_arrived' => [
                'type' => 'timestamp',
                'default' => null,
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('trip_schedule_id', 'trip_schedules', 'id');
        $this->forge->createTable('sailing_boats');
    }

    public function down()
    {
        $this->forge->dropTable('sailing_boats');
    }
}
