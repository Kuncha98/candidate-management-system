<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- Header -->
    <div class="text-center mb-4">
        <div>
            <h3 class="page-title mb-1">Browse Candidates</h3>
            <p class="text-muted mb-0">Overview of your profile</p>
        </div>
    </div>

    <!-- Filter -->
    <?= view('browse/candidates/_filters') ?>

    <!-- Candidate card view -->
    <div class="row g-3">
        <?php if (!empty($candidates)): ?>
            <?php foreach ($candidates as $candidate): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card candidate-card h-100">
                        <div class="card-body">
                            <h5 class="mb-1">
                                <?= esc($candidate['name']) ?>
                            </h5>
                            <small class="text-muted">
                                <?= esc($candidate['headline']) ?>
                            </small>

                            <ul class="list-unstyled small my-3">
                                <li class="mb-1"><strong>Location:</strong>
                                    <?= esc($candidate['location']) ?>
                                </li>
                                <li><strong>Experience:</strong>
                                    <?= esc($candidate['experience_years']) ?> yrs
                                </li>
                            </ul>

                            <div>
                                <?php foreach ($skillsMap[$candidate['id']] ?? [] as $skill): ?>
                                    <span class="badge skill-badge border me-1 me-2 mb-2">
                                        <?= esc($skill) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>

                            <ul class="list-unstyled  my-3">
                                <li class="mb-1"><strong class="small">Location:</strong>
                                    <span class="badge status-badge border me-1">
                                        <?= esc($candidate['status_name']) ?>
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <div class="card-footer bg-white">
                            <a href="/browse/candidate/<?= $candidate['id'] ?>" class="btn btn-outline-primary w-100">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted mt-5">
                No candidates found.
            </p>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        <?= $pager->links() ?>
    </div>

</div>

<?= $this->endSection() ?>