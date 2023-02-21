<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateReservations extends Migration
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
            'reference_no' => [
                'type' => 'varchar',
                'constraint' => '255',
                'null' => false
            ],
            'accepted' => [
                'type' => 'tinyint',
                'constraint' => '1',
                'null' => false,
                'default' => '0'
            ],
            'fulfilled' => [
                'type' => 'tinyint',
                'constraint' => '1',
                'null' => false,
                'default' => '0'
            ],
            'boarded' => [
                'type' => 'tinyint',
                'constraint' => '1',
                'null' => false,
                'default' => '0'
            ],
            'refunded' => [
                'type' => 'tinyint',
                'constraint' => '1',
                'null' => false,
                'default' => '0'
            ],
            'cancelled' => [
                'type' => 'tinyint',
                'constraint' => '1',
                'null' => false,
                'default' => '0'
            ],
            'trip_schedule_id' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true
            ],
            'user_id' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true
            ],
            'origin' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true
            ],
            'destination' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true
            ],
            'type' => [
                'type' => 'enum',
                'constraint' => ['in', 'out'],
                'null' => false,
                'default' => 'in'
            ],
            'receipt_img' => [
                'type' => 'varchar',
                'constraint' => '255',
                'null' => false
            ],
            'payment' => [
                'type' => 'tinyint',
                'constraint' => '100',
                'null' => true
            ],
            'date_accepted' => [
                'type' => 'timestamp',
                'default' => null,
                'null' => true
            ],
            'date_boarded' => [
                'type' => 'timestamp',
                'default' => null,
                'null' => true
            ],
            'date_fulfilled' => [
                'type' => 'timestamp',
                'default' => null,
                'null' => true
            ],
            'date_cancelled' => [
                'type' => 'timestamp',
                'default' => null,
                'null' => true
            ],
            'date_refunded' => [
                'type' => 'timestamp',
                'default' => null,
                'null' => true
            ],
            'created_at' => [
                'type' => 'timestamp',
                'default' => new RawSql('current_timestamp'),
                'null' => false
            ],
            'updated_at' => [
                'type' => 'timestamp',
                'default' => null,
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('reference_no');
        $this->forge->addKey('accepted');
        $this->forge->addKey('fulfilled');
        $this->forge->addKey('boarded');
        $this->forge->addKey('refunded');
        $this->forge->addKey('cancelled');
        $this->forge->addForeignKey('trip_schedule_id', 'trip_schedules', 'id');
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('origin', 'locations', 'id');
        $this->forge->addForeignKey('destination', 'locations', 'id');
        $this->forge->createTable('reservations');
    }

    public function down()
    {
        $this->forge->dropTable('reservations');
    }
}
