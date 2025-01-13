<form method="post" enctype="multipart/form-data" class="form-submit">
    <div class="errMessage"></div>
    @if (isset($song))
        @method('put')
    @endif
    @csrf
    <div class="position-relative row form-group mb-3">
        <label for="song" class="col-md-3 text-md-right col-form-label">Song</label>
        <div class="col-md-9 col-xl-8">
            <div class="custom-file ">
                <input type="file" class="custom-file-input form-control" id="song"
                       accept=".mp3" name="file_url">
                <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>
        </div>
    </div>
    <div class="position-relative row form-group mb-3">
        <label for="image" class="col-md-3 text-md-right col-form-label">Image</label>
        <div class="col-md-9 col-xl-8">
            <div class="custom-file ">
                <input type="file" class="custom-file-input form-control" id="image"
                       accept=".jpg,.jpeg,.png" name="image">
                <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>
        </div>
    </div>
    <div class="position-relative row form-group mb-4">
        <label for="name" class="col-md-3 text-md-right col-form-label">Name</label>
        <div class="col-md-9 col-xl-8">
            <input  name="name" id="name" placeholder="Name" type="text"
                   class="form-control @error('name') border border-danger  @enderror"
                   value="@if (isset($song)) {{ $song->name }}  @endif">

        </div>
    </div>
    <div class="position-relative row form-group mb-4">
        <label for="price" class="col-md-3 text-md-right col-form-label">Price</label>
        <div class="col-md-9 col-xl-8">
                <input  name="price" id="price" placeholder="Price" type="number"
                       class="form-control @error('price') border border-danger  @enderror"
                       value="@if (isset($song)) {{ $song->price }} @else {{ old('price') }} @endif">
                
        </div>
    </div>
    <div class="position-relative row form-group mb-4">
        <label for="singer" class="col-md-3 text-md-right col-form-label">Singer</label>
        <div class="col-md-9 col-xl-8">
            <select  name="singer_id" id="singer"
                    class="form-control @error('role') border border-danger  @enderror">
                <option value="">-- Singer --</option>
                @foreach ($singers as $singer)
                    <option value="{{ $singer->id }}" @if(isset($song))
                        {{$song->singer_id == $singer->id ? 'selected' : ''}}
                        @endif>{{ $singer->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="position-relative row form-group mb-4">
        <label for="album" class="col-md-3 text-md-right col-form-label">Album</label>
        <div class="col-md-9 col-xl-8">
            <select  name="album_id" id="album"
                    class="form-control @error('role') border border-danger  @enderror">
                <option value="">-- Album --</option>
                @foreach ($albums as $album)
                    <option value="{{ $album->id }}" @if(isset($song))
                        {{ $song->album_id == $album->id ? 'selected' : ''}}
                        @endif>{{ $album->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="position-relative row form-group mb-4">
        <label for="genre" class="col-md-3 text-md-right col-form-label">Genre</label>
        <div class="col-md-9 col-xl-8">
            <select  name="genre_id" id="genre"
                    class="form-control @error('role') border border-danger  @enderror">
                <option value="">-- Genre --</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}"@if(isset($song))
                        {{$song->genre_id == $genre->id ? 'selected' : ''}}
                        @endif>{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="position-relative row form-group mb-4 mb-4 mb-1">
        <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary btn-save"
                data-route="@if (isset($song)) {{ route('song.update', $user->id) }} @else {{ route('song.store') }} @endif">
            <span class="btn-icon-wrapper pr-2 opacity-8">
                <i class="fa fa-download fa-w-20"></i>
            </span>
            <span>Save</span>
        </button>
    </div>
</form>
