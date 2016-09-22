<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#looksy-menu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     <a class="navbar-brand" href="{{ route('home') }}">Pick List</a>
    </div>
        <div class="collapse navbar-collapse" id="looksy-menu">
            @if (Auth::check())
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('home') }}">Timeline</a></li>
                    <li><a href="{{ route('friend.index') }}">Friends</a></li>
                </ul>
                <form class="navbar-form navbar-left" role="search" action="{{ route('search.results') }}">
                    <div class="form-group">
                        <input type="text" name="query" class="form-control" placeholder="Find people">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            @endif
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check()) 
                    <li><a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">{{ Auth::user()->getNameOrUsername() }}</a></li>
                    <li><a href="{{ route('profile.edit') }}">Update profile</a></li>
                    <li><a href="{{ route('auth.signout') }}">Sign out</a></li>
                @else
                    <li><a href="{{ route('auth.signup') }}">Sign up</a></li>
                    <li><a href="{{ route('auth.signin') }}">Sign in</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
