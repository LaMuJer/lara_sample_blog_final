@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            Post List
                        </div>
                        <div class="card-body mb-3">

                            {{ request()->search }}

                            @if(session('status'))
                                <p class="alert alert-success">{{ session('status') }}</p>
                            @endif
                            <div class="d-flex justify-content-between">
                                {{ $posts->appends(request()->all())->links() }}
                                <div class="">
                                    <form >
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Search" name="search">
                                            <button class="btn btn-outline-success" id="button-addon2">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                                <table class="table align-middle">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="w-25">Title</th>
                                        <th>Photo</th>
                                        <th>Category</th>
                                        <th>Owner</th>
                                        <th>Controls</th>
                                        <th>Created_at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>
                                                @forelse($post->photos()->latest('id')->limit(3)->get() as $photo)

                                                        <a class="venobox"  href="{{ asset('storage/photo/'.$photo->name) }}"  data-gall="gall{{ $post->id }}">
                                                            <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" height="40" alt="image alt"/>
                                                        </a>

                                                @empty
                                                    <p class="mb-0 text-muted">No Photo Upload</p>
                                                @endforelse
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">
                                                    {{ $post->category->title }}
                                                </span>
                                            </td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('post.show',$post->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye fa-fw"></i>
                                                    </a>
{{--                                                    @can('post-edit',$post)--}}{{-- with Gate--}}
                                                    @can('view',$post)
                                                    <a href="{{ route('post.edit',$post->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-pen-alt fa-fw"></i>
                                                    </a>
{{--                                                    @endcan--}}{{-- with Gate--}}
                                                    @endcan
                                                    <button class="btn btn-sm btn-outline-primary" form="deletePost{{ $post->id }}">
                                                        <i class="fas fa-trash-alt fa-fw"></i>
                                                    </button>
                                                </div>
                                                <form action="{{ route('post.destroy',$post->id) }}"
                                                      id="deletePost{{ $post->id }}" method="post" class="d-none">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </td>
                                            <td>
                                                <p class="mb-0 small">
                                                    <i class="fas fa-calendar"></i>
                                                    {{ $post->created_at->format('d/ m/ Y') }}
                                                </p>
                                                <p class="mb-0 small">
                                                    <i class="fas fa-clock"></i>
                                                    {{ $post->created_at->format(" h: i a") }}
                                                </p>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">There is no Post .</td>
                                        </tr>
                                    @endforelse
                                    </tbody>

                                </table>
                                {{ $posts->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

