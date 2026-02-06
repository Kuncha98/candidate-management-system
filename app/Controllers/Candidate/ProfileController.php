<?php

namespace App\Controllers\Candidate;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\CandidateModel;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $candidateModel;
    protected $userModel;

    public function __construct()
    {
        $this->candidateModel = new CandidateModel();
        $this->userModel = new UserModel();
    }

    // Fetch candidate from ID
    public function view()
    {
        $userId = session()->get('user_id');

        $candidate = $this->candidateModel->getCandidateByUserId($userId);

        if (!$candidate) {
            return redirect()->to('/logout')
                ->with('error', 'Candidate profile not found.');
        }

        return view('candidate/profile/index', [
            'candidate' => $candidate,
            'skills' => $candidate['skills'],
            'educations' => $candidate['education'],
            'experiences' => $candidate['experience'],
        ]);
    }

    // Edit candidate profile
    public function edit()
    {
        $candidate = $this->candidateModel
            ->getCandidateByUserId(session()->get('user_id'));

        if (!$candidate) {
            return redirect()->to('/logout')
                ->with('error', 'Profile not found');
        }

        return view('candidate/profile/edit', [
            'candidate' => $candidate
        ]);
    }

    // Update candidate profile
    public function update()
    {
        $candidate = $this->candidateModel
            ->getCandidateByUserId(session()->get('user_id'));

        $this->candidateModel->update($candidate['id'], [
            'headline' => $this->request->getPost('headline'),
            'summary' => $this->request->getPost('summary'),
            'location' => $this->request->getPost('location'),
            'experience_years' => $this->request->getPost('experience_years'),
        ]);

        // Update user name in user tbl
        $this->userModel->update(session()->get('user_id'), [
            'name' => $this->request->getPost('name')
        ]);

        return redirect()->to('/candidate/profile')->with('success', 'Profile updated');
    }
}
