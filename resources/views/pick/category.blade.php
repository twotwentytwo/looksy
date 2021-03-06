@extends('templates.default')  

@section('title')
  {{ ucfirst($category) }}
@stop

@section('body-class')
  categories-page
@stop

@section('navigation')
    @include('templates.partials.navigation')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 row-inner">
            
            @if(!$statuses->count())
                <p class="no-results">There are no picks tagged as '{{ $category }}' right now</p>
            @else
                @foreach($statuses as $status)
                    <div class="website-wrapper pick-{{ $status->type }}">
                        <div class="type label-{{ $status->type }}">
                            <a href="{{ route('pick.category', ['category' => $status->type]) }}">{{ $status->type }}</a>
                        </div>
                        <div class="image">
                            <a href="{{ route('pick.index', ['statusId' => $status->id]) }}"><img src="{{ $status->image }}" /></a>
                        </div>
                        <div class="details">
                            <p class="title"><a href="{{ route('pick.index', ['statusId' => $status->id]) }}">{{ $status->title }}</a></p>
                        </div>
                    </div>
                @endforeach
                {{ $statuses->render() }}
            @endif
        </div>
    </div>
@stop      