<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coupons</title>
    <link href="<?php echo $assets ?>styles/theme.css" rel="stylesheet">
    <link href="<?php echo $assets ?>styles/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $assets ?>styles/custome.css" rel="stylesheet">

</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <a href="#" id="pdf" class="tip" title="<?= lang('download_pdf') ?>">
                <i class="icon fa fa-file-pdf-o"></i> <?= lang('download_pdf') ?>
            </a>
        </div>
    </div>
    <?php
    $coupons = $this->sales_model->getALLCouponData();
    foreach ($coupons as $coupon) { ?>
        <img width="105px" src="<?= base_url() ?>assets/uploads/<?= $coupon->code ?>.png" alt="<?= $coupon->code ?>"/>
    <?php } ?>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#pdf').click(function (event) {
            event.preventDefault();
            window.location.href = "<?=site_url('sales/print_preview_coupon/pdf')?>";
            return false;
        });
    });
</script>
</body>
</html>