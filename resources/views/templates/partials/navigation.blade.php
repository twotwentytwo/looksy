<div id="looksy-menu">
    <ul class="looksy-navigation">
        <li class="home"><a href="{{ route('home') }}"><img src="{{asset('img/icons/nav/home.png')}}" /></a></li>
       <li class="search"><a href="{{ route('search.index') }}"><img src="{{asset('img/icons/nav/search.png')}}" /></a></li>
            <li class="add"><a href="{{ route('add.index') }}"><img src="{{asset('img/icons/nav/add.png')}}" /></a></li>
            <li class="friends"><a href="{{ route('friend.index') }}"><img src="{{asset('img/icons/nav/friends.png')}}" /></a></li>
            <li class="profile"><a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}"><img src="{{asset('img/icons/nav/profile.png')}}" /></a></li>
       
    </ul>
</div>
