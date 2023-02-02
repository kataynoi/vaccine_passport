<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">Vaccine Passport <?php echo $this->session->userdata('prov') ;?></a>
        <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

            <ul class="navbar-nav ms-auto">

                <?php

                if ($this->session->userdata('user_login') == 1) {
                    echo "<li class='nav-item mx-0 mx-lg-1'><a class='nav-link py-3 px-0 px-lg-3 rounded' href='" . site_url('/user/logout') . "'>ออกจากระบบ</a></li>";
                } else {
                    echo "<li class='nav-item mx-0 mx-lg-1'><a class='nav-link py-3 px-0 px-lg-3 rounded' href='" . site_url('/user/login') . "'>เข้าสู่ระบบ</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>