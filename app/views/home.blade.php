{{ HTML::style('css/style.css') }}
<div id="background">

	<div id="loginContainer">

		<div id="inputContainer">
			{{ Form::open(array('url' => URL::to('login/submit'), 'id' => 'loginForm', 'autocomplete' => 'off')) }}
				<h2>Login to your account</h2>
				{{ get_message() }}
				<p>
					<label for="loginUsername">Username</label>
					<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. bartSimpson" value="" required>
				</p>
				<p>
					<label for="loginPassword">Password</label>
					<input id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required>
				</p>

				<button type="submit" name="loginButton">LOG IN</button>

				<div class="hasAccountText">
					<span id="hideLogin">
						Don't have an account yet? <a href="javascript:void(0)" class="sign-up">Signup here</a>.
					</span>
				</div>
				
			{{ Form::close() }}


			{{ Form::open(array('url' => URL::to('register/submit'), 'id' => 'registerForm', 'class' => 'hide', 'autocomplete' => 'off')) }}
				<h2>Create your free account</h2>
				{{ get_message() }}
				<p>
					<label for="username">Username</label>
					<input id="username" name="username" type="text" placeholder="e.g. bartSimpson" value="" required>
				</p>

				<p>
					<label for="firstName">First name</label>
					<input id="firstName" name="firstName" type="text" placeholder="e.g. Bart" value="" required>
				</p>

				<p>
					<label for="lastName">Last name</label>
					<input id="lastName" name="lastName" type="text" placeholder="e.g. Simpson" value="" required>
				</p>

				<p>
					<label for="email">Email</label>
					<input id="email" name="email" type="email" placeholder="e.g. bart@gmail.com" value="" required>
				</p>

				<p>
					<label for="email2">Confirm email</label>
					<input id="email2" name="email2" type="email" placeholder="e.g. bart@gmail.com" value="" required>
				</p>

				<p>
					<label for="password">Password</label>
					<input id="password" name="password" type="password" placeholder="Your password" required>
				</p>

				<p>
					<label for="password2">Confirm password</label>
					<input id="password2" name="password2" type="password" placeholder="Your password" required>
				</p>

				<button type="submit" name="registerButton">SIGN UP</button>

				<div class="hasAccountText">
					<span id="hideRegister">Already have an account? <a href="javascript:void(0)" class="sign-in">Log in here</a>.</span>
				</div>
				
			{{ Form::close() }}


		</div>

		<div id="loginText">
			<h1>Get great music, right now</h1>
			<h2>Listen to loads of songs for free</h2>
			<ul>
				<li>Discover music you'll fall in love with</li>
				<li>Create your own playlists</li>
				<li>Follow artists to keep up to date</li>
			</ul>
		</div>

	</div>
</div>