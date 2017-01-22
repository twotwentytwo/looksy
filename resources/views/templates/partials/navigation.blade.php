<div class="looksy-menu">
    <ul class="looksy-navigation">
		<li class="home"><a href="{{ route('home') }}"><span>Home</span></a></li>
		<li class="search"><a href="{{ route('search.index') }}"><span>Filter</span></a></li>
		<li class="add"><a href="{{ route('add.index', ['username' => Auth::user()->username]) }}">Add</a></li>
		<li class="friends">
            <a href="{{ route('friend.index') }}"><span>Friends</span></a>
            @if(Auth::user()->friendRequests()->count())
                <span class="friend-requests">{{ Auth::user()->friendRequests()->count() }}</span>
            @endif
        </li>
		<li class="profile"><a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}"><span>My Picks</span></a></li>
    </ul>
    <div class="categories">
        <ul>
            <li class="see"><a href="{{ route('pick.category', ['category' => 'see']) }}"><!--<img src="../img/icons/categories/white/film.png" />-->See</a></li>
            <li class="watch"><a href="{{ route('pick.category', ['category' => 'watch']) }}"><!--<img src="../img/icons/categories/white/tv.png" />-->Watch</a></li>
            <li class="read"><a href="{{ route('pick.category', ['category' => 'read']) }}"><!--<img src="../img/icons/categories/white/youtube.png" />-->Read</a></li>
            <li class="taste"><a href="{{ route('pick.category', ['category' => 'taste']) }}"><!--<img src="../img/icons/categories/white/music.png" />-->Taste</a></li>
            <li class="listen"><a href="{{ route('pick.category', ['category' => 'listen']) }}"><!--<img src="../img/icons/categories/white/podcast.png" />-->Listen</a></li>
            <li class="buy"><a href="{{ route('pick.category', ['category' => 'buy']) }}"><!--<img src="../img/icons/categories/white/web.png" /></a>-->Buy</a></li>
            <li class="play"><a href="{{ route('pick.category', ['category' => 'play']) }}"><!--<img src="../img/icons/categories/white/news.png" />-->Play</a></li>
            <li class="use"><a href="{{ route('pick.category', ['category' => 'use']) }}"><!--<img src="../img/icons/categories/white/app.png" />-->Use</a></li>
        </ul>
    </div>
</div>