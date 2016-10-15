<div class="looksy-menu">
    <ul class="looksy-navigation">
		<li class="home"><a href="{{ route('home') }}">Home</a></li>
		<li class="search"><a href="{{ route('search.index') }}">Serach</a></li>
		<li class="add"><a href="{{ route('add.index') }}">Add</a></li>
		<li class="friends">
            <a href="{{ route('friend.index') }}">Friends</a>
            @if(Auth::user()->friendRequests()->count())
                <span class="friend-requests"></span>
            @endif
        </li>
		<li class="profile"><a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">Profile</a></li>
    </ul>

    <div class="categories">
        <ul>
            <li class="film"><a href="{{ route('pick.category', ['category' => 'film']) }}"><img src="../img/icons/categories/white/film.png" /></a></li>
            <li class="tv"><a href="{{ route('pick.category', ['category' => 'tv']) }}"><img src="../img/icons/categories/white/tv.png" /></a></li>
            <li class="video"><a href="{{ route('pick.category', ['category' => 'video']) }}"><img src="../img/icons/categories/white/youtube.png" /></a></li>
            <li class="music"><a href="{{ route('pick.category', ['category' => 'music']) }}"><img src="../img/icons/categories/white/music.png" /></a></li>
            <li class="podcast"><a href="{{ route('pick.category', ['category' => 'podcast']) }}"><img src="../img/icons/categories/white/podcast.png" /></a></li>
            <li class="web"><a href="{{ route('pick.category', ['category' => 'web']) }}"><img src="../img/icons/categories/white/web.png" /></a></li>
            <li class="news"><a href="{{ route('pick.category', ['category' => 'news']) }}"><img src="../img/icons/categories/white/news.png" /></a></li>
            <li class="app"><a href="{{ route('pick.category', ['category' => 'app']) }}"><img src="../img/icons/categories/white/app.png" /></a></li>
            <li class="food"><a href="{{ route('pick.category', ['category' => 'food']) }}"><img src="../img/icons/categories/white/food.png" /></a></li>
            <li class="art"><a href="{{ route('pick.category', ['category' => 'art']) }}"><img src="../img/icons/categories/white/art.png" /></a></li>
            <li class="book"><a href="{{ route('pick.category', ['category' => 'book']) }}"><img src="../img/icons/categories/white/book.png" /></a></li>
            <li class="shop"><a href="{{ route('pick.category', ['category' => 'shop']) }}"><img src="../img/icons/categories/white/shop.png" /></a></li>
        </ul>
    </div>
    
</div>
