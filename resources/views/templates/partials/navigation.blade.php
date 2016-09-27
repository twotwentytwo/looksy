<div id="looksy-menu">
    <ul class="looksy-navigation">
        <li class="home"><a href="{{ route('home') }}"><img src="{{asset('img/icons/nav/home.png')}}" /></a></li>
        @if (Auth::check())
            <!-- {{ route('profile.index', ['username' => Auth::user()->username]) }} -->
            <li class="search"><a href="#"><img src="{{asset('img/icons/nav/search.png')}}" /></a></li>
        @endif
            <li class="add"><a href="{{ route('add.index') }}"><img src="{{asset('img/icons/nav/add.png')}}" /></a></li>
            <li class="friends"><a href="{{ route('friend.index') }}"><img src="{{asset('img/icons/nav/friends.png')}}" /></a></li>
        @if (Auth::check())      
            <li class="notification"><a href="#"><img src="{{asset('img/icons/nav/bell.png')}}" /></a></li>
        @endif
    </ul>
</div>
