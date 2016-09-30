<!DOCTYPE html>
<html>
    <head>
        <title>PickList</title>
        <!-- Latest compiled and minified CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Looksy css  -->

        <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/looksy.css')}}">
            
    </head>
    <body>
        
        <div class="container">
            @include('templates.partials.alerts')
            <div class="row">
                <nav class="navbar navbar-default" role="navigation">
                    <h1>PickList</h1>
                     @include('templates.partials.navigation')
                </nav>
                <div class="col-lg-5">

                    <h3>Picks tagged as '{{ $category }}'</h3>
                    @if(!$statuses->count())
                        <p>There are no picks tagged as '{{ $category }}' right now</p>
                    @else
                        @foreach($statuses as $status)
                            <div class="website-wrapper {{ $status->type }}">
                                <div class="type {{ $status->type }}"></div>
                                <div class="image">
                                    <a href="{{ route('pick.index', ['statusId' => $status->id]) }}"><img src="{{ $status->image }}" /></a>
                                </div>
                                <div class="details">
                                    <p class="title"><a href="{{ route('pick.index', ['statusId' => $status->id]) }}">{{ $status->title }}</a></p>
                                    <p class="review">"{{ $status->review }}"</p>
                                </div>
                                
                            </div>
                        @endforeach
                        
                    @endif
                
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