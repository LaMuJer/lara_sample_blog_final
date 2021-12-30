<table class="table table-bordered table-striped align-middle">

    <thead>

    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Owner</th>
        <th>Control</th>
        <th>Created_at</th>
    </tr>
    </thead>

    <tbody>

        @forelse($categories as $key=>$category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title  }}</td>
                <td>{{ $category->user->name }}</td>
                <td>
                    <form action="{{ route('category.destroy',$category->id) }}" method="post" class="d-inline-block">
                        @csrf
                        @method('delete')

                        <div class="">
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash fa-fw"></i></button>
                        </div>
                    </form>
                    <a href="{{ route('category.edit',$category->id) }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-pen-alt fa-fw"></i>
                    </a>
                </td>
                <td>
                    <p class="mb-0 small">
                        <i class="fas fa-calendar"></i>
                        {{ $category->created_at->format('d/ m/ Y') }}
                    </p>
                    <p class="mb-0 small">
                        <i class="fas fa-clock"></i>
                        {{ $category->created_at->format(" h: i a") }}
                    </p>
                    <p class="mb-0">
                        {{ $category->created_at->diffForHumans() }}
                    </p>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">There is no category.</td>
            </tr>
        @endforelse
    </tbody>

</table>
<div class="d-flex justify-content-end align-items-center">
    {{ $categories->links() }}
</div>


