@extends('templates.default')  

@section('title')
  Edit Profile
@stop

@section('body-class')
  edit profile
@stop

@section('navigation')
    @include('templates.partials.navigation')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form class="form-vertical" role="form" method="post" action="#" enctype="multipart/form-data">

                <img src="{{Auth::user()->getAvatarUrl('144') }}" class="profile-image-edit" />
                
                <div class="form-group{{ $errors->has('first_name') ? ' has-error': '' }}">
                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First name" value="{{ Request::old('first_name') ?: Auth::user()->first_name }}">
                    @if($errors->has('first_name'))
                        <span class="help-block">{{ $errors->first('first_name') }}</span> 
                    @endif
                </div>
                <div class="form-group{{ $errors->has('last_name') ? ' has-error': '' }}">
                    
                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last name" value="{{ Request::old('last_name') ?: Auth::user()->last_name }}">
                    @if($errors->has('last_name'))
                        <span class="help-block">{{ $errors->first('last_name') }}</span> 
                    @endif
                </div>
                <div class="form-group{{ $errors->has('location2') ? ' has-error': '' }}">
                    <input type="text" name="location2" class="form-control" id="location2" placeholder="Location" value="{{ Request::old('location2') ?: Auth::user()->location2 }}">
                    @if($errors->has('location2'))
                        <span class="help-block">{{ $errors->first('location2') }}</span> 
                    @endif
                </div>

                <input type="hidden" role="uploadcare-uploader" name="image" data-clearable="true">
                    
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
    <div class="back-link">
        <a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}"><img src="{{asset('img/icons/back.png')}}" /></a>
    </div>
@stop            
       