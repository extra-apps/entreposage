<script src="<?= base_url('assets/') ?>vendor/jquery-3.2.1.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap-4.1/popper.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap-4.1/bootstrap.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/slick/slick.min.js">
</script>
<script src="<?= base_url('assets/') ?>vendor/wow/wow.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/animsition/animsition.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="<?= base_url('assets/') ?>vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="<?= base_url('assets/') ?>vendor/circle-progress/circle-progress.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?= base_url('assets/') ?>vendor/chartjs/Chart.bundle.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/select2/select2.min.js">
</script>
<script src="<?= base_url('assets/') ?>js/main.js"></script>
<script>
    $(function() {
        var current_url = location.href;
        var cu = current_url.split("?");
        current_url = cu[0];
        $(`a[href='${current_url}']`).closest("li").addClass("active");
        // $(".table").DataTable({
        //     dom: "lBfrtip",
        //     buttons: ["excel", "pdf", "print"],
        //     pageLength: 50,
        //     lengthMenu: [
        //         [10, 25, 50, 100, -1],
        //         [10, 25, 50, 100, "All"],
        //     ],
        // });
    })
</script>