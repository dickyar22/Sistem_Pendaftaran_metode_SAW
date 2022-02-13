<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-light fixed-top">

	<!-- Header with logos -->
	<div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
		<div class="navbar-brand navbar-brand-md">
			<a href="{BASE_URL}pages/content/home" class="d-inline-block">
				<img src="{BASE_URL}img/logo2.png" alt="Image" width="100px" height="70px">
			</a>
		</div>
		
		<div class="navbar-brand navbar-brand-xs">
			<a href="{BASE_URL}pages/content/home" class="d-inline-block">
			<img src="{BASE_URL}img/favicon.png" alt="Image">
			</a>
		</div>
	</div>
	<!-- /header with logos -->


	<!-- Mobile controls -->
	<div class="d-flex flex-1 d-md-none">
		<div class="navbar-brand mr-auto">
			<a href="{BASE_URL}img/logo2.png" class="d-inline-block">
			<img src="{BASE_URL}img/logo2.png" alt="Image" width="120px" height="50px">
			</a>
		</div>	

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
			<i class="icon-tree5"></i>
		</button>

		<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
			<i class="icon-paragraph-justify3"></i>
		</button>
	</div>
	<!-- /mobile controls -->


	<!-- Navbar content -->
	<div class="collapse navbar-collapse" id="navbar-mobile">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
					<i class="icon-paragraph-justify3"></i>
				</a>
			</li>

			<li class="nav-item dropdown">
				<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
					<i class="fa fa-bell"></i>
					<span class="d-md-none ml-2">Notification</span>
					<span class="badge badge-mark border-pink-400 ml-auto ml-md-0"></span>
				</a>
				
				<div class="dropdown-menu dropdown-content wmin-md-300">
					<div class="dropdown-content-header">
						<span class="font-weight-semibold">Lulus / Tidak Lulus</span>
						<!-- <a href="#" class="text-default"><i class="icon-search4 font-size-base"></i></a> -->
					</div>

					<div class="dropdown-content-body dropdown-scrollable">
						<ul class="media-list">
						<?php
							$notif = select("hasil","*","WHERE id_alternatif='$sUserTable' ORDER BY tahun DESC");

							foreach($notif as $i => $r){
								$ket = 'Tidak Lulus';
								if($r['flag_aktif']=='1'){
									$ket = 'Lulus';
								}
								echo '
								<li class="media">
									<div class="media-body">
										<a href="#" class="media-title font-weight-semibold">'.$ket.'</a>
										<span class="d-block text-muted font-size-sm">'.$r['tahun'].'</span>
									</div>
									<div class="ml-3 align-self-center"><span class="badge badge-mark border-success"></span></div>
								</li>';
							}
						?>
						</ul>
					</div>

					<!-- <div class="dropdown-content-footer bg-light">
						<a href="#" class="text-grey mr-auto">All users</a>
						<a href="#" class="text-grey"><i class="icon-gear"></i></a>
					</div> -->
				</div>
			</li>
		</ul>

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
					<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Messages <span class="badge badge-pill bg-indigo-400 ml-auto">58</span></a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
					<a href="#" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
				</div>
			</li> -->
			{MENU_HEADER}
		</ul>
	</div>
	<!-- /navbar content -->
	
</div>
<!-- /main navbar -->