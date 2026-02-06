<?php
$request = service('request');
?>

<div class="card mb-4">
    <div class="card-body">

        <form method="get" action="<?= current_url() ?>" class="row g-3">

            <!-- Search -->
            <div class="col-12 col-md-3 col-lg-2">
                <label for="search" class="form-label">Search</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="Name or headline"
                    value="<?= esc($request->getGet('search')) ?>">
            </div>

            <!-- Location -->
            <div class="col-12 col-md-3 col-lg-2">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" id="location" class="form-control"
                    value="<?= esc($request->getGet('location')) ?>">
            </div>

            <!-- Experience -->
            <div class="col-12 col-md-3 col-lg-2">
                <label for="experience_years" class="form-label">Min Experience (Years)</label>
                <input type="number" name="experience_years" id="experience_years" class="form-control" min="0"
                    value="<?= esc($request->getGet('experience_years')) ?>">
            </div>

            <!-- Status -->
            <div class="col-12 col-md-3 col-lg-2">
                <label for="status_id" class="form-label">Status</label>
                <select name="status_id" id="status_id" class="form-select">
                    <option value="">All</option>
                    <?php foreach ($statuses as $status): ?>
                        <option value="<?= $status['id'] ?>" <?= ($request->getGet('status_id') == $status['id']) ? 'selected' : '' ?>>
                            <?= esc($status['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Skills -->
            <div class="col-12 col-md-3 col-lg-2">
                <label for="skills" class="form-label">Skills</label>
                <select name="skills" id="skills" class="form-select">
                    <option value="" disabled selected>All</option>
                    <?php foreach ($skills as $skill): ?>
                        <option value="<?= $skill['id'] ?>" <?= ($request->getGet('skills') == $skill['id']) ? 'selected' : '' ?>>
                            <?= esc($skill['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Actions -->
            <div class="col-12 col-md-3 col-lg-2 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    Apply
                </button>

                <a href="<?= current_url() ?>" class="btn btn-outline-secondary w-100">
                    Reset
                </a>
            </div>
        </form>
    </div>
</div>