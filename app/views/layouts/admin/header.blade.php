<div id="header">
    <a href="{{ URL::to('/') }}">
        {{ HTML::image('images/logo_admin.png', '', array('class' => 'logo')) }}
    </a>
    <span class="tagline">
        The Online Music Streaming<br>
        of the Philippines
    </span>
    <span class="logout">
        <a href="{{ URL::to('auth/logout') }}">
            SIGN OUT
        </a>
    </span>
</div>