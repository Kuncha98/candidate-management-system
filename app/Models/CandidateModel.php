<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\CandidateSkillModel;
use App\Models\CandidateEducationModel;
use App\Models\CandidateExperienceModel;

class CandidateModel extends Model
{
    protected $table = 'candidates';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id',
        'headline',
        'summary',
        'location',
        'experience_years',
        'status_id',
        'created_at',
        'updated_at'
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

    // Inject models
    protected $candidateSkillModel;
    protected $candidateEducationModel;
    protected $candidateExperienceModel;
    public function __construct()
    {
        parent::__construct();
        $this->candidateSkillModel = new CandidateSkillModel();
        $this->candidateEducationModel = new CandidateEducationModel();
        $this->candidateExperienceModel = new CandidateExperienceModel();
    }

    // Fetch candidate using user ID
    public function getCandidateByUserId(int $userId)
    {
        $candidate = $this
            ->select('
                candidates.*,
                users.name,
                statuses.name as status_name
            ')
            ->join('users', 'users.id = candidates.user_id')
            ->join('statuses', 'statuses.id = candidates.status_id', 'left')
            ->where('candidates.user_id', $userId)
            ->first();

        if (!$candidate) {
            return null;
        }

        // Fetch skills, education, experience using above injected models
        $candidate['skills'] = $this->candidateSkillModel->forCandidate($candidate['id'])->get()->getResultArray();
        $candidate['education'] = $this->candidateEducationModel->forCandidate($candidate['id'])->get()->getResultArray();
        $candidate['experience'] = $this->candidateExperienceModel->forCandidate($candidate['id'])->get()->getResultArray();

        return $candidate;
    }

    // Fetch all the candidates to browse & filter
    public function browseCandidates(array $filters = [], int $perPage = 9)
    {
        $builder = $this->select('
            candidates.id,
            candidates.headline,
            candidates.location,
            candidates.experience_years,
            statuses.name as status_name,
            users.name
        ')
            ->join('users', 'users.id = candidates.user_id')
            ->join('statuses', 'statuses.id = candidates.status_id', 'left');

        // Search (name + headline)
        if (!empty($filters['search'])) {
            $builder->groupStart()
                ->like('users.name', $filters['search'])
                ->orLike('candidates.headline', $filters['search'])
                ->groupEnd();
        }

        // Location
        if (!empty($filters['location'])) {
            $builder->like('candidates.location', $filters['location']);
        }

        // Experience
        if (!empty($filters['experience_years'])) {
            $builder->where('candidates.experience_years >=', $filters['experience_years']);
        }

        // Status
        if (!empty($filters['status_id'])) {
            $builder->where('candidates.status_id', $filters['status_id']);
        }

        // Skills filter
        if (!empty($filters['skills'])) {
            $skills = (array) $filters['skills'];
            $builder->whereIn(
                'candidates.id',
                function ($sub) use ($skills) {
                    return $sub->select('candidate_id')
                        ->from('candidate_skills')
                        ->whereIn('skill_id', $skills);
                }
            );
        }
        return $builder->paginate($perPage);
    }

    // Fetch limited 5 skills for candidates
    public function getTopSkillsForCandidates(array $candidateIds, int $limit = 5)
    {
        if (empty($candidateIds)) {
            return [];
        }

        $grouped = [];

        // Loop through each candidate ID
        foreach ($candidateIds as $candidateId) {

            $skills = $this->candidateSkillModel->forCandidate($candidateId)->limit($limit)->get()->getResultArray();
            // Add skills to the grouped array, keeping them under the candidate_id key
            $grouped[$candidateId] = array_map(function ($skill) {
                return $skill['skill_name'];
            }, $skills);
        }

        if (empty($grouped)) {
            return null;
        }
        return $grouped;
    }

    // Fetch candidate using candidate ID
    public function getCandidateByCandidateId(int $candidateId)
    {
        $candidate = $this
            ->select('
                candidates.*,
                users.name,
                statuses.name as status_name
            ')
            ->join('users', 'users.id = candidates.user_id')
            ->join('statuses', 'statuses.id = candidates.status_id')
            ->find($candidateId);

        // Fetch skills, education, experience using above injected models
        $candidate['skills'] = $this->candidateSkillModel->forCandidate($candidate['id'])->get()->getResultArray();
        $candidate['education'] = $this->candidateEducationModel->forCandidate($candidate['id'])->get()->getResultArray();
        $candidate['experience'] = $this->candidateExperienceModel->forCandidate($candidate['id'])->get()->getResultArray();

        if (!$candidate) {
            return null;
        }
        return $candidate;
    }

}
