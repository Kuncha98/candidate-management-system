<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Applied'],
            ['name' => 'Shortlisted'],
            ['name' => 'Interview'],
            ['name' => 'Selected'],
        ];

        $this->db->table('statuses')->insertBatch($data);
    }
}
