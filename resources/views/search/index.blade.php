@extends('templates.default')  

@section('title')
  Search
@stop

@section('body-class')
  search
@stop

@section('navigation')
    @include('templates.partials.navigation')
@stop

@section('content')
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
@stop