<!DOCTYPE html>
<html>
    <head>
        <title>Edit profile - PickList</title>
        <!-- Latest compiled and minified CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Looksy css  -->

        <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/looksy.css')}}">
            
    </head>
    <body class="edit">
        
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <h1>Edit profile</h1>
                @include('templates.partials.navigation')
            </nav>
            @include('templates.partials.alerts')
            <div class="row">
                <div class="col-lg-6">
                    <form class="form-vertical" role="form" method="post" action="#">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group{{ $errors->has('first_name') ? ' has-error': '' }}">
                                   
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First name" value="{{ Request::old('first_name') ?: Auth::user()->first_name }}">
                                    @if($errors->has('first_name'))
                                        <span class="help-block">{{ $errors->first('first_name') }}</span> 
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group{{ $errors->has('last_name') ? ' has-error': '' }}">
                                    
                                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last name" value="{{ Request::old('last_name') ?: Auth::user()->last_name }}">
                                    @if($errors->has('last_name'))
                                        <span class="help-block">{{ $errors->first('last_name') }}</span> 
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('location') ? ' has-error': '' }}">
                            
                            <input type="text" name="location" class="form-control" id="location" placeholder="Location" value="{{ Request::old('location') ?: Auth::user()->location }}">
                            @if($errors->has('location'))
                                        <span class="help-block">{{ $errors->first('location') }}</span> 
                                    @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Update</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">

                        @if (Auth::check())      
                            <a href="{{ route('auth.signout') }}">Sign out</a>
                        @endif
                    </form>
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