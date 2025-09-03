<?php $all_method =&get_instance();
?>
<style type="text/css">
    table{
        width: 100%;
        margin-bottom: 20px;
		border-collapse: collapse;
    }
    table, th, td{
        border: 1px solid #cdcdcd;
    }
    table th, table td{
        padding: 10px;
        text-align: left;
    }
    [type="radio"]:not(:checked)+label:before, [type="radio"]:not(:checked)+label:after, [type="radio"]:checked+label:after, [type="radio"]:checked+label:before{display:none!important;}
    [type="radio"]:not(:checked), [type="radio"]:checked { position: relative!important; left: 0!important; opacity: 1!important; }
    [type="radio"]:not(:checked)+label, [type="radio"]:checked+label{padding-left:0px!important;}
    input[type="submit"]{display:none;}
    input[type="text"], input[type="number"], input[type="date"], textarea{
        pointer-events: none;
    }
</style>

<div class="col-md-12">
  <!-- Advanced Tables -->
  <div class="card">
    <div class="card-action"><h3>Discharge form</h3></div>
      <div class="clearfix"></div>
    <div class="card-content">
        <?php
            $whtname = "";
            $whtname = str_replace("_", ' ', $formname);
        ?>
		<input type='button' id='btn' value='Print' class="btn btn-primary pull-right" onclick='printDiv();'>
    	<input type='button' id='btn' value='Send to Patient' class="btn btn-primary pull-right" onclick='sendonwhatsapp("<?php echo $whtname; ?>");'>
    	<!--<input type='button' id='btn' value='Stickers' class="btn btn-primary pull-right" onclick='printDiv2()'>-->
		<p id="whatsappmessg" style="display:none;"></p>
       <div class="row" id="">
           <?php $this->load->view('discharge-forms/'.$formname);  ?>
      </div>
	  </div>
    </div>
  </div>
  <!--End Advanced Tables -->
</div>

<script>
function printDiv() 
{
  $('.hide_print').hide();
  $('input[type="submit"]').css('visibility', 'hidden');
  $('p#last_updated').css('visibility', 'hidden');
  var divToPrint=document.getElementById('print_this_section');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
  window.location.reload();
}

function printDiv2() 
{
  $('.hide_print').hide();
  $('input[type="submit"]').css('visibility', 'hidden');
  $('p#last_updated').css('visibility', 'hidden');
  var divToPrint=document.getElementById('print_this_section2');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
//   setTimeout(function(){newWin.close();},10);
//   window.location.reload();
}

function sendonwhatsapp(whtname) 
{
    $('.hide_print').hide();
    $('input[type="submit"]').css('display', 'none');
    $('p#last_updated').css('visibility', 'hidden');
    var data = {'formname':whtname,'iic_id':<?php echo $iic_id; ?>, 'html': $("#print_this_section").html()};
    $('#whatsappmessg').hide();
	$.ajax({
		url: '<?php echo base_url('accounts/htmltopdf')?>',
		data: data,
		dataType: 'json',
		method:'post',
		success: function(data)
		{
		    if(data.status == 1){
                $('#whatsappmessg').empty().append('<?php echo ucwords($whtname); ?> has been to patient!');
		    }else{
		        $('#whatsappmessg').empty().append('Oops, something went wrong!');
		    }
		    $('#whatsappmessg').show();
		} 
	});
}
</script>