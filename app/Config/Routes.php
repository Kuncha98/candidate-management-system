<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home route
$routes->get('/', 'Home::index');

// Public routes
// User register
$routes->get('/user/register', 'Auth::register');
$routes->post('/user/register/store', 'Auth::store');
// Candidate register
$routes->get('/candidate/register', 'Candidate\RegistrationController::register');
$routes->post('/candidate/register/store', 'Candidate\RegistrationController::store');
// Login
$routes->get('/login', 'Auth::login');
$routes->post('/login/post', 'Auth::loginPost');
// Role base redirection
$routes->get('/login/redirect', 'Auth::redirectAfterLogin');
// Logout
$routes->get('/logout', 'Auth::logout');

// Logged users routes
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/browse/candidates', 'CandidateBrowseController::index');
    $routes->get('/browse/candidate/(:num)', 'CandidateBrowseController::view/$1');
    $routes->post('/browse/candidate/updateStatus/(:num)', 'CandidateBrowseController::updateCandidateStatus/$1');
});

// Admin routes
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin::dashboard');
    // Candidate
    $routes->get('candidates', 'Admin::candidates');
    $routes->post('candidate/updateStatus/(:num)', 'Admin::updateCandidateStatus/$1');
    // Skills
    $routes->get('skills', 'Admin::skills');
    $routes->post('skills/add', 'Admin::addSkill');
});

$routes->group('candidate', ['filter' => 'candidate'], function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Candidate\DashboardController::index');
    // Profile
    $routes->get('profile', 'Candidate\ProfileController::view');
    $routes->get('profile/edit', 'Candidate\ProfileController::edit');
    $routes->post('profile/update', 'Candidate\ProfileController::update');
    // Experience
    $routes->get('experience', 'Candidate\ExperienceController::index');
    $routes->post('experience/store', 'Candidate\ExperienceController::store');
    $routes->get('experience/delete/(:num)', 'Candidate\ExperienceController::delete/$1');
    // Education
    $routes->get('education', 'Candidate\EducationController::index');
    $routes->post('education/store', 'Candidate\EducationController::store');
    $routes->get('education/delete/(:num)', 'Candidate\EducationController::delete/$1');
    // Skill
    $routes->get('skill', 'Candidate\SkillController::index');
    $routes->post('skill/store', 'Candidate\SkillController::store');
    $routes->get('skill/delete/(:num)', 'Candidate\SkillController::delete/$1');
});
