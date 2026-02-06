<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <!-- Page header -->
    <div class="d-flex justify-content-between mb-4">
        <div class="">
            <h3 class="page-title mb-1">
                <?= esc($candidate['name']) ?>
            </h3>
            <p class="text-muted mb-2">
                <?= esc($candidate['headline']) ?>
            </p>
            <span class="badge bg-secondary">
                <?= esc($candidate['location']) ?: 'No location' ?>
            </span>
        </div>
        <a href="/browse/candidates" class="btn btn-sm border">
            Back to all candidates
        </a>
    </div>

    <div class="row g-3">
        <!-- Left panel -->
        <div class="col-12 col-md-12 col-lg-6">

            <!-- Summary -->
            <div class="card mb-3">
                <div class="card-body p-4">
                    <h5><strong>Professional Summary</strong></h5>

                    <p class="text-muted mt-3 mb-0">
                        <?= esc($candidate['summary']) ?: 'No summary provided.' ?>
                    </p>
                </div>
            </div>

            <!-- Experience -->
            <div class="card">
                <div class="card-body p-4">
                    <h5><strong>Professional Experience</strong></h5>

                    <?php foreach ($experiences as $exp): ?>
                        <div class="border-start ps-3 my-3">
                            <strong>
                                <?= esc($exp['role']) ?>
                            </strong> at
                            <?= esc($exp['company']) ?>
                            <br>
                            <small class="text-muted">
                                (
                                <?= $exp['start_date'] ?> –
                                <?= $exp['end_date'] ?? 'Present' ?>)
                            </small>
                            <p class="text-muted mt-2">
                                <?= esc($exp['description']) ?>
                            </p>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>

        <!-- Right panel -->
        <div class="col-12 col-md-12 col-lg-6">

            <!-- Profile Details -->
            <div class="card mb-3">
                <div class="card-body p-4">
                    <h5><strong>Profile Details</strong></h5>

                    <div class="row mt-3 mb-2">
                        <div class="col-3 text-muted">Experience</div>
                        <div class="col-9">
                            <?= esc($candidate['experience_years']) ?: '0' ?> years
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 text-muted">Current Status</div>
                        <div class="col-9">
                            <?php if (in_array(session('user_role'), ['admin', 'user'])): ?>
                                <form method="post" action="/browse/candidate/updateStatus/<?= $candidate['id'] ?>">
                                    <select name="status_id" class="badge status-badge">
                                        <?php foreach ($statuses as $status): ?>
                                            <option value="<?= $status['id'] ?>" <?= $status['name'] === $candidate['status_name'] ? 'selected' : '' ?>>
                                                <?= esc($status['name']) ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                    <button class="btn btn-sm btn-primary">Update</button>
                                </form>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Skills -->
            <div class="card mb-3">
                <div class="card-body p-4">
                    <h5><strong>Skills</strong></h5>

                    <div class="mt-3">
                        <?php foreach ($skills as $skill): ?>
                            <span class="badge skill-badge border me-2 mb-2">
                                <?= esc($skill['skill_name']) ?> (
                                <?= esc($skill['level']) ?>)
                            </span>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>

            <!-- Education -->
            <div class="card">
                <div class="card-body p-4">
                    <h5><strong>Education</strong></h5>

                    <div class="mt-3">
                        <?php foreach ($educations as $edu): ?>
                            <p>
                                <strong>
                                    <?= esc($edu['degree']) ?>
                                </strong>,
                                <?= esc($edu['institution']) ?>
                                <br>
                                <small class="text-muted">
                                    <?= esc($edu['field_of_study']) ?>
                                    (
                                    <?= $edu['start_year'] ?> –
                                    <?= $edu['end_year'] ?? 'Present' ?>)
                                </small>
                            </p>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>