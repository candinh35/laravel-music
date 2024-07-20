<form
    action=""
    method="post" enctype="multipart/form-data" class="form-submit">
    @if (isset($album))
        @method('put')
    @endif
    @csrf
    <div class="position-relative row form-group mb-4">
        <label for="image" class="col-md-3 text-md-right col-form-label">Avatar</label>
        <div class="col-md-9 col-xl-8">
            <img style="height: 200px; cursor: pointer;" class="thumbnail rounded-circle"
                 data-toggle="tooltip" title="" data-placement="bottom"
                 accept=".jpg,.jpeg,.png"
                 src=" @if (isset($album->image) != null) {{ asset('uploads/' . $album->image) }}  @else {{ asset('template/admin/assets/images/add-image-icon.jpg') }} @endif"
                 alt="Avatar" data-original-title="Click to change the image">
            <input name="image" type="file" onchange="changeImg(this)" accept=".jpg,.jpeg,.png"
                   class="image form-control-file" style="display: none;" value="">
            <input type="hidden" name="image_old" value="" accept=".jpg,.jpeg,.png">
            <small class="form-text text-muted">
                Click on the image to change (required)
            </small>
        </div>
    </div>
    <div class="position-relative row form-group mb-4">
        <label for="name" class="col-md-3 text-md-right col-form-label">Name</label>
        <div class="col-md-9 col-xl-8">
            <input  name="name" id="name" placeholder="Name" type="text"
                   class="form-control @error('name') border border-danger  @enderror"
                   value="@if (isset($album)) {{ $album->name }} @endif">
        </div>
    </div>
    <div class="position-relative row form-group mb-4">
        <label for="description" class="col-md-3 text-md-right col-form-label">Description</label>
        <div class="col-md-9 col-xl-8">
                                    <textarea name="description" id="description" cols="30" rows="10"
                                              class="form-control @error('description') border border-danger  @enderror">
                                        @if (isset($album))
                                            {{ $album->description }}
                                        @else
                                            {{ old('description') }}
                                        @endif
                                        </textarea>
        </div>
    </div>
    <div class="position-relative row form-group mb-1">
        <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary btn-save"
                data-route="@if (isset($album)) {{ route('album.update', $album->id) }} @else {{ route('album.store') }} @endif">
            <span class="btn-icon-wrapper pr-2 opacity-8">
                <i class="fa fa-download fa-w-20"></i>
            </span>
            <span>Save</span>
        </button>
    </div>
</form>

