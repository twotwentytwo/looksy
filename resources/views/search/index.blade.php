<!DOCTYPE html>
<html>
    <head>
        <title>Friends - PickList</title>
        <!-- Latest compiled and minified CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Looksy css  -->

        <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/looksy.css')}}">
            
    </head>
    <body class="search">
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <h1>Browse</h1>
                @include('templates.partials.navigation')
            </nav>
            @include('templates.partials.alerts')
            
            <div class="row">
                <div class="col-lg-6">
                    <h3>Categories</h3>
                    <ul class="categories">
                        <li class="film"><a href="{{ route('pick.category', ['category' => 'film']) }}"><img src="../img/icons/categories/film.png" /><span>Film</span></a></li>
                        <li class="tv"><a href="{{ route('pick.category', ['category' => 'tv']) }}"><img src="../img/icons/categories/tv.png" /><span>TV</span></a></li>
                        <li class="video"><a href="{{ route('pick.category', ['category' => 'video']) }}"><img src="../img/icons/categories/youtube.png" /><span>Video clip</span></a></li>
                        <li class="music"><a href="{{ route('pick.category', ['category' => 'music']) }}"><img src="../img/icons/categories/music.png" /><span>Music</span></a></li>
                        <li class="podcast"><a href="{{ route('pick.category', ['category' => 'podcast']) }}"><img src="../img/icons/categories/podcast.png" /><span>Podcast</span></a></li>
                        <li class="web"><a href="{{ route('pick.category', ['category' => 'web']) }}"><img src="../img/icons/categories/web.png" /><span>Website</span></a></li>
                        <li class="news"><a href="{{ route('pick.category', ['category' => 'news']) }}"><img src="../img/icons/categories/news.png" /><span>News</span></a></li>
                        <li class="app"><a href="{{ route('pick.category', ['category' => 'app']) }}"><img src="../img/icons/categories/app.png" /><span>Mobile app</span></a></li>
                        <li class="food"><a href="{{ route('pick.category', ['category' => 'food']) }}"><img src="../img/icons/categories/food.png" /><span>Food &amp; drink</span></a></li>
                        <li class="art"><a href="{{ route('pick.category', ['category' => 'art']) }}"><img src="../img/icons/categories/art.png" /><span>Art</span></a></li>
                        <li class="book"><a href="{{ route('pick.category', ['category' => 'book']) }}"><img src="../img/icons/categories/book.png" /><span>Book / Writing</span></a></li>
                        <li class="shop"><a href="{{ route('pick.category', ['category' => 'shop']) }}"><img src="../img/icons/categories/shop.png" /><span>Shop</span></a></li>
                        <li class="location"><a href="{{ route('pick.category', ['category' => 'location']) }}"><img src="../img/icons/categories/location.png" /><span>Location</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script src="{{asset('js/looksy.js')}}"></script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-84723006-1', 'auto');
      ga('send', 'pageview');

    </script>
</html>