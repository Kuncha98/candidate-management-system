<?php

namespace App\Controllers\Candidate;

use App\Controllers\BaseController;

use App\Models\CandidateSkillModel;
use App\Models\CandidateModel;
use App\Models\SkillModel;

class SkillController extends BaseController
{
    protected $skillModel;
    protected $candidateModel;
    protected $candidateSkillModel;

    public function __construct()
    {
        $this->candidateSkillModel = new CandidateSkillModel();
        $this->candidateModel = new CandidateModel();
        $this->skillModel = new SkillModel();
    }

    // Show skills page
    public function index()
    {
        $candidate = $this->candidateModel
            ->where('user_id', session('user_id'))
            ->first();

        $data = [
            'candidateSkills' => $this->candidateSkillModel
                ->forCandidate($candidate['id'])
                ->findAll(),
            'allSkills' => $this->skillModel->findAll()
        ];

        return view('candidate/skill/index', $data);
    }

    // Add skill to candidate
    public function store()
    {
        $candidate = $this->candidateModel
            ->where('user_id', session('user_id'))
            ->first();

        if ($this->candidateSkillModel->existsForCandidate($candidate['id'], $this->request->getPost('skill_id'))) {
            return redirect()->back()
                ->with('error', 'This skill is already added to your profile.');
        }

        $this->candidateSkillModel->insert([
            'candidate_id' => $candidate['id'],
            'skill_id' => $this->request->getPost('skill_id'),
            'level' => $this->request->getPost('level'),
        ]);

        return redirect()->back()->with('success', 'Skill added');
    }

    // Delete skill from candidate
    public function delete($id)
    {
        if (!$this->candidateSkillModel->belongsToUser($id, session('user_id'))) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $this->candidateSkillModel->delete($id);

        return redirect()->back()->with('success', 'Skill removed');
    }
}
