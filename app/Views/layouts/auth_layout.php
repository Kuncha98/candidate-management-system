<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Candidate Management System') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/core/variables.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/core/base.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/core/components.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/core/utilities.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
</head>

<body class="auth-page">

    <?= $this->renderSection('content') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/common.js') ?>"></script>
</body>

</html>