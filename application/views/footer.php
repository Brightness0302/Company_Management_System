  <style type="text/css">
      table.dataTable>thead .sorting::before,
       table.dataTable>thead .sorting_asc::before,
       table.dataTable>thead .sorting_desc::before,
       table.dataTable>thead .sorting_asc_disabled::before,
       table.dataTable>thead .sorting_desc_disabled::before {
          right: 0;
          content: "";
      }
       
       table.dataTable>thead .sorting::after,
       table.dataTable>thead .sorting_asc::after,
       table.dataTable>thead .sorting_desc::after,
       table.dataTable>thead .sorting_asc_disabled::after,
       table.dataTable>thead .sorting_desc_disabled::after {
          right: 0;
          content: "";
      }
       
       table.dataTable>thead>tr>th:not(.sorting_disabled),
       table.dataTable>thead>tr>td:not(.sorting_disabled) {
          padding-right: 4px;
          padding-left: 4px;
      }
       
       table.dataTable>thead>tr>th,
       table.dataTable>thead>tr>td {
          padding-right: 4px;
          padding-left: 4px;
      }
  </style>
  <!-- Vendor JS Files -->
  <script src="<?php echo base_url('assets/vendor/purecounter/purecounter_vanilla.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/aos/aos.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/glightbox/js/glightbox.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/isotope-layout/isotope.pkgd.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/swiper/swiper-bundle.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/php-email-form/validate.js'); ?>"></script>

  <script src="<?php echo base_url('assets/vendor/quill/quill.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/simple-datatables/simple-datatables.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/tinymce/tinymce.min.js'); ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url('assets/js/dashboardmain.js'); ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/style.js'); ?>"></script>
  </body>
  <script type="text/javascript">
    //Save companyname with session
    function SaveCompanyNameUsingSession(companyname) {
      const form_data = {
        companyname: companyname
      };
      $.ajax({
          url: "<?=base_url('home/savecompanynameusingsession')?>",
          method: "POST",
          data: form_data,
          dataType: 'text',
          async: true,
          success: function(res) {
          }
      });
    }
    //Save username with session
    function SaveUserNameUsingSession(username) {
      const form_data = {
        username: username
      };
      $.ajax({
          url: "<?=base_url('home/saveusernameusingsession')?>",
          method: "POST",
          data: form_data,
          dataType: 'text',
          async: true,
          success: function(res) {
          }
      });
    }
    //Save clientname with session
    function SaveClientNameUsingSession(clientname) {
      const form_data = {
        clientname: clientname
      };
      $.ajax({
          url: "<?=base_url('home/saveclientnameusingsession')?>",
          method: "POST",
          data: form_data,
          dataType: 'text',
          async: true,
          success: function(res) {
          }
      });
    }
    //Save projectname with session
    function SaveProjectNameUsingSession(projectname) {
      const form_data = {
        projectname: projectname
      };
      $.ajax({
          url: "<?=base_url('home/saveprojectnameusingsession')?>",
          method: "POST",
          data: form_data,
          dataType: 'text',
          async: true,
          success: function(res) {
          }
      });
    }
  </script>
  </html>