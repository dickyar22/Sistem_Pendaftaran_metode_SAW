<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark fixed-top">
	<div class="navbar-brand wmin-0 mr-5">
		<a href="{BASE_URL}pages/content/home" class="d-inline-block">
			<img src="{BASE_URL}img/logo2.png" alt="Image">
			<?php
				/* $r = select2("setting","*","WHERE id_setting='S20200524024851dz8'");
				echo '
				<img src="{BASE_URL}upload/setting/img_setting/'.$r['img_setting'].'" alt="Image">'; */
			?>
		</a>
	</div>

	<div class="d-md-none">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
			<i class="icon-tree5"></i>
		</button>
	</div>

	<div class="collapse navbar-collapse" id="navbar-mobile">
		<span class="badge bg-success-400 badge-pill ml-md-3 mr-md-auto">Online</span>

		<ul class="navbar-nav">
			<!-- <li class="nav-item dropdown dropdown-user">
				<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
					<img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle mr-2" height="34" alt="">
					<span>Victoria</span>
				</a>

				<div class="dropdown-menu dropdown-menu-right">
					<a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
					<a href="#" class="dropdown-item"><i class="icon-coins"></i> My balance</a>
					<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Messages <span class="badge badge-pill bg-blue ml-auto">58</span></a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
					<a href="#" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
				</div>
			</li> -->
			{MENU_HEADER}
		</ul>
	</div>
</div>
<!-- /main navbar -->
<script>
	var menu_header = $('.nav-link');
	menu_header.addClass('navbar-nav-link');
	menu_header.removeClass('nav-link');
</script>