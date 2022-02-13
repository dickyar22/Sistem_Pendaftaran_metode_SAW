<?php
if(isset($ASSETS)){
	if(in_array('bootstrap',$ASSETS)){
	?>
		<!-- Bootstrap -->
		<script type="text/javascript" src="{BASE_URL}themes/assets/bootstrap/js/bootstrap.min.js"></script>
		<!-- <script type="text/javascript" src="{BASE_URL}themes/assets/bootstrap/js/bootstrap.bundle.min.js"></script> -->
	<?php
	}

	if(in_array('datatables',$ASSETS)){
	?>
		<!-- DataTables -->
		<script type="text/javascript" src="{BASE_URL}themes/assets/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="{BASE_URL}themes/assets/datatables/media/js/dataTables.bootstrap4.min.js"></script>
		<script type="text/javascript" src="{BASE_URL}themes/assets/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
		<!-- <script type="text/javascript" src="{BASE_URL}themes/assets/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="{BASE_URL}themes/assets/datatables/extensions/Buttons/js/buttons.bootstrap4.min.js"></script>
		<script type="text/javascript" src="{BASE_URL}themes/assets/datatables/extensions/Buttons/js/buttons.colVis.min.js"></script>
		<script type="text/javascript" src="{BASE_URL}themes/assets/datatables/extensions/JSZip/jszip.min.js"></script>
		<script type="text/javascript" src="{BASE_URL}themes/assets/datatables/extensions/pdfmake/pdfmake.min.js"></script>
		<script type="text/javascript" src="{BASE_URL}themes/assets/datatables/extensions/pdfmake/vfs_fonts.js"></script>
		<script type="text/javascript" src="{BASE_URL}themes/assets/datatables/extensions/Buttons/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="{BASE_URL}themes/assets/datatables/extensions/Buttons/js/buttons.print.min.js"></script> -->

		<script type="text/javascript">
			$(document).ready(function () {
				// Table Default
				$('table.datatable').DataTable();

				// Table Data Custom Show Entries
				$('table.datatables').DataTable({
					// Dom Position
					dom: '<"row"<"col-sm-3"f><"col-sm-6 text-center"B><"col-sm-3"l>>'+
						'<"row"<"col-sm-12"tr>>' +
						'<"row"<"col-sm-6"i><"col-sm-6"p>>',
					// Buttons
					buttons: 
					[
						'colvis',
						'copy','csv','excel','pdf','print'
					],
					// Show Entries
					lengthMenu: [[10,25,50,100,-1],[10,25,50,100,"All"]],
					pageLength: 25,
					// responsive: true,
					scrollX: true,
					// scrollY: '100vh',
					// scrollCollapse: true,
					//order: [[1, "desc"]],
				});

				$('table.datatablesAll').DataTable({
					// Dom Position
					dom: '<"row"<"col-sm-3"f><"col-sm-6 text-center"B><"col-sm-3"l>>'+
						'<"row"<"col-sm-12"tr>>' +
						'<"row"<"col-sm-6"i><"col-sm-6"p>>',
					// Buttons
					buttons: 
					[
						'colvis',
						'copy','csv','excel','pdf','print'
					],
					// Show Entries
					lengthMenu: [[10,25,50,100,-1],[10,25,50,100,"All"]],
					pageLength: -1,
					// responsive: true,
					scrollX: true,
					// scrollY: '100vh',
					// scrollCollapse: true,
					//order: [[1, "desc"]],
				});

				// Table Custom 2
				$('table.datatable2').DataTable({
					paging: false,
					lengthChange: false,
					searching: false,
					ordering: true,
					info: false,
					autoWidth: false
				});
			});
		</script>
	<?php
	}

	if(in_array('venobox',$ASSETS)){
	?>
		<!-- Venobox -->
		<script type="text/javascript" src="{BASE_URL}themes/assets/venobox/venobox.min.js"></script>
		<script>
			/* $(document).ready(function(){
				$('.venobox').venobox(); 
			}); */

			$('.venobox').venobox({
				framewidth: '',		// default: ''
				frameheight: '',    // default: ''
				border: '2px',      // default: '0'
				bgcolor: '#fff',    // default: '#fff'
				titleattr: 'Image', // default: 'title'
				numeratio: true,    // default: false
				infinigall: true    // default: false
			});
		</script>
	<?php
	}

	if(in_array('form_validation',$ASSETS)){
	?>
		<!-- Form validation -->
		<script type="text/javascript" src="{BASE_URL}themes/assets/jquery_validation/jquery.validate.js"></script>
		<script type="text/javascript">
			$().ready(function() {
				$("#commentForm").validate();
				$("#commentForm1").validate();
				$("#commentForm2").validate();
				$("#commentForm3").validate();
				$("#commentForm4").validate();
				$("#commentForm5").validate();
			});

			function number(evt){
				var charCode = (evt.which) ? evt.which : event.keyCode
				if(charCode>31 && (charCode<48 || charCode>57))
					return false;
				return true;
			}

			function number_point(evt){
				var charCode = (evt.which) ? evt.which : event.keyCode
				if(charCode>31 && charCode!=46 && (charCode<48 || charCode>57))
					return false;
				return true;
			}
			
			function string(evt){
				var charCode = (evt.which) ? evt.which : event.keyCode
				if(charCode==34 || charCode==37 || charCode==39 || charCode==59 || charCode==61 || charCode==96)
					return false;
				return true;
			}

			function file_all(form,id){
				var input = document.getElementById(id);
				var path = input.value;
				var extensions = /(\.jpg|\.jpeg|\.png|\.gif|\.doc|\.docx|\.xls|\.xlsx|\.ppt|\.pptx|\.pdf|\.txt)$/i;
				var size = form.files[0].size/1024/1024;
				if(!extensions.exec(path)){
					alert('Image/Office/PDF files are only allowed !!!');
					input.value = '';
				}
				if(size>10){
					alert('File size exceeds 10 MB');
					input.value = '';
								
				}
				return false;
			}

			function file_office(form,id){
				var input = document.getElementById(id);
				var path = input.value;
				var extensions = /(\.ppt|\.pptx|\.pdf)$/i;
				var size = form.files[0].size/1024/1024;
				if(!extensions.exec(path)){
					alert('PDF/PPT files are only allowed !!!');
					input.value = '';
				}
				if(size>10){
					alert('File size exceeds 10 MB');
					input.value = '';
								
				}
				return false;
			}

			function file_img(form,id){
				var input = document.getElementById(id);
				var path = input.value;
				var extensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
				var size = form.files[0].size/1024/1024;
				if(!extensions.exec(path)){
					alert('Image files are only allowed !!!');
					input.value = '';
				}
				if(size>10){
					alert('File size exceeds 10 MB');
					input.value = '';
								
				}
				return false;
			}
		</script>
	<?php
	}

	if(in_array('datepicker',$ASSETS)){
	?>
		<!-- Date Picker -->
		<script type="text/javascript" src="{BASE_URL}themes/assets/datepicker/bootstrap-datepicker.min.js"></script>
		<script type="text/javascript">
			jQuery(function($) {
				// Class
				$('.datepicker').datepicker({
				autoclose: true,
				todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
				$(this).prev().focus();
				});
			});
		</script>
	<?php
	}

	if(in_array('timepicker',$ASSETS)){
	?>
		<!-- Time Picker -->
		<script type="text/javascript" src="{BASE_URL}themes/assets/timepicker/bootstrap-timepicker.min.js"></script>
		<script type="text/javascript">
			jQuery('.timepicker').timepicker({
				showMeridian : false
			});
			jQuery('.timepicker2').timepicker({
				defaultTIme : false
			});
			jQuery('.timepicker3').timepicker({
				minuteStep : 15
			});
		</script>
	<?php
	}

	if(in_array('datetimepicker',$ASSETS)){
	?>
		<!-- DateTime Picker -->
		<script type="text/javascript" src="{BASE_URL}themes/assets/datetimepicker/js/ripples.min.js"></script>
		<script type="text/javascript" src="{BASE_URL}themes/assets/datetimepicker/js/moment-with-locales.min.js"></script>
		<script type="text/javascript" src="{BASE_URL}themes/assets/datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
		<script type="text/javascript">
			$('.datepicker').bootstrapMaterialDatePicker
			({
				time: false,
				//clearButton: true,
				format: 'DD-MM-YYYY',
				//minDate : new Date(),
			});

			$('.timepicker').bootstrapMaterialDatePicker
			({
				date: false,
				shortTime: false,
				format: 'HH:mm'
			});
			

			$('.datetimepicker').bootstrapMaterialDatePicker
			({
				format: 'YYYY-MM-DD HH:mm',
				//minDate : new Date(),
			});

			$('#date-end').bootstrapMaterialDatePicker({ weekStart : 0 });
			$('#date-start').bootstrapMaterialDatePicker({ weekStart : 0 }).on('change', function(e, date)
			{
				$('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
			});
		</script>
	<?php
	}

	if(in_array('select2',$ASSETS)){
	?>
		<!-- Select2 -->
		<script type="text/javascript" src="{BASE_URL}themes/assets/select2/js/select2.min.js"></script>
		<script type="text/javascript">
			//$.fn.select2.defaults.set( "theme", "bootstrap" );
			$(".select2").select2({
				theme: "bootstrap",
				width: "100%"
			});
		</script>
	<?php
	}

	if(in_array('currency',$ASSETS)){
	?>
		<!-- Currency (Simple Money Format) -->
		<script type="text/javascript" src="{BASE_URL}themes/assets/currency/simple.money.format.js"></script>
		<script type="text/javascript">
			$('.currency').simpleMoneyFormat();
		</script>
	<?php
	}

	if(in_array('ckeditor',$ASSETS)){
	?>
		<!-- CKEditor Text Editor -->
		<script type="text/javascript" src="{BASE_URL}themes/assets/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="{BASE_URL}themes/assets/ckeditor/html5validation/plugin.js"></script>
		<script type="text/javascript">
			CKEDITOR.replace('ckeditor');
		</script>
	<?php
	}

	if(in_array('captcha',$ASSETS)){
	?>
		<!-- Captcha -->
		<script type="text/javascript">
			$(document).ready(function (){
				$("#commentForm").validate({
					rules: {
						captcha: {
							required: true,
							remote: {
								url: '{BASE_URL}themes/assets/captcha/verify-captcha.php',
								type: 'post',
								data: {
									username: function() {
										return $( '#captcha' ).val();
									}
								}
							}
						}
					},
					messages: {
						captcha: {
							remote: "Enter the correct text"
						}
					}
				});

				$('#refresh-captcha').click(function(){
					$('#captcha-image').attr('src', '{BASE_URL}themes/assets/captcha/generate-captcha.php?r=' + Math.random());
					return false;
				});
			});
		</script>
	<?php
	}

	if(in_array('highcharts',$ASSETS) && $this->session->userdata('ei_login')==TRUE){
	?>
		<!-- <script src="{BASE_URL}themes/assets/chart/highcharts.js"></script> -->
		<script src="{BASE_URL}themes/assets/highcharts/code/highcharts.js"></script>
		<script src="{BASE_URL}themes/assets/highcharts/code/modules/series-label.js"></script>
		<script src="{BASE_URL}themes/assets/highcharts/code/modules/exporting.js"></script>
		<script src="{BASE_URL}themes/assets/highcharts/code/modules/export-data.js"></script>
		<script type="text/javascript">
			Highcharts.chart('graph', {
				chart: {
					type: 'column'
				},
				title: {
					text: 'Graph'
				},

				subtitle: {
					text: ''
				},

				xAxis: {
					type: 'category'
				},

				yAxis: {
					min: 0,
					title: {
						text: 'Total'
					},
					labels: {
						format: '{value:,.0f}'
					},
				},
				tooltip: {
					headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y:,.0f}</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true,
				},
				plotOptions: {
					bar: {
						pointPadding: 0.2,
						borderWidth: 0,
						colorByPoint: true,
						grouping: false,
					},
					series: {
						//pointWidth: 20,
						borderWidth: 0,
						dataLabels: {
							enabled: true,
							format: '{point.y:,.0f}',
							style: {
								color: Highcharts.getOptions().colors[1]
							},
							/* formatter: function() {
									return this.y;
							}, */
						},
					},
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'middle'
				},
				series: [
					<?php
						echo $series;
					?>
				],

				responsive: {
					rules: [{
						condition: {
							maxWidth: 500
						},
						chartOptions: {
							legend: {
								layout: 'horizontal',
								align: 'center',
								verticalAlign: 'bottom'
							}
						}
					}]
				}

			});
		</script>
	<?php
	}

	if(in_array('chat',$ASSETS)){
	?>
		<!-- <script type="text/javascript" src="{BASE_URL}themes/assets/chat/js/chat.js"></script> -->
		<script type="text/javascript">
			var windowFocus = true;
			var username;
			var chatHeartbeatCount = 0;
			var minChatHeartbeat = 1000;
			var maxChatHeartbeat = 33000;
			var chatHeartbeatTime = minChatHeartbeat;
			var originalTitle;
			var blinkOrder = 0;

			var chatboxFocus = new Array();
			var newMessages = new Array();
			var newMessagesWin = new Array();
			var chatBoxes = new Array();

			$(document).ready(function(){
				originalTitle = document.title;
				startChatSession();

				$([window, document]).blur(function(){
					windowFocus = false;
				}).focus(function(){
					windowFocus = true;
					document.title = originalTitle;
				});
			});

			function restructureChatBoxes() {
				align = 0;
				for (x in chatBoxes) {
					chatboxtitle = chatBoxes[x];

					if ($("#chatbox_"+chatboxtitle).css('display') != 'none') {
						if (align == 0) {
							$("#chatbox_"+chatboxtitle).css('right', '20px');
						} else {
							width = (align)*(225+7)+20;
							$("#chatbox_"+chatboxtitle).css('right', width+'px');
						}
						align++;
					}
				}
			}

			function chatWith(chatuser) {
				createChatBox(chatuser);
				$("#chatbox_"+chatuser+" .chatboxtextarea").focus();
			}

			function createChatBox(chatboxtitle,minimizeChatBox) {
				if ($("#chatbox_"+chatboxtitle).length > 0) {
					if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
						$("#chatbox_"+chatboxtitle).css('display','block');
						restructureChatBoxes();
					}
					$("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
					return;
				}

				$(" <div />" ).attr("id","chatbox_"+chatboxtitle)
				.addClass("chatbox")
				.html('<div class="chatboxhead"><div class="chatboxtitle">'+chatboxtitle+'</div><div class="chatboxoptions"><a href="javascript:void(0)" onclick="javascript:toggleChatBoxGrowth(\''+chatboxtitle+'\')">-</a> <a href="javascript:void(0)" onclick="javascript:closeChatBox(\''+chatboxtitle+'\')">X</a></div><br clear="all"/></div><div class="chatboxcontent"></div><div class="chatboxinput"><textarea class="chatboxtextarea" onkeydown="javascript:return checkChatBoxInputKey(event,this,\''+chatboxtitle+'\');"></textarea></div>')
				.appendTo($( "body" ));
						
				$("#chatbox_"+chatboxtitle).css('bottom', '0px');
				
				chatBoxeslength = 0;

				for (x in chatBoxes) {
					if ($("#chatbox_"+chatBoxes[x]).css('display') != 'none') {
						chatBoxeslength++;
					}
				}

				if (chatBoxeslength == 0) {
					$("#chatbox_"+chatboxtitle).css('right', '20px');
				} else {
					width = (chatBoxeslength)*(225+7)+20;
					$("#chatbox_"+chatboxtitle).css('right', width+'px');
				}
				
				chatBoxes.push(chatboxtitle);

				if (minimizeChatBox == 1) {
					minimizedChatBoxes = new Array();

					if ($.cookie('chatbox_minimized')) {
						minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
					}
					minimize = 0;
					for (j=0;j<minimizedChatBoxes.length;j++) {
						if (minimizedChatBoxes[j] == chatboxtitle) {
							minimize = 1;
						}
					}

					if (minimize == 1) {
						$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
						$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
					}
				}

				chatboxFocus[chatboxtitle] = false;

				$("#chatbox_"+chatboxtitle+" .chatboxtextarea").blur(function(){
					chatboxFocus[chatboxtitle] = false;
					$("#chatbox_"+chatboxtitle+" .chatboxtextarea").removeClass('chatboxtextareaselected');
				}).focus(function(){
					chatboxFocus[chatboxtitle] = true;
					newMessages[chatboxtitle] = false;
					$('#chatbox_'+chatboxtitle+' .chatboxhead').removeClass('chatboxblink');
					$("#chatbox_"+chatboxtitle+" .chatboxtextarea").addClass('chatboxtextareaselected');
				});

				$("#chatbox_"+chatboxtitle).click(function() {
					if ($('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') != 'none') {
						$("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
					}
				});

				$("#chatbox_"+chatboxtitle).show();
			}


			function chatHeartbeat(){

				var itemsfound = 0;
				
				if (windowFocus == false) {
			
					var blinkNumber = 0;
					var titleChanged = 0;
					for (x in newMessagesWin) {
						if (newMessagesWin[x] == true) {
							++blinkNumber;
							if (blinkNumber >= blinkOrder) {
								document.title = x+' says...';
								titleChanged = 1;
								break;	
							}
						}
					}
					
					if (titleChanged == 0) {
						document.title = originalTitle;
						blinkOrder = 0;
					} else {
						++blinkOrder;
					}

				} else {
					for (x in newMessagesWin) {
						newMessagesWin[x] = false;
					}
				}

				for (x in newMessages) {
					if (newMessages[x] == true) {
						if (chatboxFocus[x] == false) {
							//FIXME: add toggle all or none policy, otherwise it looks funny
							$('#chatbox_'+x+' .chatboxhead').toggleClass('chatboxblink');
						}
					}
				}
				
				$.ajax({
				url: "{BASE_URL}themes/assets/chat/chat.php?action=chatheartbeat",
				cache: false,
				dataType: "json",
				success: function(data) {

					$.each(data.items, function(i,item){
						if (item)	{ // fix strange ie bug

							chatboxtitle = item.f;

							if ($("#chatbox_"+chatboxtitle).length <= 0) {
								createChatBox(chatboxtitle);
							}
							if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
								$("#chatbox_"+chatboxtitle).css('display','block');
								restructureChatBoxes();
							}
							
							if (item.s == 1) {
								item.f = username;
							}

							if (item.s == 2) {
								$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');
							} else {
								newMessages[chatboxtitle] = true;
								newMessagesWin[chatboxtitle] = true;
								$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+item.f+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');
							}

							$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
							itemsfound += 1;
						}
					});

					chatHeartbeatCount++;

					if (itemsfound > 0) {
						chatHeartbeatTime = minChatHeartbeat;
						chatHeartbeatCount = 1;
					} else if (chatHeartbeatCount >= 10) {
						chatHeartbeatTime *= 2;
						chatHeartbeatCount = 1;
						if (chatHeartbeatTime > maxChatHeartbeat) {
							chatHeartbeatTime = maxChatHeartbeat;
						}
					}
					
					setTimeout('chatHeartbeat();',chatHeartbeatTime);
				}});
			}

			function closeChatBox(chatboxtitle) {
				$('#chatbox_'+chatboxtitle).css('display','none');
				restructureChatBoxes();

				$.post("{BASE_URL}themes/assets/chat/chat.php?action=closechat", { chatbox: chatboxtitle} , function(data){	
				});

			}

			function toggleChatBoxGrowth(chatboxtitle) {
				if ($('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') == 'none') {  
					
					var minimizedChatBoxes = new Array();
					
					if ($.cookie('chatbox_minimized')) {
						minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
					}

					var newCookie = '';

					for (i=0;i<minimizedChatBoxes.length;i++) {
						if (minimizedChatBoxes[i] != chatboxtitle) {
							newCookie += chatboxtitle+'|';
						}
					}

					newCookie = newCookie.slice(0, -1)


					$.cookie('chatbox_minimized', newCookie);
					$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','block');
					$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','block');
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
				} else {
					
					var newCookie = chatboxtitle;

					if ($.cookie('chatbox_minimized')) {
						newCookie += '|'+$.cookie('chatbox_minimized');
					}


					$.cookie('chatbox_minimized',newCookie);
					$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
					$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
				}
				
			}

			function checkChatBoxInputKey(event,chatboxtextarea,chatboxtitle) {
				
				if(event.keyCode == 13 && event.shiftKey == 0)  {
					message = $(chatboxtextarea).val();
					message = message.replace(/^\s+|\s+$/g,"");

					$(chatboxtextarea).val('');
					$(chatboxtextarea).focus();
					$(chatboxtextarea).css('height','44px');
					if (message != '') {
						$.post("{BASE_URL}themes/assets/chat/chat.php?action=sendchat", {to: chatboxtitle, message: message} , function(data){
							message = message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;");
							$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+username+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+message+'</span></div>');
							$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
						});
					}
					chatHeartbeatTime = minChatHeartbeat;
					chatHeartbeatCount = 1;

					return false;
				}

				var adjustedHeight = chatboxtextarea.clientHeight;
				var maxHeight = 94;

				if (maxHeight > adjustedHeight) {
					adjustedHeight = Math.max(chatboxtextarea.scrollHeight, adjustedHeight);
					if (maxHeight)
						adjustedHeight = Math.min(maxHeight, adjustedHeight);
					if (adjustedHeight > chatboxtextarea.clientHeight)
						$(chatboxtextarea).css('height',adjustedHeight+8 +'px');
				} else {
					$(chatboxtextarea).css('overflow','auto');
				}
				
			}

			function startChatSession(){  
				$.ajax({
				url: "{BASE_URL}themes/assets/chat/chat.php?action=startchatsession",
				cache: false,
				dataType: "json",
				success: function(data) {
			
					username = data.username;

					$.each(data.items, function(i,item){
						if (item)	{ // fix strange ie bug

							chatboxtitle = item.f;

							if ($("#chatbox_"+chatboxtitle).length <= 0) {
								createChatBox(chatboxtitle,1);
							}
							
							if (item.s == 1) {
								item.f = username;
							}

							if (item.s == 2) {
								$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');
							} else {
								$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+item.f+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');
							}
						}
					});
					
					for (i=0;i<chatBoxes.length;i++) {
						chatboxtitle = chatBoxes[i];
						$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
						setTimeout('$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);', 100); // yet another strange ie bug
					}
				
				setTimeout('chatHeartbeat();',chatHeartbeatTime);
					
				}});
			}

			/**
			* Cookie plugin
			*
			* Copyright (c) 2006 Klaus Hartl (stilbuero.de)
			* Dual licensed under the MIT and GPL licenses:
			* http://www.opensource.org/licenses/mit-license.php
			* http://www.gnu.org/licenses/gpl.html
			*
			*/

			jQuery.cookie = function(name, value, options) {
				if (typeof value != 'undefined') { // name and value given, set cookie
					options = options || {};
					if (value === null) {
						value = '';
						options.expires = -1;
					}
					var expires = '';
					if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
						var date;
						if (typeof options.expires == 'number') {
							date = new Date();
							date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
						} else {
							date = options.expires;
						}
						expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
					}
					// CAUTION: Needed to parenthesize options.path and options.domain
					// in the following expressions, otherwise they evaluate to undefined
					// in the packed version for some reason...
					var path = options.path ? '; path=' + (options.path) : '';
					var domain = options.domain ? '; domain=' + (options.domain) : '';
					var secure = options.secure ? '; secure' : '';
					document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
				} else { // only name given, get cookie
					var cookieValue = null;
					if (document.cookie && document.cookie != '') {
						var cookies = document.cookie.split(';');
						for (var i = 0; i < cookies.length; i++) {
							var cookie = jQuery.trim(cookies[i]);
							// Does this cookie string begin with the name we want?
							if (cookie.substring(0, name.length + 1) == (name + '=')) {
								cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
								break;
							}
						}
					}
					return cookieValue;
				}
			};
		</script>
	<?php
	}

	if(in_array('whatsapp',$ASSETS)){
		?>
			<!--Tawk.to-->
			<!-- <script type="text/javascript">
				var Tawk_API = Tawk_API||{}, Tawk_LoadStart=new Date();
				(function(){
					var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
					s1.async=true;
					s1.src='https://embed.tawk.to/5ef578394a7c6258179b5d09/default';
					s1.charset='UTF-8';
					s1.setAttribute('crossorigin','*');
					s0.parentNode.insertBefore(s1,s0);
				})();
			</script> -->
	
			<script type="text/javascript">
				(function () {
					var options = {
						whatsapp: '<?php echo '+'.$whatsapp_no; ?>', // WhatsApp number
						call_to_action: "Whatsapp Us", // Call to action
						position: "right", // Position may be 'right' or 'left'
					};
					var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
					var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
					s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
					var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
				})();
			</script>
		<?php
		}
}
?>