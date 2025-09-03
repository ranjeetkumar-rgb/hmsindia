     <!-- Bootstrap Core Js -->
     <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
     <script>
         $( function() {
            $( "#particular_date_filter" ).datepicker({
        			dateFormat: 'yy-mm-dd',
        			changeMonth: true,
        			changeYear: true,
        			onSelect: function(dateStr) {
        				$('#loader_div').show();				
        				var startDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker('getDate'));
        				var data = {appointment_date:startDate, type:'particular_date_filter'};
        				appointment_filter(data);
        			}
        		});
        });
     </script>
</body>
</html>