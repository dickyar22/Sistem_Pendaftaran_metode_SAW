<?php
	if(urinext('content')!=''){
		echo '
		<section class="page_banner">
			<div class="container">
				<div class="col-xl-12 text-center">
					<h2>{CONTENT_TITLE}</h2>
					<div class="breadcrumbs">
						<span>{ACTION}</span>
					</div>
				</div>
			</div>
		</section>';
	}
?>
{CONTENT}