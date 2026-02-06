<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\CandidateModel;
use App\Models\StatusModel;
use App\Models\SkillModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    protected $candidateModel;
    protected $statusModel;
    protected $skillModel;
    protected $userModel;
    protected $skills;

    public function __construct()
    {
        $this->candidateModel = new CandidateModel();
        $this->statusModel = new StatusModel();
        $this->skillModel = new SkillModel();
        $this->userModel = new UserModel();

        // Fetch statuses
        $this->skills = $this->skillModel->findAll();
    }

    // Dashboard summary
    public function dashboard()
    {
        $filters = [];
        $data['candidateCount'] = $this->candidateModel->countAll();
        $data['userCount'] = $this->userModel->countAll();
        $data['skillCount'] = $this->skillModel->countAll();
        $candidates = $this->candidateModel->browseCandidates($filters, 9);

        return view('admin/dashboard', [
            'candidateCount' => $data['candidateCount'],
            'userCount' => $data['userCount'],
            'skillCount' => $data['skillCount'],
            'candidates' => $candidates,

        ]);
    }

    // Fetch all candidates with search & filter
    public function candidates()
    {
        if (session()->get('user_role') === 'candidate') {
            return redirect()->to('/candidate/profile')
                ->with('error', 'Access denied');
        }

        $filters = $this->getFiltersFromRequest();
        $candidates = $this->candidateModel->browseCandidates($filters, 9);
        $candidateIds = array_column($candidates, 'id');

        return view('admin/candidates/index', [
            'candidates' => $candidates,
            'skillsMap' => $this->candidateModel->getTopSkillsForCandidates($candidateIds),
            'statuses' => $this->statusModel->findAll(),
            'pager' => $this->candidateModel->pager,
            'skills' => $this->skills,
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

    // Update candidate status
    public function updateCandidateStatus($id)
    {
        $statusId = $this->request->getPost('status_id');
        $this->candidateModel->update($id, ['status_id' => $statusId]);
        return redirect()->to('/admin/candidates')->with('success', 'Candidate status updated!');
    }

    // Fetch skills
    public function skills()
    {
        $data['skills'] = $this->skills;
        return view('admin/skills/index', $data);
    }

    // Add skills
    public function addSkill()
    {
        $this->skillModel->save(['name' => $this->request->getPost('name')]);
        return redirect()->back()->with('success', 'Skill added successfully.');
    }


}