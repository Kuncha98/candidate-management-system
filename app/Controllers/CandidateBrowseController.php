<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\CandidateModel;
use App\Models\StatusModel;
use App\Models\SkillModel;

use App\Models\CandidateExperienceModel;
use App\Models\CandidateEducationModel;
use App\Models\CandidateSkillModel;
class CandidateBrowseController extends BaseController
{
    protected $candidateModel;
    protected $statusModel;
    protected $skillModel;
    protected $candidateExperienceModel;
    protected $candidateEducationModel;
    protected $candidateSkillModel;
    protected $statuses;

    public function __construct()
    {
        $this->candidateModel = new CandidateModel();
        $this->statusModel = new StatusModel();
        $this->skillModel = new SkillModel();
        $this->candidateExperienceModel = new CandidateExperienceModel();
        $this->candidateEducationModel = new CandidateEducationModel();
        $this->candidateSkillModel = new CandidateSkillModel();

        // Fetch statuses
        $this->statuses = $this->statusModel->findAll();
    }


    // Fetch all candidates with search & filter
    public function index()
    {
        if (session()->get('user_role') === 'candidate') {
            return redirect()->to('/candidate/profile')
                ->with('error', 'Access denied');
        }

        $filters = $this->getFiltersFromRequest();
        $candidates = $this->candidateModel->browseCandidates($filters, 9);
        $candidateIds = array_column($candidates, 'id');

        return view('browse/candidates/index', [
            'candidates' => $candidates,
            'skillsMap' => $this->candidateModel->getTopSkillsForCandidates($candidateIds),
            'statuses' => $this->statuses,
            'pager' => $this->candidateModel->pager,
            'skills' => ($this->skillModel)->findAll(),
        ]);
    }

    // Get filter requests
    private function getFiltersFromRequest()
    {
        return [
            'search' => $this->request->getGet('search'),
            'location' => $this->request->getGet('location'),
            'experience_years' => $this->request->getGet('experience_years'),
            'status_id' => $this->request->getGet('status_id'),
            'skills' => $this->request->getGet('skills'),
        ];
    }

    // Fetch candidate profile
    public function view($id)
    {
        if (session()->get('user_role') === 'candidate') {
            return redirect()->to('/candidate/profile')
                ->with('error', 'Access denied');
        }

        $candidate = $this->candidateModel->getCandidateByCandidateId($id);
        $data = [
            'candidate' => $candidate,
            'skills' => $candidate['skills'],
            'educations' => $candidate['education'],
            'experiences' => $candidate['experience'],
            'statuses' => $this->statuses,
        ];

        return view('browse/candidates/view', $data);
    }

    // Update candidate status
    public function updateCandidateStatus($id)
    {
        $statusId = $this->request->getPost('status_id');
        $this->candidateModel->update($id, ['status_id' => $statusId]);
        return redirect()->back()->with('success', 'Candidate status updated!');
    }
}
