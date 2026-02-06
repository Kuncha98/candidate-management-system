<?= $this->extend('layouts/candidate_layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <!-- Page header -->
    <div class="mb-4">
        <h3 class="page-title mb-1">Work Experience</h3>
        <p class="text-muted mb-0">
            Manage your work experience
        </p>
    </div>

    <!-- Form card -->
    <div class="card p-4 mb-5">
        <?= form_open('/candidate/experience/store') ?>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="company" class="form-label">Company</label>
                <input type="text" name="company" id="company" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="role" class="form-label">Role</label>
                <input type="text" name="role" id="role" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control">
            </div>

            <div class="col-12 mb-2">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
            </div>
        </div>

        <!-- Actions -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">
                Add Experience
            </button>
        </div>
        <?= form_close() ?>
    </div>

    <!-- Experience List -->
    <?php foreach ($experiences as $exp): ?>
        <div class="card  mb-3">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <strong>
                            <?= esc($exp['role']) ?></strong> at
                        <?= esc($exp['company']) ?>
                    </span>

                    <small class="text-muted">
                        From <?= $exp['start_date'] ?> to
                        <?= $exp['end_date'] ?? 'Present' ?>
                    </small>
                </div>
                <p class="text-muted mt-2">
                    <?= esc($exp['description']) ?>
                </p>

                <a href="/candidate/experience/delete/<?= $exp['id'] ?>" class="btn btn-sm btn-outline-danger "
                    onclick="return confirm('Remove this experience?')">
                    Delete
                </a>
            </div>
        </div>
    <?php endforeach ?>
</div>


<?= $this->endSection() ?>