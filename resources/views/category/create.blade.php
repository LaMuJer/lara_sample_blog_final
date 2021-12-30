@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            Manage Category
                        </div>
                        <div class="card-body mb-3">
                            <form action="{{ route('category.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div class="">
                                            <input type="text" name="title"
                                                   value="{{ old('title') }}" class="form-control
                                                    @error('title') is-invalid @enderror">
                                        </div>
                                        <div class="">
                                            <button class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </div>
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </form>

                            @if(session('status'))
                                <p class="alert alert-success">{{ session('status') }}</p>
                            @endif

                            @include('category.list')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
