<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<div class="container py-5">

    <!-- Hero section -->
    <div class="row align-items-center justify-content-center text-center">

        <div class="col-lg-8">

            <h1 class="fw-bold mb-3">
                Candidate Management System
            </h1>

            <p class="text-muted fs-5 mb-4">
                A simple and powerful platform to manage candidates,
                track hiring progress, and organize skills efficiently.
            </p>

            <div class="d-flex justify-content-center gap-3 flex-wrap">

                <?php if (session()->get('logged_in')): ?>
                    <?php $userRole = session()->get('user_role'); ?>

                    <?php if ($userRole == 'admin'): ?>
                        <a href="/admin/dashboard" class="btn btn-primary px-4">
                            Go to Admin Dashboard
                        </a>
                    <?php elseif ($userRole == 'candidate'): ?>
                        <a href="/candidate/dashboard" class="btn btn-primary px-4">
                            Go to Candidate Dashboard
                        </a>
                    <?php elseif ($userRole == 'user'): ?>
                        <a href="/browse/candidates" class="btn btn-primary px-4">
                            Browse Candidates
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="/login" class="btn btn-primary px-4">
                        Login
                    </a>
                    <a href="/user/register" class="btn btn-secondary px-4">
                        Create Account
                    </a>
                <?php endif; ?>

            </div>

        </div>

    </div>

    <!-- Feature highlights -->
    <div class="row mt-5 g-4">

        <div class="col-md-4">
            <div class="card p-4 h-100 text-center">
                <h5 class="fw-semibold mb-2">Candidate Tracking</h5>
                <p class="text-muted mb-0">
                    View, filter, and manage candidates across
                    different hiring stages with ease.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 h-100 text-center">
                <h5 class="fw-semibold mb-2">Skill Management</h5>
                <p class="text-muted mb-0">
                    Maintain a centralized skill database and
                    associate skills with candidates accurately.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 h-100 text-center">
                <h5 class="fw-semibold mb-2">HR-Focused Workflow</h5>
                <p class="text-muted mb-0">
                    Designed for recruiters to focus on
                    decisions instead of administrative overhead.
                </p>
            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>