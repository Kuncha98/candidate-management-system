<?php

namespace App\Controllers\Candidate;

use App\Controllers\BaseController;

use App\Models\CandidateEducationModel;
use App\Models\CandidateModel;

class EducationController extends BaseController
{
    protected $educationModel;
    protected $candidateModel;

    public function __construct()
    {
        $this->educationModel = new CandidateEducationModel();
        $this->candidateModel = new CandidateModel();
    }

    // Show educations page
    public function index()
    {
        $candidate = $this->candidateModel
            ->where('user_id', session('user_id'))
            ->first();

        $data['educations'] = $this->educationModel
            ->forCandidate($candidate['id'])
            ->findAll();

        return view('candidate/education/index', $data);
    }

    // Add education to candidate
    public function store()
    {
        $candidate = $this->candidateModel
            ->where('user_id', session('user_id'))
            ->first();

        $this->educationModel->insert([
            'candidate_id' => $candidate['id'],
            'institution' => $this->request->getPost('institution'),
            'degree' => $this->request->getPost('degree'),
            'field_of_study' => $this->request->getPost('field_of_study'),
            'start_year' => $this->request->getPost('start_year'),
            'end_year' => $this->request->getPost('end_year'),
        ]);

        return redirect()->back()->with('success', 'Education added');
    }

    // Delete education from candidate
    public function delete($id)
    {
        if (!$this->educationModel->belongsToUser($id, session('user_id'))) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $this->educationModel->delete($id);

        return redirect()->back()->with('success', 'Education removed');
    }
}
