<!DOCTYPE html>
<html>

<head>
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>{$meta_title}{if $meta_title != "" && $site->metatitle != ""} - {/if}{$site->metatitle}</title>


	{{Html::style("{{asset("/assets/css/all-css.css")}}")}}

</head>
<body class="nav-md">
<div class="container body">
	<div class="main_container">
		<div class="col-md-3 left_col">
			<div class="left_col scroll-view">
				<div class="navbar nav_title" style="border: 0;">
					<a href="{$site->home_link}" class="site_title"><i class="fa fa-mixcloud"></i>
						<span>{{config('app.name')}}</span></a>
				</div>
				<div class="clearfix"></div>
				<br/>
				<!-- sidebar menu -->
				{$admin_menu}
				<!-- /sidebar menu -->
			</div>
		</div>
		<!-- top navigation -->
		<div class="top_nav">
			<div class="nav_menu">
				<nav class="" role="navigation">
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					</div>
					{$page->head}
				</nav>
			</div>
		</div>
		<!-- /top navigation -->

		<!-- page content -->
		<div class="right_col" role="main">
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-12">
					{$notification}
					{$content}
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- footer content -->
			<footer>
				<div class="copyright-info">
					<strong>Copyright &copy; {$smarty.now|date_format:"%Y"} <a
								href="https://github.com/NNTmux/">newznab-tmux</a>.</strong> This software is open
					source,
					released under the GPL license
				</div>
				<div class="clearfix"></div>
			</footer>
			<!-- /footer content -->

		</div>
		<!-- /page content -->
	</div>

</div>

{{Html::script("{{asset("/assets/js/all-js.js")}}")}}

</body>

</html>
