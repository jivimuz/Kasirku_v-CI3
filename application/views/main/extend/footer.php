</div>
</main>
</body>
<h6 class="text-right p-2"> Jivi MG <i class="fa fa-copyright"></i> <?= date('Y')?> &nbsp;&nbsp;&nbsp;</h6>

<script>
function printIni(){
		window.print();
}


$(document).ready(function(){
  $('.app-sidebar__toggle').on('click', function(){
    $('.app').toggleClass('sidenav-toggled');
  });
});

$(document).ready(function(){
	
	$('#tabelKu').DataTable({

	"bLengthChange": true,
	"bInfo": true,
	"bPaginate": true,
	"bFilter": true,
	"bSort": true,
	"pageLength": 10
	});
	
});
</script>
<script type="text/javascript" src="<?=base_url('assets/')?>js/jquery.dataTables.min.js"></script>
