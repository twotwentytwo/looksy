<div class="looksy-menu">
    <ul class="looksy-navigation">
		<li class="home"><a href="{{ route('home') }}">Home</a></li>
		<li class="search"><a href="{{ route('search.index') }}">Serach</a></li>
		<li class="add"><a href="{{ route('add.index') }}">Add</a></li>
		<li class="friends"><a href="{{ route('friend.index') }}">Friends</a></li>
		<li class="profile"><a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">Profile</a></li>
    </ul>
    @if(Auth::user()->friendRequests())
    	<div class="friend-requests">
    		<p class="count">{{ Auth::user()->friendRequests()->count() }}</p>
    	</div>
    @endif
</div>
