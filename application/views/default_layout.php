<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ระบบงาน Vaccine Passport Mahasarakham<?php echo $this->session->userdata('fullname');?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url() ?>js/jquery.min.js" charset="utf-8"></script>
    <script src="<?php echo base_url() ?>js/jquery.blockUI.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.maskedinput.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo base_url()?>js/jquery.numeric.js"></script>
    <script src="<?php echo base_url()?>assets/apps/js/apps.js"></script>
    <script src="<?php echo base_url()?>assets/apps/js/basic.js"></script>
    <script src="<?php echo base_url()?>js/underscore.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?php echo base_url('/') ?>css/styles.css" rel="stylesheet" />
    <script type="text/javascript" charset="utf-8">
        var site_url = '<?php echo site_url() ?>';
        var base_url = '<?php echo base_url() ?>';
        var user_id = '<?php echo $this->session->userdata('id') ?>';
        var user_name = '<?php echo $this->session->userdata('fullname') ?>';
        var year = '<?php echo date('Y') + 543; ?>'
        var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
    </script>
</head>

<body id="page-top">
    <!-- Navigation-->
    <?php echo $header_for_layout ?>
    <!-- Masthead-->


    <!-- Contact Section-->
    <section class="page-section" id="contact">
        <div class="container">
            <?php echo $content_for_layout ?>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container">
            <?php echo $footer_for_layout ?>
        </div>
    </footer>
    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright &copy; Dechachit@สารคามพร้อม.com 2022</small></div>
    </div>
    <!-- Portfolio Modals-->

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?php echo base_url('/') ?>js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>