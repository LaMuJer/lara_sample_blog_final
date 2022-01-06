@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            Manage Posts
                        </div>
                        <div class="card-body mb-3">
                            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Post Title</label>
                                    <input autofocus type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
                                    @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Select Category</label>
                                    <select type="text" name="category" class="form-select @error('category') is-invalid @enderror">
                                        @foreach(\App\Models\Category::all() as $category)
                                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }} >{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Photo</label>
                                    <input type="file" name="photo[]" value="{{ old('photo') }}" class="form-control @error('photo') is-invalid @enderror" multiple>
                                    @error('photo')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    @error('photo.*')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Post Description</label>
                                    <textarea type="text" rows="7" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary">Add</button>
                                </div>
                            </form>

                            @if(session('status'))
                                <p class="alert alert-success">{{ session('status') }}</p>
                            @endif



                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop
