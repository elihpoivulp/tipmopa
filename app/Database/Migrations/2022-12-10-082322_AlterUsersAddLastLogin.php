<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AlterUsersAddLastLogin extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'last_login' => [
                'type' => 'datetime',
                'default' => new RawSql('current_timestamp')
            ]
        ]);
    }

    public function down()
    {
    }
}
