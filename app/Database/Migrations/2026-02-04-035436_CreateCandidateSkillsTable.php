<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCandidateSkillsTable extends Migration
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
            'skill_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'level' => [
                'type' => 'ENUM',
                'constraint' => ['beginner', 'intermediate', 'advanced'],
                'default' => 'intermediate',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('candidate_id', 'candidates', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('skill_id', 'skills', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('candidate_skills');
    }

    public function down()
    {
        $this->forge->dropTable('candidate_skills');
    }
}
