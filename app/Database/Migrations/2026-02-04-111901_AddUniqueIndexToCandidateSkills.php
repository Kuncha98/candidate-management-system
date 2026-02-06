<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUniqueIndexToCandidateSkills extends Migration
{
    public function up()
    {
        $this->forge->addUniqueKey(['candidate_id', 'skill_id'], 'candidate_skill_unique');
    }

    public function down()
    {
        $this->forge->dropKey('candidate_skills', 'candidate_skill_unique');
    }

}
