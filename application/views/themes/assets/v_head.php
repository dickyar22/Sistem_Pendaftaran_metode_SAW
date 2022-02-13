<?php
if(isset($ASSETS)){
	if(in_array('jquery',$ASSETS)){
	?>
		<!-- jQuery -->
		<script type="text/javascript" src="{BASE_URL}themes/assets/jquery/jquery-3.4.1.min.js"></script>
		<!-- jQuery Migrate -->
		<script type="text/javascript" src="{BASE_URL}themes/assets/jquery/jquery-migrate-3.1.0.min.js"></script>
	<?php
	}
	
	if(in_array('font_awesome',$ASSETS)){
	?>
		<!-- Font Awesome -->
		<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/font_awesome/css/font-awesome.min.css">
	<?php
	}

	if(in_array('bootstrap',$ASSETS)){
	?>
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/bootstrap/css/bootstrap.min.css">
	<?php
	}

	if(in_array('datatables',$ASSETS)){
	?>
		<!-- DataTables -->
		<!-- <link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/datatables/media/css/jquery.dataTables.min.css"> -->
		<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/datatables/media/css/dataTables.bootstrap4.css">
		<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/datatables/extensions/Responsive/css/responsive.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css">
		<!-- <link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/datatables/extensions/Buttons/css/buttons.bootstrap4.min.css"> -->
	<?php
	}

	if(in_array('venobox',$ASSETS)){
	?>
		<!-- Venobox -->
		<link rel="stylesheet" type="text/css" media="screen" href="{BASE_URL}themes/assets/venobox/venobox.css">
	<?php
	}

	if(in_array('datepicker',$ASSETS)){
	?>
		<!-- Date Picker -->
		<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/datepicker/bootstrap-datepicker3.min.css">
	<?php
	}

	if(in_array('timepicker',$ASSETS)){
	?>
		<!-- Time Picker -->
		<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/timepicker/bootstrap-timepicker.min.css">
	<?php
	}

	if(in_array('datetimepicker',$ASSETS)){
	?>
		<!-- DateTime Picker -->
		<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/datetimepicker/css/icon.css">
		<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/datetimepicker/css/ripples.min.css">
		<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/datetimepicker/css/bootstrap-material-datetimepicker.css">
	<?php
	}

	if(in_array('select2',$ASSETS)){
	?>
		<!-- Select2 -->
		<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/select2/css/select2.min.css">
		<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/select2/select2-bootstrap.css">
	<?php
	}

	if(in_array('dropzonejs',$ASSETS)){
	?>
		<!-- Dropzonejs -->
		<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/dropzonejs/min/dropzone.min.css">
		<!-- Dropzonejs -->
		<script type="text/javascript" src="{BASE_URL}themes/assets/dropzonejs/min/dropzone.min.js"></script>
		<!-- <script>
			Dropzone.options.fileupload = {
				acceptedFiles: "application/pdf",
				maxFilesize: 20,
				maxFiles: 10,
				parallelUploads: 10,
				addRemoveLinks: true,
				autoProcessQueue: false,
				init: function()
				{
					var submitButton = document.querySelector("#start_upload")
					myDropzone = this;
					submitButton.addEventListener("click", function()
					{
						myDropzone.processQueue();
					});
				}
			};
			$("#clear").click(function()
			{
				Dropzone.forElement("#fileupload").removeAllFiles(true);
			});
		</script> -->
	<?php
	}

	if(in_array('captcha',$ASSETS)){
	?>
		<!-- Captcha -->
		<link rel="stylesheet" type="text/css" href="{BASE_URL}themes/assets/captcha/captcha.css">
	<?php
	}

	if(in_array('g-recaptcha',$ASSETS)){
		?>
			<!-- Captcha -->
			<script src="https://www.google.com/recaptcha/api.js"></script>
		<?php
		}

	if(in_array('modal_detail',$ASSETS)){
	?>
		<script type="text/javascript">
			function modal_detail(html="",id){
				$.ajax({
					type: "POST",
					url: "{BASE_URL}api/html/"+html,
					data: {id:id},
					success: function(result){
						$(".modal_detail").html('Loading ...');
						$("#modal_detail").modal("show");
						$(".modal_detail").html(result);
					}
				});
			}
		</script>
	<?php
	}

	if(in_array('form_event',$ASSETS)){
	?>
		<script type="text/javascript">
			function select_list(html="",to,id,val=""){
				$.ajax({
					type: "POST",
					url: "{BASE_URL}api/html/"+html,
					data: {id:id,val:val},
					success: function(result){
						$("#"+to).val(null).trigger("change");  
						$("#"+to).html(result);
					}
				});
			}

			function unique(html="",id,val){
				$.ajax({
					type: "POST",
					url: "{BASE_URL}api/html/"+html,
					data: {val:val},
					success: function(result){  
						$("#"+id+"_message").html(result);
					}
				});
			}

			function input_confirm(id,value,id_parent){
				var parent = document.getElementById(id_parent).value;
				if(parent!=value){
					$('#'+id+'_message').html('<i style="color: red;">'+id_parent+' is not the same !</i>');
					document.getElementById(id).value = '';
				}
				else{
					$('#'+id+'_message').html('');
				}
			}

			function change(form,i,j){
				var input1 = document.getElementById("input_"+i+"_"+j);
				var input2 = document.getElementById("input_"+j+"_"+i);
				var hasil = 1/input1.value
				input2.value = hasil.toFixed(3)
			}

			function print_call(id) {
				var printContents = document.getElementById(id).innerHTML;
				var originalContents = document.body.innerHTML;
				document.body.innerHTML = "<html><head><title>Sistem Pendukung Keputusan Siswa Berprestasi SMA YADIKA 3</title><style>.box.box-solid.box-primary{border: 0px solid #3c8dbc;}table th, table td {font-size:12px;}</style></head><body>" + printContents + "</b" + "<body>";
				window.print();
				document.body.innerHTML = originalContents;
			}
		</script>
	<?php
	}

	if(in_array('api',$ASSETS)){
	?>
		<script type="text/javascript">
			function html(html="",to,data){
				$.ajax({
					type: "POST",
					url: "{BASE_URL}api/html/"+html,
					data: data,
					success: function(result){
						$("#"+to).html(result);
						$(".select2").select2({
							theme: "bootstrap",
							width: "100%"
						});
					}
				});
			}

			function append(html="",to,data){
				$.ajax({
					type: "POST",
					url: "{BASE_URL}api/html/"+html,
					data: data,
					success: function(result){
						$("#"+to).append(result);
						$(".select2").select2({
							theme: "bootstrap",
							width: "100%"
						});
					}
				});
			}

			function after(html="",to,data){
				$.ajax({
					type: "POST",
					url: "{BASE_URL}api/html/"+html,
					data: data,
					success: function(result){
						var after = '<div class="'+to+'">'+result+'</div>';
						$('body').find('.'+to+':last').after(after);
						$(".select2").select2({
							theme: "bootstrap",
							width: "100%"
						});
					}
				});
			}
		</script>
	<?php
	}

	if(in_array('disable_event',$ASSETS)){
	?>
		<script type="text/javascript">
			/* Disable Right Click Mouse */
			document.addEventListener("contextmenu", function(e){
				e.preventDefault();
			}, false);

			/* Disable Keyboard Shortcut, View Source dll */
			window.addEventListener("keydown",function(e){
				if(e.ctrlKey && (e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){
					e.preventDefault();
				}
			});
			document.keypress = function(e){
				if(e.ctrlKey && (e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){

				}
				return false
			}
			/* Protect The Article */
			document.onkeydown = function(e){
				e=e||window.event;
				if(e.keyCode==123||e.keyCode==18){
					return false;
				}
			}

			/* Disable Selection, Block Text */
			function disableSelection(e){
				if(typeof e.onselectstart!="undefined"){
					e.onselectstart=function(){
						return false;
					};
				}
				else if(typeof e.style.MozUserSelect!="undefined"){
					e.style.MozUserSelect="none";
				}
				else{
					e.onmousedown=function(){
						return false;
					};
				}
					
				e.style.cursor="default"
			}
			window.onload=function(){
				disableSelection(document.body)
			}
		</script>
	<?php
	}

	if(in_array('addrow',$ASSETS)){
	?>
		<script type="text/javascript">
			$(document).ready(function(){
				//group add limit
				var maxGroup = 10;
				
				//add more fields group
				$(".addMore").click(function(){
					if($('body').find('.fieldGroup').length < maxGroup){
						var fieldHTML = '<div class="fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
						$('body').find('.fieldGroup:last').after(fieldHTML);
					}
					else{
						alert('Maximum '+maxGroup+' groups are allowed.');
					}
				});
				
				//remove fields group
				$("body").on("click",".remove",function(){ 
					$(this).parents(".fieldGroup").remove();
				});
			});
		</script>
	<?php
	}

	if(in_array('countdown',$ASSETS)){
	?>
		<script type="text/javascript">
			function countdown(date){
				
				var deadline = new Date(date).getTime();  
				var x = setInterval(function() { 
					var now = new Date().getTime(); 
					var t = deadline - now; 
					var days = Math.floor(t / (1000 * 60 * 60 * 24)); 
					var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60)); 
					var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60)); 
					var seconds = Math.floor((t % (1000 * 60)) / 1000); 
					document.getElementById("countdown").innerHTML = hours + "h " + minutes + "m " + seconds + "s "; 
					if (t < 0) { 
						clearInterval(x); 
						document.getElementById("countdown").innerHTML = "EXPIRED"; 
						$('.soal').attr('readonly', true);
						$('.soal').attr('required', false);
						$(':radio:not(:checked)').attr('disabled', true);
					} 
				}, 1000); 
			}
		</script>
	<?php
	}

	if(in_array('chat',$ASSETS)){
	?>
		<link type="text/css" rel="stylesheet" media="all" href="{BASE_URL}themes/assets/chat/css/chat.css">
	<?php
	}
}
?>

<style>
.center{
	text-align: center;
}
</style>