<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateUsers extends Migration
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
                'null' => false
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => '70',
                'null' => false
            ],
            'address' => [
                'type' => 'varchar',
                'constraint' => '250',
                'null' => false
            ],
            'gender' => [
                'type' => 'enum',
                'constraint' => ['M', 'F'],
                'default' => 'M',
                'null' => false
            ],
            'weight' => [
                'type' => 'float',
                'constraint' => new RawSql('9,2'),
                'default' => new RawSql('0.0'),
                'null' => false
            ],
            'height' => [
                'type' => 'float',
                'constraint' => new RawSql('9,2'),
                'default' => new RawSql('0.0'),
                'null' => false
            ],
            'age' => [
                'type' => 'tinyint',
                'constraint' => '3',
                'default' => '0',
                'null' => false
            ],
            'contact_number' => [
                'type' => 'varchar',
                'constraint' => '13',
                'null' => false
            ],
            'gcash_account_number' => [
                'type' => 'varchar',
                'constraint' => '13',
                'null' => true
            ],
            'gcash_account_name' => [
                'type' => 'varchar',
                'constraint' => '13',
                'null' => true
            ],
            'emergency_contact_person' => [
                'type' => 'varchar',
                'constraint' => '70',
                'null' => false
            ],
            'emergency_contact_person_contact_number' => [
                'type' => 'varchar',
                'constraint' => '13',
                'null' => false
            ],
            'password' => [
                'type' => 'varchar',
                'constraint' => '255',
                'null' => false
            ],
            'role' => [
                'type' => 'enum',
                'constraint' => ['1', '2', '3'],
                'default' => '3',
                'null' => false
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
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
