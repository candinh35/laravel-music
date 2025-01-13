<form
    action=""
    method="post" enctype="multipart/form-data" class="form-submit" id="form-submit">
    <div class="errMessage"></div>
    @if (isset($user))
        @method('put')
    @endif
    @csrf
    <div class="position-relative row form-group mb-4">
        <label for="image" class="col-md-3 text-md-right col-form-label">Avatar</label>
        <div class="col-md-9 col-xl-8">
            <img style="height: 200px; cursor: pointer;" class="thumbnail rounded-circle"
                 data-toggle="tooltip" title="" data-placement="bottom"
                 accept=".jpg,.jpeg,.png"
                 src=" @if (isset($user->image) != null) {{ asset('uploads/' . $user->image) }}  @else {{ asset('template/admin/assets/images/add-image-icon.jpg') }} @endif"
                 alt="Avatar" data-original-title="Click to change the image">

            <input name="image" type="file" onchange="changeImg(this)" accept=".jpg,.jpeg,.png"
                   class="image form-control-file" style="display: none" value="">
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
                   class="form-control @error('name') border border-danger  @enderror "
                   value="@if (isset($user)) {{ $user->name }}@endif">
        </div>
    </div>
    <div class="position-relative row form-group mb-4">
        <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
        <div class="col-md-9 col-xl-8">
            <input  name="email" id="email" placeholder="Email" type="email"
                   @isset($user)
                       disabled=""
                   @endisset
                   class="form-control @error('email') border border-danger  @enderror"
                   value="@if (isset($user)) {{ $user->email }} @else {{ old('email') }} @endif">
        </div>
    </div>
    @if (!isset($user))
        <div class="position-relative row form-group mb-4">
            <label for="password" class="col-md-3 text-md-right col-form-label">Password</label>
            <div class="col-md-9 col-xl-8">
                <input name="password" id="password" placeholder="Password" type="password"
                       class="form-control @error('password') border border-danger  @enderror" value="">
            </div>
        </div>

        <div class="position-relative row form-group mb-4">
            <label for="password_confirmation" class="col-md-3 text-md-right col-form-label">Confirm
                Password</label>
            <div class="col-md-9 col-xl-8">
                <input name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"
                       type="password"
                       class="form-control @error('password_confirmation') border border-danger  @enderror"
                       value="">
            </div>
        </div>
    @endif
    <div class="position-relative row form-group mb-4">
        <label for="level" class="col-md-3 text-md-right col-form-label">Level</label>
        <div class="col-md-9 col-xl-8">
            <select  name="role" id="level"
                    class="form-control @error('role') border border-danger  @enderror">
                <option value="">-- Level --</option>
                <option value="1"
                @if (isset($user))
                    {{ $user->role == 1 ? 'selected' : '' }}
                    @endif>
                    Admin
                </option>
                <option value="0"
                @isset($user)
                    {{ $user->role == 0 ? 'selected' : '' }}
                    @endisset>
                    Client
                </option>
            </select>
        </div>
    </div>

    <div class="position-relative row form-group mb-4 mb-4 mb-1">
        <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary btn-save"
                data-route="@if (isset($user)) {{ route('user.update', $user->id) }} @else {{ route('user.store') }} @endif">
            <span class="btn-icon-wrapper pr-2 opacity-8">
                <i class="fa fa-download fa-w-20"></i>
            </span>
            <span>Save</span>
        </button>
    </div>
</form>
