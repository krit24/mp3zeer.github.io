<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="head_menu_pub">
		<div id = "header">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<div id="logo" style="position:relative; ">
					<a href="{{ URL::to('/') }}">
						{{ HTML::image('images/logo_01.png', 'K12', '') }}
					</a>
				</div>
				
			</div>
			<div class="navbar-right headertitle">
				<span>
					The Online DECISION SUPPORT SYSTEM<br />
					for Philippine Education
				</span>
			</div>
			<br style="clear:both;">
			<br style="clear:both;">
		</div>
		
		<!-- /.navbar-header -->
		
		<div>
		{{ Form::input('hidden','menu', 'null', ['id'=>'menuId']) }}
			<ul class="nav navbar-top-links navbar-right">
				<li class="dropdown">
					<a href="{{ URL::to('/') }}"">Home</a>
				</li>
				<li class="dropdown">
					<a href="{{ URL::to('about') }}">About Us</a>
				</li>
				<li class="dropdown">
					<a href="{{ URL::to('contact') }}">Contact Us</a>
				</li>
			</ul>
			<div style="clear:both;"></div>
		</div>
		
	</div>
</nav>