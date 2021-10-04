<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0" id="private_nav">
	<div class="head_menu_pub">
		<div id="header">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<a href="{{ URL::to('/') }}" class="navbar-brand">
					{{ HTML::image('images/logo_02.png', 'K12', '') }}
				</a>
				
			</div>
			<div class="navbar-right headertitle" id="user-log">
				<span class="user_name ucase">{{ $user->last_name }}, {{ $user->first_name }} {{ $user->middle_name }}</span>
				<span class="user_categorie">{{ $user_type }}</span>
			</div>
			<br style="clear:both;">
			<br style="clear:both;">
		</div>
		
		<!-- /.navbar-header -->
		
		<div>
			<ul class="nav navbar-top-links navbar-right">
				<li class="dropdown">
					<a href="{{ URL::to('/') }}" class="menu-link dropdown-toggle" data-toggle="dropdown">HOME</a>
					
				</li>
				<li class="dropdown">
					<a href="#" class="menu-link dropdown-toggle" data-toggle="dropdown">
						<span>K-12 LESSON</span>&nbsp;<i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="{{ URL::to('lesson/upload') }}"><div>Upload</div></a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="{{ URL::to('lesson/download') }}"><div>Download</div></a>
						</li>
					</ul>
					<!-- /.dropdown-messages -->
				</li>
				<li class="dropdown">
					<a href="{{ route('curriculum.map.public.index') }}" class="menu-link">CURICULUM MAP</a>
				</li>
				<li class="dropdown">
					
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true" style="text-decoration:none;">
						<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						
						<li><a href="{{ URL::to('account/settings') }}"><i class="fa fa-gear fa-fw"></i>Settings</a>
						</li>
						<li class="divider"></li>
						<li><a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
					</ul>
					<!-- /.dropdown-user -->
				</li>
				
			</ul>
			
			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav in" id="side-menu">
						<li class="sidebar-search">
							<div class="user-img-details">
								<div class="profile-img" style="width:100px; height:100px;">
									
									{{-- */ $path = Config::get('public_config'); /* --}}
									{{-- */ $path = $path['upload_path']['profile']; /* --}}
									{{-- */ $path = $path . $user->profile_pixx; /* --}}
									
									@if( $user->profile_pixx != "" && file_exists( $path ) )
										{{ HTML::image($path, '', array('width' => '100%')) }}
									@else
										{{ HTML::image('images/avatar.png', '', array('width' => '100%')) }}
									@endif
								</div>
								<div class="profile-details floatLeft" style="margin-left:10px; width:175px;">
									<br/>
									<p class="pfname ucase">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</p>
									<p class="pfcateg">Teacher I</p>
									<p class="pflic {{ ( _user()->group_id <> 4 ) ? 'hide' : '' }}">License No. {{ $user->prc_licence }}</p>
									<div id="edit-tool"><div id="edit-tool"><a href="{{ URL::to('account/update') }}" class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i> Edit Profile</a></div></div>
								</div>
								<div class="clear" style="clear:both;"></div>
							</div>
						</li>
						<li>
							<a href="index.html" class="active"><i class="fa fa-dashboard fa-fw"></i> Personal Information</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-graduation-cap"></i> Education<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="flot.html">Flot Charts</a>
								</li>
								<li>
									<a href="morris.html">Morris.js Charts</a>
								</li>
							</ul>
							<!-- /.nav-second-level -->
						</li>
						<li>
							<a href="tables.html"><i class="fa fa-table fa-fw"></i> Specialization</a>
						</li>
						<li>
							<a href="forms.html"><i class="fa fa-edit fa-fw"></i> Contact Information</a>
						</li>
						
					</ul>
				</div>
			<!-- /.sidebar-collapse -->
			</div>
			<div style="clear:both;"></div>
		</div>
		
	</div>
</nav>