<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">

    <title><?= $title ?? "Sistema" ?></title>

    <link type="text/css" rel="stylesheet" href="<?= asset("vendor/sweetalert2/dist/sweetalert2.min.css") ?>">
    <link type="text/css" rel="stylesheet" href="<?= asset("vendor/notyf/notyf.min.css") ?>">
    <link type="text/css" rel="stylesheet" href="<?= asset("css/volt.css") ?>">
    <link rel="stylesheet" href="<?= asset("css/app.css") ?>">

    <script src="<?= asset("vendor/@popperjs/core/dist/umd/popper.min.js") ?>"></script>
    <script src="<?= asset("vendor/bootstrap/dist/js/bootstrap.min.js") ?>"></script>
    <script src="<?= asset("vendor/onscreen/dist/on-screen.umd.min.js") ?>"></script>
    <script src="<?= asset("vendor/nouislider/distribute/nouislider.min.js") ?>"></script>
    <script src="<?= asset("vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js") ?>"></script>
    <script src="<?= asset("vendor/chartist/dist/chartist.min.js") ?>"></script>
    <script src="<?= asset("vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js") ?>"></script>
    <script src="<?= asset("vendor/vanillajs-datepicker/dist/js/datepicker.min.js") ?>"></script>
    <script src="<?= asset("vendor/sweetalert2/dist/sweetalert2.all.min.js") ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <!-- Vanilla JS Datepicker -->
    <script src="<?= asset("vendor/vanillajs-datepicker/dist/js/datepicker.min.js") ?>"></script>
    <script src="<?= asset("vendor/notyf/notyf.min.js") ?>"></script>
    <script src="<?= asset("vendor/simplebar/dist/simplebar.min.js") ?>"></script>
    <script async defer="defer" src="https://buttons.github.io/buttons.js"></script>
</head>

<body>
    <?php view("Layouts.Shared.Components.Sidebar") ?>
    <main class="content">
        <?php view("Layouts.Shared.Components.Navbar") ?>