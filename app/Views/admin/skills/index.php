<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">

    <!-- Page header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div class="mb-4">
            <h3 class="page-title mb-1">Manage Skills</h3>
            <p class="text-muted mb-0">
                Create and manage skills used for candidate profiling
            </p>
        </div>
        <a href="/admin/dashboard" class="btn btn-sm border">
            Back to dashboard
        </a>
    </div>

    <!-- Add skill card -->
    <div class="card p-4 mb-4">

        <h5 class="fw-semibold mb-3">Add New Skill</h5>

        <?= form_open('/admin/skills/add') ?>
        <div class="row g-3 align-items-end">
            <div class="col-md-8">
                <div class="form-floating">
                    <input type="text" name="name" class="form-control" id="skillName" placeholder="Skill name"
                        required>
                    <label for="skillName">Skill Name</label>
                </div>
            </div>

            <div class="col-md-4 d-grid">
                <button class="btn btn-primary">
                    Add Skill
                </button>
            </div>
        </div>
        <?= form_close() ?>
    </div>

    <!-- Skills list -->
    <div class="card">

        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 80px;">#</th>
                            <th>Skill Name</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($skills)): ?>
                            <?php foreach ($skills as $i => $skill): ?>
                                <tr>
                                    <td class="text-muted"><?= $i + 1 ?></td>
                                    <td>
                                        <span class="fw-medium">
                                            <?= esc($skill['name']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2" class="text-center text-muted py-4">
                                    No skills added yet.
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>