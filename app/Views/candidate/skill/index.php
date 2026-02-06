<?= $this->extend('layouts/candidate_layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <!-- Page header -->
    <div class="mb-4">
        <h3 class="page-title mb-1">Professional Skills</h3>
        <p class="text-muted mb-0">
            Add your professional skills to get highlighted
        </p>
    </div>

    <!-- Form card -->
    <div class="card p-4 mb-5">
        <?= form_open('/candidate/skill/store') ?>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="skill_id" class="form-label">Skill</label>
                <select name="skill_id" id="skill_id" class="form-select" required>
                    <?php foreach ($allSkills as $skill): ?>
                        <option value="<?= $skill['id'] ?>">
                            <?= esc($skill['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="level" class="form-label">Professioncy level</label>
                <select name="level" class="form-select" required>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate" selected>Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
            </div>

        </div>

        <!-- Actions -->
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">
                Add Skill
            </button>
        </div>
    </div>

    <!-- Skill List -->
    <?php foreach ($candidateSkills as $cs): ?>
        <div class="card  mb-3">
            <div class="card-body d-flex justify-content-between align-items-center p-4">
                <div>
                    <strong>
                        <?= esc($cs['skill_name']) ?>
                    </strong> —
                    <?= esc($cs['level']) ?>
                </div>

                <a href="/candidate/skill/delete/<?= $cs['id'] ?>" class="btn btn-sm btn-outline-danger">
                    Delete
                </a>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?= $this->endSection() ?>