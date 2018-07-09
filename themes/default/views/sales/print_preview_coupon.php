<style type="text/css">
    @media print {
        .modal {
            position: relative;
        }

        .modal-dialog {
            width: 99% !important;
        }

        .modal-content {
            border: none !important;
        }

    }
</style>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-body">
            <?php

            $coupons = $this->sales_model->getALLCouponData();

            foreach ($coupons as $coupon) { ?>
                <?php $this->erp->qrcode('link', urlencode(site_url('sales/view/' . $inv->id)), 2); ?>
                <img width="105px" src="<?= base_url() ?>assets/uploads/<?= $coupon->code ?>.png"
                     alt="<?= $coupon->code ?>"/>
            <?php } ?>
        </div>
    </div>

</div>

<script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<?= $modal_js ?>