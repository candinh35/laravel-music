<table class="table-user align-middle mb-0 table table-borderless table-striped table-hover text-center">
    <thead>
        <tr>
            <th class="text-center text-muted">#</th>
            <th class="text-center text-muted">Name</th>
            <th class="text-center text-muted">Email</th>
            <th class="text-center text-muted">Wallet</th>
            <th class="text-center text-muted">Role</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $userOne)
            <tr>
                <td class="text-center text-muted">{{ $loop->index }}</td>
                <td class="text-center text-muted"><img width="70"
                        src="{{ $userOne->image != null ? asset('uploads/' . $userOne->image) : asset('template/admin/assets/images/default-user.png') }}"
                        alt=""></td>
                <td class="text-center text-muted">{{ $userOne->name }}</td>
                <td class="text-center text-muted">{{ $userOne->email }}</td>
                <td class="text-center text-muted">{{ $userOne->wallet }}</td>
                <td>
                    @if ($userOne->role === 1)
                        <span class="badge bg-label-warning me-1">Admin</span>
                    @else
                        <span class="badge bg-label-primary me-1">Client</span>
                    @endif
                </td>

                <td class="text-center ">
                    <button data-toggle="modal" data-target="#formSubmit" data-toggle="tooltip"
                        data-route="{{ route('user.edit', $userOne->id) }}"
                        title="" data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm btn-edit"
                        data-original-title="Edit">
                        <span class="btn-icon-wrapper opacity-8">
                            <i class="bx bx-edit-alt me-1"></i>
                        </span>
                    </button>
                    @if ($userOne['role'] == 0)
                        <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm btn-delete"
                            data-route="{{ route('user.destroy', $userOne->id) }}" href="" type="submit"
                            data-toggle="tooltip" title="" data-placement="bottom"
                            data-original-title="Delete">
                            <span class="btn-icon-wrapper opacity-8">
                                <i class="bx bx-trash me-1"></i>
                            </span>
                        </button>
                    @endif
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="7">
                    <img src="{{ asset('template/admin/assets/images/empty.jpg') }}" width="500" height="440"
                        alt="">
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="d-block card-footer">
    <nav role="navigation" aria-label="Pagination Navigation"
         class="flex items-center justify-between">
        {{$users->withQueryString()->links()}}
    </nav>
</div>