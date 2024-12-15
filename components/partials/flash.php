<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    // Flash error
    <?php if (has_session('error')): ?>
        toastr.error('<?= htmlspecialchars(session('error')) ?>', 'Error');
    <?php endif; ?>

    // Flash success
    <?php if (has_session('success')): ?>
        toastr.success('<?= htmlspecialchars(session('success')) ?>', 'Success');
    <?php endif; ?>

    // Flash warning
    <?php if (has_session('warning')): ?>
        toastr.warning('<?= htmlspecialchars(session('warning')) ?>', 'Warning');
    <?php endif; ?>

    // Flash info
    <?php if (has_session('info')): ?>
        toastr.info('<?= htmlspecialchars(session('info')) ?>', 'Info');
    <?php endif; ?>
</script>