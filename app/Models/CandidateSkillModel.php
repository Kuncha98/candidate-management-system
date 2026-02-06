<?php

namespace App\Models;

use CodeIgniter\Model;

class CandidateSkillModel extends Model
{
    protected $table = 'candidate_skills';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'candidate_id',
        'skill_id',
        'level'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    // Fetch skills using candidate ID
    public function forCandidate(int $candidateId)
    {
        return $this->select('candidate_skills.*, skills.name as skill_name')
            ->join('skills', 'skills.id = candidate_skills.skill_id')
            ->where('candidate_skills.candidate_id', $candidateId);

    }
    // Check whether candidate already having this skill
    public function existsForCandidate(int $candidateId, int $skillId): bool
    {
        return $this->where('candidate_id', $candidateId)
            ->where('skill_id', $skillId)
            ->countAllResults() > 0;
    }

    // Check whether the skill belongs logged in user 
    public function belongsToUser(int $candidateSkillId, int $userId): bool
    {
        return $this->select('candidate_skills.id')
            ->join('candidates', 'candidates.id = candidate_skills.candidate_id')
            ->where('candidate_skills.id', $candidateSkillId)
            ->where('candidates.user_id', $userId)
            ->countAllResults() === 1;
    }
}
