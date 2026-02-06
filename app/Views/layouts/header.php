<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-navbar navbar-app">
    <div class="container-fluid px-4">

        <div>
            <?php if (session()->get('user_role') === 'candidate'): ?>
                <!-- Mobile sidebar toggle button -->
                <button class="navbar-toggler border-0" type="button" id="sidebarToggle">
                    <i class="fa fa-bars"></i>
                </button>
            <?php endif; ?>

            <!-- Brand -->
            <a class="navbar-brand" href="/">
                Navafiz
            </a>
        </div>

        <!-- Mobile user toggle button -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#appNavbar"
            aria-controls="appNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-user"></i>
        </button>



        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="appNavbar">

            <!-- Right side -->
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3 mt-3 mt-lg-0">

                <?php if (session()->get('logged_in')): ?>
                    <li class="nav-item">
                        <span class="nav-link text-muted">
                            <?= esc(session()->get('user_name')) ?>
                        </span>
                    </li>

                    <li class="nav-item">
                        <a href="/logout" class="btn btn-outline-primary btn-sm w-100 w-lg-auto">
                            Logout
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="/candidate/register" class="btn btn-primary btn-sm w-100 w-lg-auto">
                            Register as candidate
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>

    </div>
</nav>