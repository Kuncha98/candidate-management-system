<?= $this->extend('layouts/candidate_layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h3 class="page-title mb-1">Candidate Dashboard</h3>
            <p class="text-muted mb-0">Overview of your profile</p>
        </div>

        <div class="d-flex gap-2 mt-3 mt-md-0">
            <a href="/candidate/profile" class="btn btn-primary">
                View Profile
            </a>
        </div>
    </div>

    <!-- KPI cards -->
    <div class="row g-3 mb-4">

        <div class="col-md-3 col-sm-6">
            <div class="card dashboard-stat">
                <h6>Total Profile Views</h6>
                <h3>32</h3>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card dashboard-stat">
                <h6>Total Skills</h6>
                <h3>4</h3>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card dashboard-stat">
                <h6>Total Experience</h6>
                <h3>10</h3>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card dashboard-stat">
                <h6>Total Skills</h6>
                <h3>43</h3>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>