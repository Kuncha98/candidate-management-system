<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h3 class="page-title mb-1">Admin Dashboard</h3>
            <p class="text-muted mb-0">Overview of recruitment activity</p>
        </div>
        <div class="d-flex align-items-center gap-2 mt-3 mt-md-0">
            <a href="/admin/candidates" class="btn btn-primary">
                Manage Candidates
            </a>

            <a href="/admin/skills" class="btn btn-secondary">
                Manage Skills
            </a>
        </div>
    </div>

    <!-- KPI cards -->
    <div class="row g-3 mb-4">

        <div class="col-md-3 col-sm-6">
            <div class="card dashboard-stat">
                <h6>Total Candidates</h6>
                <h3><?= $candidateCount ?></h3>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card dashboard-stat">
                <h6>Total Users</h6>
                <h3><?= $userCount ?></h3>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card dashboard-stat">
                <h6>Total Skills</h6>
                <h3><?= $skillCount ?></h3>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card dashboard-stat">
                <h6>New Users This Month</h6>
                <h3>2</h3>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>