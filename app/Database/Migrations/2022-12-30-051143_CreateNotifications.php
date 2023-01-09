<?php

namespace App\Database\Migrations;

use App\Models\Notification;
use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateNotifications extends Migration
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
            'receiver_id' => [
                'type' => 'int',
                'constraint' => '11',
                'unsigned' => true
            ],
            'reference_no' => [
                'type' => 'varchar',
                'constraint' => '255',
                'null' => false
            ],
            'message' => [
                'type' => 'text',
                'null' => false
            ],
            'category' => [
                'type' => 'enum',
                'constraint' => config(Notification::class)->categories,
                'default' => 'reservation-new',
                'null' => false
            ],
            'seen' => [
                'type' => 'tinyint',
                'constraint' => '1',
                'default' => '0',
                'null' => false
            ],
            'date_seen' => [
                'type' => 'timestamp',
                'default' => null,
                'null' => true
            ],
            'created_at' => [
                'type' => 'timestamp',
                'default' => new RawSql('current_timestamp'),
                'null' => false
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('category');
        $this->forge->addKey('reference_no');
        $this->forge->addForeignKey('receiver_id', 'users', 'id');
        $this->forge->createTable('notifications');
    }

    public function down()
    {
        $this->forge->dropTable('notifications');
    }
}
