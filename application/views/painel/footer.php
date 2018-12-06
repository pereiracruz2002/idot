      </div>
    </div>
  </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>painel-assets/js/cidades-estados-1.2-utf8.js"></script>
    <script src="<?php echo base_url() ?>painel-assets/js/mask.js"></script>
    <script src="<?php echo base_url() ?>painel-assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>painel-assets/fancybox/jquery.fancybox.pack.js"></script>
    <script src="<?php echo base_url() ?>painel-assets/js/utility.js"></script>
    <?php if (file_exists(FCPATH.'painel-assets/js/'.$this->uri->segment(2).'.js')): ?>
    <script src="<?php echo base_url() ?>painel-assets/js/<?php echo $this->uri->segment(2) ?>.js"></script>
    <?php endif; ?>
  </body>
</html>

