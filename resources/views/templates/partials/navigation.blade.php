<nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <h1><a href="{{ route('home') }}">PickList</a></h1>
        <div id="looksy-menu">
            <ul class="looksy-navigation">
            @if (Auth::check())
                <li><a href="{{ route('home') }}"><img src="{{asset('img/navigation/home.png')}}" /></a></li>
                @if (Auth::check())
                    <li><a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}"><img src="{{asset('img/navigation/list.png')}}" /></a></li>
                @endif
                    <li><a href="{{ route('home') }}"><img src="{{asset('img/navigation/add.png')}}" /></a></li>
                    <li><a href="{{ route('friend.index') }}"><img src="{{asset('img/navigation/friends.png')}}" /></a></li>
                @if (Auth::check())      
                    <li><a href="{{ route('profile.edit') }}"><img src="{{asset('img/navigation/settings.png')}}" /></a></li>
                    
                @endif
            @elseif(!Auth::check())
                <li><a href="{{ route('auth.signup') }}">Sign up</a></li>
                <li><a href="{{ route('auth.signin') }}">Sign in</a></li>
            @endif
            </ul>
        </div>
    </div>
</nav>
