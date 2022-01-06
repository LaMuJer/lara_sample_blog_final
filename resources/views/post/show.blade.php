@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <h1>{{ $post->title }}</h1>
                        </div>
                        <div class="card-body mb-3">

                            <p class="">
                                {{ $post->description }}
                            </p>

                            @if(session('status'))
                                <p class="alert alert-success">{{ session('status') }}</p>
                            @endif

                            <a href="{{ route('post.index') }}" class="btn btn-primary">Post Lists</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

