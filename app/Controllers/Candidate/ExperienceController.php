<?php

namespace App\Controllers\Candidate;

use App\Controllers\BaseController;

use App\Models\CandidateExperienceModel;
use App\Models\CandidateModel;

class ExperienceController extends BaseController
{
    protected $experienceModel;
    protected $candidateModel;

    public function __construct()
    {
        $this->experienceModel = new CandidateExperienceModel();
        $this->candidateModel = new CandidateModel();
    }

    // Show experiences page
    public function index()
    {
        $candidate = $this->candidateModel
            ->where('user_id', session('user_id'))
            ->first();

        $data['experiences'] = $this->experienceModel
            ->forCandidate($candidate['id'])
            ->findAll();

        return view('candidate/experience/index', $data);
    }

    // Add experience to candidate
    public function store()
    {
        $candidate = $this->candidateModel
            ->where('user_id', session('user_id'))
            ->first();

        $this->experienceModel->insert([
            'candidate_id' => $candidate['id'],
            'company' => $this->request->getPost('company'),
            'role' => $this->request->getPost('role'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->back()->with('success', 'Experience added');
    }

    // Delete experience from candidate
    public function delete($id)
    {
        if (!$this->experienceModel->belongsToUser($id, session('user_id'))) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $this->experienceModel->delete($id);

        return redirect()->back()->with('success', 'Experience removed');
    }
}
