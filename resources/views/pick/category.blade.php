@extends('templates.default')  

@section('title')
  PickList
@stop

@section('body-class')
  categories-page
@stop

@section('navigation')
    @include('templates.partials.navigation')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Picks tagged as '{{ $category }}'</h3>
            @if(!$statuses->count())
                <p>There are no picks tagged as '{{ $category }}' right now</p>
            @else
                @foreach($statuses as $status)
                    <div class="website-wrapper pick-{{ $status->type }}">
                        <div class="type label-{{ $status->type }}">
                            <a href="{{ route('pick.category', ['category' => $status->type]) }}">
                                <!--<img src="../img/icons/categories/{{ $status->type }}.png" />-->
                                {{ $status->type }}
                            </a>
                        </div>
                        <div class="image">
                            <a href="{{ route('pick.index', ['statusId' => $status->id]) }}"><img src="{{ $status->image }}" /></a>
                        </div>
                        <div class="details">
                            <p class="title"><a href="{{ route('pick.index', ['statusId' => $status->id]) }}">{{ $status->title }}</a></p>
                            <!--<p class="review">"{{ $status->review }}"</p>-->
                        </div>
                    </div>
                @endforeach
                {{ $statuses->render() }}
            @endif
        </div>
    </div>
@stop      