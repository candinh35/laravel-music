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
    @forelse($singers as $singer)
        <tr>
            <td class="text-center text-muted">{{$loop->index}}</td>
            <td class="text-center text-muted"><img width="70"
                                                    src="{{ $singer->image != null ? asset('uploads/'. $singer->image)  : asset('template/admin/assets/images/default-singer.png')}}"
                                                    alt=""></td>
            <td class="text-center text-muted">{{$singer->name}}</td>
            <td class="text-center text-muted" width="700">{{$singer->description}}</td>

            <td class="text-center">
                <button data-toggle="modal" data-target="#formSubmit" data-toggle="tooltip"
                        data-route="{{ route('singer.edit', $singer->id) }}"
                        title="" data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm btn-edit"
                        data-original-title="Edit">
                        <span class="btn-icon-wrapper opacity-8">
                            <i class="bx bx-edit-alt me-1"></i>
                        </span>
                </button>
                <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm btn-delete"
                        data-route="{{ route('singer.destroy', $singer->id) }}" href="" type="submit"
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
        {{$singers->withQueryString()->links()}}
    </nav>
</div>

