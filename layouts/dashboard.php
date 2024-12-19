<?php
admin_only();
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <title><?= ucwords($title) ?? '' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Datatable css -->
    <link href="/assets/hyper/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/hyper/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />


    <!-- Theme Config Js -->
    <script src="/assets/hyper/js/hyper-config.js"></script>

    <!-- App css -->
    <link href="/assets/hyper/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="/assets/hyper/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        <?= component('partials/dashboard/topbar') ?>
        <!-- ========== Topbar End ========== -->

        <!-- ========== Left Sidebar Start ========== -->
        <?= component('partials/dashboard/left_sidebar') ?>
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">

                                </div>
                                <h4 class="page-title"><?= ucwords($title) ?? '' ?></h4>
                            </div>
                        </div>
                    </div>
                    <!-- start page title -->
                    <?= $content ?>
                    <!-- end page title -->

                </div> <!-- container -->

            </div> <!-- content -->


        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->


    <!-- Vendor js -->
    <script src="/assets/hyper/js/vendor.min.js"></script>

    <!-- Datatable js -->
    <script src="/assets/hyper/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/hyper/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/hyper/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/hyper/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="/assets/hyper/vendor/jquery-datatables-checkboxes/js/dataTables.checkboxes.min.js"></script>


    <!-- App js -->
    <script src="/assets/hyper/js/app.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        $(document).ready(function() {
            "use strict";
            $("#products-datatable").DataTable({
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    },
                    info: "Showing products _START_ to _END_ of _TOTAL_",
                    lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> products'
                },
                pageLength: 5,
                select: {
                    style: "multi"
                },
                order: [
                    [1, "asc"]
                ],
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded"), $("#products-datatable_length label").addClass("form-label"), document.querySelector(".dataTables_wrapper .row").querySelectorAll(".col-md-6").forEach(function(e) {
                        e.classList.add("col-sm-6"), e.classList.remove("col-sm-12"), e.classList.remove("col-md-6")
                    })
                }
            })
        });
    </script>

    <?= component('partials/flash') ?>
</body>


</html>