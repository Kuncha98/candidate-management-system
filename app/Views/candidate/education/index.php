<?= $this->extend('layouts/candidate_layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <!-- Page header -->
    <div class="mb-4">
        <h3 class="page-title mb-1">Education</h3>
        <p class="text-muted mb-0">
            Manage your education

        </p>
    </div>

    <!-- Form card -->
    <div class="card p-4 mb-5">
        <?= form_open('/candidate/education/store') ?>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="institution" class="form-label">Institution</label>
                <input type="text" name="institution" id="institution" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="degree" class="form-label">Degree</label>
                <input type="text" name="degree" id="degree" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="field_of_study" class="form-label">Field of Study</label>
                <input type="text" name="field_of_study" id="field_of_study" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="start_year" class="form-label">Start Year</label>
                <input type="date" name="start_year" id="start_year" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="end_year" class="form-label">End Year</label>
                <input type="date" name="end_year" id="end_year" class="form-control">
            </div>
        </div>

        <!-- Actions -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">
                Add Education
            </button>
        </div>
        <?= form_close() ?>
    </div>

    <!-- Education List -->
    <?php foreach ($educations as $edu): ?>
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center p-4">
                <div>
                    <strong><?= esc($edu['degree']) ?></strong> — <?= esc($edu['institution']) ?>
                    <p class="text-muted m-0"><?= esc($edu['field_of_study']) ?></p>
                </div>

                <a href="/candidate/education/delete/<?= $edu['id'] ?>" class="btn btn-sm btn-outline-danger">
                    Delete
                </a>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?= $this->endSection() ?>