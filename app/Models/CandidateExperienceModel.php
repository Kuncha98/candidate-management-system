<?php

namespace App\Models;

use CodeIgniter\Model;

class CandidateExperienceModel extends Model
{
    protected $table = 'candidate_experiences';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'candidate_id',
        'company',
        'role',
        'start_date',
        'end_date',
        'description',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
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

    // Fetch experience using candidate ID
    public function forCandidate(int $candidateId)
    {
        return $this->where('candidate_id', $candidateId);
    }

    // Check whether the experience belongs logged in user 
    public function belongsToUser(int $experienceId, int $userId): bool
    {
        return $this->select('candidate_experiences.id')
            ->join('candidates', 'candidates.id = candidate_experiences.candidate_id')
            ->where('candidate_experiences.id', $experienceId)
            ->where('candidates.user_id', $userId)
            ->countAllResults() === 1;
    }
}
