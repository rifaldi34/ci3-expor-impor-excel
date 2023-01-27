    <?php if ($this->session->has_userdata('custom_error')) { ?>
      <script>
        jQuery(document).ready(function($) {

          "use strict";

          Swal.fire({
            title: 'Proses Gagal',
            icon: 'error',
            html: '<?= $this->session->userdata('custom_error') ?>',
            showCancelButton: false,
            confirmButtonText: 'Tutup'
          });

        });
      </script>
    <?php $this->session->unset_userdata('custom_error');} ?>

    <?php if ($this->session->has_userdata('custom_success')) { ?>
      <script>
        jQuery(document).ready(function($) {

          "use strict";

          Swal.fire({
            title: 'Proses Berhasil',
            icon: 'success',
            html: '<?= $this->session->userdata('custom_success') ?>',
            showCancelButton: false,
            confirmButtonText: 'Tutup'
          });

        });
      </script>
    <?php $this->session->unset_userdata('custom_success');} ?>

  </body>
</html>