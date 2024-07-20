<div class="tab-pane fade active show" id="playlist">
    <div class="row list-row">@php $i = 0 @endphp
        @forelse($playlists as $playlist)
            <div class="col-6 col-sm-4" data-id="312058991" data-category="all"
                data-tag="France"
                data-source="https://audio-ssl.itunes.apple.com/apple-assets-us-std-000001/AudioPreview62/v4/04/b6/28/04b62834-121f-b3af-47b3-2485ff499e14/mzaf_4474193750897158038.plus.aac.p.m4a">
                <div class="list-item r">
                    <div class="media col-4"><a href="" class="ajax media-content"
                            style="background-image:url({{ asset('uploads/' . $playlist->image) }})"
                            data-pjax-state=""></a>
                        <div class="media-action media-action-overlay">
                            <button class="btn btn-icon no-bg no-shadow hide-row"
                                data-toggle-class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-heart active-danger">
                                    <path
                                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                    </path>
                                </svg>
                            </button>
                            <div data-index="@php echo $i; $i++; @endphp"
                                class="playpause-track1"><i class="fa fa-play-circle fa-3x"></i>
                            </div>
                            <button class="btn btn-icon no-bg no-shadow hide-row btn-more"
                                data-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-more-horizontal">
                                    <circle cx="12" cy="12" r="1">
                                    </circle>
                                    <circle cx="19" cy="12" r="1">
                                    </circle>
                                    <circle cx="5" cy="12" r="1">
                                    </circle>
                                </svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right"></div>
                        </div>
                    </div>
                    <div class="list-content text-center">
                        <div class="list-body">
                            <a href="" class="list-title title ajax h-1x"
                                data-pjax-state="">{{ $playlist->name }}</a>
                            <button class="btn btn-icon no-bg no-shadow btn-more"
                                data-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-more-horizontal">
                                    <circle cx="12" cy="12" r="1">
                                    </circle>
                                    <circle cx="19" cy="12" r="1">
                                    </circle>
                                    <circle cx="5" cy="12" r="1">
                                    </circle>
                                </svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right text-center">
                                <form action="" method="post" class="delete-playlist">
                                    @csrf
                                    <input type="hidden" name="song_id"
                                        value="{{ $playlist->id }}">
                                    <input type="hidden" name="user_id"
                                        value="{{ Auth::guard('cus')->id() }}">
                                    <button class="btn btn-outline-danger btn-delete"
                                        data-route="{{ route('playlist.delete') }}"
                                        data-pjax-state="">Delete <i
                                            class="fa-solid fa-trash ml-2"></i></a>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        @empty
            <div style="padding: 94px; font-size: 20px" class="text-blue">
                <img width="530" src="{{ asset('template/client/assets/img/empty.jpg') }}"
                    alt="">
            </div>
        @endforelse
    </div>
</div>