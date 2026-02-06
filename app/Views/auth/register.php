<?= $this->extend('layouts/auth_layout') ?>
<?= $this->section('content') ?>

<div class="container">

    <!-- Page heading -->
    <div class="page-heading">
        <h2>Create Your Account</h2>
        <p>Register to start managing candidates and hiring workflows</p>
    </div>

    <!-- Register card -->
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">
            <div class="card shadow auth-card">
                <div class="row g-0">

                    <!-- Image column -->
                    <div class="col-md-6 auth-image"></div>

                    <!-- Form column -->
                    <div class="col-md-6">
                        <div class="auth-form">

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>

                            <?= form_open('/user/register/store') ?>

                            <div class="form-floating mb-3">
                                <input type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    placeholder="Full Name"
                                    required>
                                <label for="name">Full Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="Email"
                                    required>
                                <label for="email">Email address</label>
                            </div>

                            <div class="form-floating mb-4 position-relative">
                                <input type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    placeholder="Password"
                                    required>
                                <label for="password">Password</label>
                                <span class="toggle-password" onclick="togglePassword()">Show</span>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Register
                            </button>

                            <?= form_close() ?>

                            <p class="text-center mt-4 mb-0">
                                Already have an account?
                                <a href="/login" class="text-decoration-none text-secondry">
                                    Login here
                                </a>
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>