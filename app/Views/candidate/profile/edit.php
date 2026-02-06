<?= $this->extend('layouts/candidate_layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <!-- Page header -->
    <div class="mb-4">
        <h3 class="page-title mb-1">Edit Profile</h3>
        <p class="text-muted mb-0">
            Update your profile
        </p>
    </div>

    <!-- Form card -->
    <div class="card p-4">
        <?= form_open('/candidate/profile/update') ?>
        <div class="row g-3">

            <div class="col-md-6">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= esc($candidate['name']) ?>"
                    required>
            </div>

            <div class="col-md-6">
                <label for="headline" class="form-label">Headline</label>
                <input type="text" name="headline" id="headline" class="form-control"
                    value="<?= esc($candidate['headline']) ?>">
            </div>

            <div class="col-md-12">
                <label for="summary" class="form-label">Summary</label>
                <textarea name="summary" id="summary" class="form-control"
                    rows="4"><?= esc($candidate['summary']) ?></textarea>
            </div>

            <div class="col-md-6">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" id="location" class="form-control"
                    value="<?= esc($candidate['location']) ?>">
            </div>

            <div class="col-md-6">
                <label for="experience_years" class="form-label">Experience (Years)</label>
                <input type="number" name="experience_years" id="experience_years" class="form-control"
                    value="<?= esc($candidate['experience_years']) ?>">
            </div>
        </div>

        <!-- Actions -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">
                Save Changes
            </button>
        </div>
        <?= form_close() ?>

    </div>

</div>
<?= $this->endSection() ?>