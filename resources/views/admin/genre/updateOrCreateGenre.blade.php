<form action="" method="post" class="form-submit">
    <div class="errMessage"></div>
    @if (isset($genre))
        @method('put')
    @endif
    @csrf
    <div class="position-relative row form-group mb-4">
        <label for="name" class="col-md-3 text-md-right col-form-label">Name</label>
        <div class="col-md-9 col-xl-8">
            <input  name="name" id="name" placeholder="Name" type="text"
                class="form-control @error('name') border border-danger  @enderror"
                value="@if (isset($genre)) {{ $genre->name }} @endif">
        </div>
    </div>

    <div class="position-relative row form-group mb-4">
        <label for="description" class="col-md-3 text-md-right col-form-label">Description</label>
        <div class="col-md-9 col-xl-8">
            <textarea name="description" id="description" cols="30" rows="10"
                class="form-control @error('description') border border-danger  @enderror">
                                        @if (isset($genre))
{{ $genre->description }}
@else
{{ old('description') }}
@endif
                                        </textarea>
        </div>
    </div>
    <div class="position-relative row form-group mb-4 mb-1">
        <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary btn-save"
            data-route="@if (isset($genre)) {{ route('genre.update', $genre->id) }} @else {{ route('genre.store') }} @endif">
            <span class="btn-icon-wrapper pr-2 opacity-8">
                <i class="fa fa-download fa-w-20"></i>
            </span>
            <span>Save</span>
        </button>
    </div>
</form>
