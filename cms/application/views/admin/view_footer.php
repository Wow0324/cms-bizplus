		</div>

	</div>


	<script src="<?php echo base_url(); ?>public/admin/js/jquery-3.5.1.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/select2.full.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jscolor.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.inputmask.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.inputmask.date.extensions.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.inputmask.extensions.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/bootstrap-timepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/icheck.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/fastclick.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.fancybox.pack.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/app.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/demo.js"></script>


	<script>
	(function($) {

		"use strict";

	    //Initialize Select2 Elements
	    $(".select2").select2();

	    // Ckeditor
    	CKEDITOR.replaceAll( 'editor' );

	    //Datemask dd/mm/yyyy
	    $("#datemask").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	    //Datemask2 mm/dd/yyyy
	    $("#datemask2").inputmask("mm-dd-yyyy", {"placeholder": "mm-dd-yyyy"});
	    //Money Euro
	    $("[data-mask]").inputmask();

	    //Date picker
	    $('.datepicker').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd',
	      todayBtn: 'linked',
	    });
	    $('#datepicker').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd',
	      todayBtn: 'linked',
	    });

	    $('#datepicker1').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd',
	      todayBtn: 'linked',
	    });

	    $('#datepicker2').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd',
	      todayBtn: 'linked',
	    });

	    $('.timepicker').timepicker({
	      	showInputs: false
	    });

	    //iCheck for checkbox and radio inputs
	    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	      checkboxClass: 'icheckbox_minimal-blue',
	      radioClass: 'iradio_minimal-blue'
	    });
	    //Red color scheme for iCheck
	    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
	      checkboxClass: 'icheckbox_minimal-red',
	      radioClass: 'iradio_minimal-red'
	    });
	    //Flat red color scheme for iCheck
	    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	      checkboxClass: 'icheckbox_flat-green',
	      radioClass: 'iradio_flat-green'
	    });


	    $("#example1").DataTable();
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false
	    });

	    $('#confirm-delete').on('show.bs.modal', function(e) {
	      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	    });

	})(jQuery);        
    </script>

    
</body>
</html>