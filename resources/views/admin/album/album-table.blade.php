<table class="align-middle mb-0 table table-borderless table-striped table-hover text-center">
    <thead>
    <tr>
        <th class="text-center">ID</th>
        <th>Avatar</th>
        <th>Name</th>
        <th>Description</th>
        <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($albums as $album)
        <tr>
            <td class="text-center text-muted">{{$loop->index}}</td>
            <td class="text-center text-muted"><img width="70"
                                                    src="{{ $album->image != null ? asset('uploads/'. $album->image)  : asset('template/admin/assets/images/default-album.png')}}"
                                                    alt=""></td>
            <td class="text-center text-muted">{{$album->name}}</td>
            <td class="text-center text-muted" width="600">{{$album->description}}</td>

            <td class="text-center">
                <button data-toggle="modal" data-target="#formSubmit" data-toggle="tooltip"
                        data-route="{{ route('album.edit', $album->id) }}"
                        title="" data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm btn-edit"
                        data-original-title="Edit">
                        <span class="btn-icon-wrapper opacity-8">
                            <i class="bx bx-edit-alt me-1"></i>
                        </span>
                </button>
                <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm btn-delete"
                        data-route="{{ route('album.destroy', $album->id) }}" href="" type="submit"
                        data-toggle="tooltip" title="" data-placement="bottom"
                        data-original-title="Delete">
                            <span class="btn-icon-wrapper opacity-8">
                                <i class="bx bx-trash me-1"></i>
                            </span>
                </button>
            </td>

        </tr>
    @empty
        <tr>
            <td colspan="7">
                <img src="{{asset('template/admin/assets/images/empty.jpg')}}" width="500" height="440" alt="">
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
<div class="d-block card-footer">
    <nav role="navigation" aria-label="Pagination Navigation"
         class="flex items-center justify-between">
        {{$albums->withQueryString()->links()}}
    </nav>
</div>
