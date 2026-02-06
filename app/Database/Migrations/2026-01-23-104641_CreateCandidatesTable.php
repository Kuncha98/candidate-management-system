<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCandidatesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'headline' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'summary' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'experience_years' => [
                'type' => 'INT',
                'null' => true,
            ],
            'status_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'default' => 1,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status_id', 'statuses', 'id');
        $this->forge->createTable('candidates');
    }

    public function down()
    {
        $this->forge->dropTable('candidates');
    }
}
