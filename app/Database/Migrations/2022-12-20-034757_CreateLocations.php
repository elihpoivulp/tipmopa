<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateLocations extends Migration
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
            'name' => [
                'type' => 'varchar',
                'constraint' => '70',
                'null' => false,
                'unique' => true
            ],
            'is_terminal' => [
                'type' => 'tinyint',
                'constraint' => '1',
                'null' => false,
                'default' => '1'
            ],
            'fare_price_in_peso' => [
                'type' => 'tinyint',
                'constraint' => '100',
                'null' => true
            ],
            'fare_discount_in_peso' => [
                'type' => 'tinyint',
                'constraint' => '100',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('is_terminal');
        $this->forge->createTable('locations');
    }

    public function down()
    {
        $this->forge->dropTable('locations');
    }
}
