

    <!--   Core JS Files   -->
    <script src="/assets/admin/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="/assets/admin/js/bootstrap.min.js" type="text/javascript"></script>
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="/assets/admin/js/bootstrap-checkbox-radio-switch.js"></script>

    <!--  Charts Plugin -->
    <script src="/assets/admin/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="/assets/admin/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="/assets/admin/js/light-bootstrap-dashboard.js"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="/assets/admin/js/demo.js"></script>

    <script src="/assets/admin/js/tinymce/tinymce.min.js"></script>

    <script src="/assets/admin/js/util.js"></script>

    <script type="text/javascript">
        // $(document).ready(function(){

        //     demo.initChartist();

        //     $.notify({
        //         icon: 'pe-7s-gift',
        //         message: "Bem Vindo ao painel do sistema <b>IDOT</b>"

        //     },{
        //         type: 'info',
        //         timer: 4000
        //     });

        // });
        $(document).ready(function () { 
            var $seuCampoCpf = $(".matricula");
                $seuCampoCpf.mask('00/00/0000-000', {reverse: true});
        });
    </script>
<?php
if (isset($jsFiles)):
    foreach ($jsFiles as $v):
        ?>
        <?php if (strpos($v, 'http') === 0):  ?>
            <script src="<?php echo $v ?>"></script>
        <?php else: ?>
            <script src="<?php echo base_url() ?>assets/admin/js/<?php echo $v ?>?c=<?php echo uniqid() ?>"></script>
        <?php endif; ?>
        <?php
    endforeach;
endif;
?>
<?php if (file_exists(FCPATH . 'assets/admin/js/' . $this->uri->segment(2) . '.js')): ?>
    <script src="<?php echo base_url() ?>assets/admin/js/<?php echo $this->uri->segment(2) ?>.js?c=<?php echo uniqid() ?>"></script>
<?php endif; ?>
</body>
</html>

