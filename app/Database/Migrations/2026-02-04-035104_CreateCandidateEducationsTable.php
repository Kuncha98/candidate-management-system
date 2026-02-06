<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCandidateEducationsTable extends Migration
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
            'institution' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'degree' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'field_of_study' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'start_year' => [
                'type' => 'YEAR',
            ],
            'end_year' => [
                'type' => 'YEAR',
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

        $this->forge->createTable('candidate_educations');
    }

    public function down()
    {
        $this->forge->dropTable('candidate_educations');
    }
}
