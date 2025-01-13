<table class="align-middle mb-0 table table-borderless table-striped table-hover text-center">
    <thead>
    <tr>
        <th class="text-center">ID</th>
        <th>Name</th>
        <th>Image</th>
        <th>Price</th>
        <th>Music</th>
        <th>Album</th>
        <th>Singer</th>
        <th>Genre</th>
        <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($songs as $song)
        <tr>
            <td class="text-center text-muted">{{$loop->iteration}}</td>
            <td class="text-center text-muted">{{$song->name}}</td>
            <td class="text-center text-muted"><img width="100" height="50" src="{{asset('uploads/'.$song->image)}}"
                                                    alt=""></td>
            <td class="text-center text-muted">{{number_format($song->price)}} <strong>USD</strong></td>
            <td class="text-center text-muted">
                <audio controls>
                    <source src="{{asset('uploads/'.$song->file_url)}}" type="audio/mpeg">
                </audio>
            </td>
            <td class="text-center text-muted">{{$song->album->name}}</td>
            <td class="text-center text-muted">{{$song->singer->name}}</td>
            <td class="text-center text-muted">{{$song->genre->name}}</td>
            <td class="text-center" width="140">
                <button data-toggle="modal" data-target="#formSubmit" data-toggle="tooltip"
                        data-route="{{ route('song.edit', $song->id) }}"
                        title="" data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm btn-edit"
                        data-original-title="Edit">
                        <span class="btn-icon-wrapper opacity-8">
                            <i class="bx bx-edit-alt me-1"></i>
                        </span>
                </button>
                <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm btn-delete"
                        data-route="{{ route('song.destroy', $song->id) }}" href="" type="submit"
                        data-toggle="tooltip" title="" data-placement="bottom"
                        data-original-title="Delete">
                            <span class="btn-icon-wrapper opacity-8">
                                <i class="bx bx-trash me-1"></i>
                            </span>
                </button>
            </td>
        </tr>

        </tr>
    @empty
        <tr>
            <td colspan="9">
                <img src="{{asset('template/admin/assets/images/empty.jpg')}}" width="500" height="440" alt="">
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

<div class="d-block card-footer">
    <nav role="navigation" aria-label="Pagination Navigation"
         class="flex items-center justify-between">
        {{$songs->withQueryString()->links()}}
    </nav>
</div>

