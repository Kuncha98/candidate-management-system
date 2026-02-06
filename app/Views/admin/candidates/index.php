<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">

    <!-- Page header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h3 class="page-title mb-1">Manage Candidates</h3>
            <p class="text-muted mb-0">View all the candidates</p>
        </div>

        <a href="/admin/dashboard" class="btn btn-sm border">
            Back to dashboard
        </a>
    </div>

    <div class="card p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 candidate-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Skills</th>
                        <th>Location</th>
                        <th class="text-end">Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($candidates as $candidate): ?>
                        <tr>
                            <td>
                                <strong><?= esc($candidate['name']) ?></strong>
                            </td>

                            <td>
                                <?php foreach ($skillsMap[$candidate['id']] ?? [] as $skill): ?>
                                    <span class="badge skill-badge border me-1 me-2 mb-2">
                                        <?= esc($skill) ?>
                                    </span>
                                <?php endforeach; ?>
                            </td>

                            <td>
                                <?= esc($candidate['location']) ?>
                            </td>

                            <td class="text-end">
                                <form action="/admin/candidate/updateStatus/<?= $candidate['id'] ?>" method="post">
                                    <select name="status_id" class="badge status-badge" onchange="this.form.submit()">
                                        <?php foreach ($statuses as $status): ?>
                                            <option value="<?= $status['id'] ?>" <?= $status['name'] === $candidate['status_name'] ? 'selected' : '' ?>>
                                                <?= esc($status['name']) ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>
<?= $this->endSection() ?>