<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCandidateExperiencesTable extends Migration
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
            'candidate_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'company' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'start_date' => [
                'type' => 'DATE',
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey(
            'candidate_id',
            'candidates',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('candidate_experiences');
    }

    public function down()
    {
        $this->forge->dropTable('candidate_experiences');
    }
}
