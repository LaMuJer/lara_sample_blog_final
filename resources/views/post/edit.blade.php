@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            Edit Post
                        </div>
                        <div class="card-body mb-3">
{{--                            {{ $post }}--}}
                            <form action="{{ route('post.update',$post->id) }}" method="post">
                                @method('put')
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Post Title</label>
                                    <input autofocus type="text" name="title" value="{{ old('title',$post->title) }}" class="form-control @error('title') is-invalid @enderror">
                                    @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Select Category</label>
                                    <select type="text" name="category" class="form-select @error('category') is-invalid @enderror">
                                        @foreach(\App\Models\Category::all() as $category)
                                            <option value="{{ $category->id }}" {{ old('category',$post->category_id) == $category->id ? 'selected' : '' }} >{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Post Description</label>
                                    <textarea type="text" rows="7" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description',$post->description) }}</textarea>
                                    @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </form>

                            @if(session('status'))
                                <p class="alert alert-success">{{ session('status') }}</p>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
               <div class="card rounded shadow">
                   <div class="card-body">

                       <form action="{{ route('photo.store') }}" method="post" enctype="multipart/form-data" class="d-none" id="uploaderForm">
                           @csrf
                           <input type="hidden" name="post_id" value="{{ $post->id }}">
                           <div class="d-flex justify-content-between align-items-center">
                               <input type="file" class="form-control" multiple name="photo[]" accept="image/jpeg,image/png" id="uploaderInput">
                               <button class="btn btn-sm btn-primary  my-3"><i class="fas fa-upload"></i></button>
                           </div>
                       </form>
                       <div class="mb-3">
                           <div class="d-block p-3 border rounded border-dark mb-3 d-flex justify-content-center " id="uploaderBtn" style="cursor: pointer">
                               <i class="fas fa-plus-circle fa-2x"></i>
                           </div>
                           @forelse($post->photos as $photo)
                               <div class="d-inline-block position-relative" style="width: 100px;height: 100px;">

                                   <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" class="position-absolute" height="100" alt="">
                                   <form action="{{ route('photo.destroy',$photo->id) }}"  method="post" >
                                       @csrf
                                       @method('delete')
                                       {{--                                   <p>{{ $photo->id }}</p>--}}
                                       <button class="btn btn-danger btn-sm position-absolute" style="bottom: 5px;right: 5px;">
                                           <i class="fas fa-trash-alt"></i>
                                       </button>
                                   </form>
                               </div>
                           @empty

                           @endforelse
                       </div>

                   </div>
               </div>
            </div>
        </div>
    </div>
    <script !src="">

        let uploaderForm = document.getElementById('uploaderForm');
        let uploaderBtn = document.getElementById('uploaderBtn');
        let uploaderInput = document.getElementById('uploaderInput');

        uploaderBtn.addEventListener('click' , function (){
            uploaderInput.click();
        })

        uploaderInput.addEventListener('change', function (){
            uploaderForm.submit();
        })

    </script>
@stop
