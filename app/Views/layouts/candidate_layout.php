<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= esc($title ?? 'Candidate Management System') ?>
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/core/variables.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/core/base.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/core/components.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/core/utilities.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/candidate-layout.css') ?>">

</head>

<body>

    <!-- Navbar -->
    <?= $this->include('layouts/header') ?>

    <!-- Sidebar -->
    <aside class="sidebar p-4" id="sidebar">
        <div class="collapse d-lg-block" id="sidebarMenu">
            <ul class="nav flex-column gap-3">
                <li class="nav-item">
                    <a class="nav-link <?= service('uri')->getSegment(2) === 'dashboard' ? 'active' : '' ?>"
                        href="/candidate/dashboard">
                        <i class="fa fa-tv me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= service('uri')->getSegment(2) === 'profile' && !service('uri')->getSegment(3) ? 'active' : '' ?>"
                        href="/candidate/profile">
                        <i class="fa fa-user me-2"></i> My Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= service('uri')->getSegment(2) === 'profile' && service('uri')->getSegment(3) === 'edit' ? 'active' : '' ?>"
                        href="/candidate/profile/edit">
                        <i class="fa fa-user-plus me-2"></i> Edit Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= service('uri')->getSegment(2) === 'experience' ? 'active' : '' ?>"
                        href="/candidate/experience">
                        <i class="fa fa-briefcase me-2"></i> Experience
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= service('uri')->getSegment(2) === 'education' ? 'active' : '' ?>"
                        href="/candidate/education">
                        <i class="fa fa-book me-2"></i> Education
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= service('uri')->getSegment(2) === 'skill' ? 'active' : '' ?>"
                        href="/candidate/skill">
                        <i class="fa fa-tools me-2"></i> Skills
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="content-wrapper d-flex flex-column">
        <!-- Main content -->
        <main class="col-md-12 col-lg-12 p-4">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Content will render here -->
            <?= $this->renderSection('content') ?>
        </main>

        <!-- Footer -->
        <?= $this->include('layouts/footer') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

    <script>
        // Get references to elements
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarMenu = document.getElementById('sidebarMenu');

        // Toggle sidebar on button click
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('show');
            sidebarMenu.classList.toggle('show');
        });
    </script>
</body>

</html>