<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateBoats extends Migration
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
            'boat_name' => [
                'type' => 'varchar',
                'constraint' => '70',
                'null' => false,
                'unique' => true
            ],
            'boat_img' => [
                'type' => 'varchar',
                'constraint' => '255',
                'null' => false
            ],
            'passenger_capacity' => [
                'type' => 'tinyint',
                'constraint' => '127',
                'default' => '10',
                'null' => false
            ],
            'weight_capacity' => [
                'type' => 'float',
                'constraint' => new RawSql('9,2'),
                'null' => false
            ],
            'license' => [
                'type' => 'varchar',
                'constraint' => '70',
                'null' => false,
                'unique' => true
            ],
            'operator_id' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true
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
        $this->forge->addForeignKey('operator_id', 'users', 'id', '', 'cascade');
        $this->forge->addUniqueKey(['boat_name', 'license']);
        $this->forge->createTable('boats');
    }

    public function down()
    {
        $this->forge->dropTable('boats');
    }
}
