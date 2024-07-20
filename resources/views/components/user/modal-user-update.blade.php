<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form-update" action="" method="post" enctype="multipart/form-data">
            <div class="errMessage"></div>
            <div class="modal-body">
                <div class="card-body">
                    @csrf
                    <div class="position-relative row form-group">
                        <label for="image" class="col-md-3 text-md-right col-form-label">Avatar</label>
                        <div class="col-md-9 col-xl-8">
                            <img style="height: 200px; cursor: pointer;" class="thumbnail rounded-circle"
                                data-toggle="tooltip" title="" data-placement="bottom"
                                accept=".jpg,.jpeg,.png"
                                src="{{ asset('template/admin/assets/images/add-image-icon.jpg') }}" alt="Avatar"
                                data-original-title="Click to change the image">
                            <input name="image" type="file" onchange="changeImg(this)" accept=".jpg,.jpeg,.png"
                                class="image form-control-file" style="display: none;" value="">
                            <input type="hidden" name="image_old" value="" accept=".jpg,.jpeg,.png">
                            <small class="form-text text-muted">
                                Click on the image to change (required)
                            </small>
                        </div>
                    </div>
                    <div class="position-relative row form-group mt-3">
                        <label for="name" class="col-md-3 text-md-right col-form-label">Name</label>
                        <div class="col-md-9 col-xl-8">
                            <input required="" name="name" id="name" placeholder="Name" type="text"
                                class="form-control name" value="">
                        </div>
                    </div>

                    <div class="position-relative row form-group mt-3">
                        <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                        <div class="col-md-9 col-xl-8">
                            <input required="" name="email" id="email" placeholder="Email" type="email"
                                class="form-control  email" value="">
                        </div>
                    </div>
                    <div class="position-relative row form-group mt-3">
                        <label for="level" class="col-md-3 text-md-right col-form-label">Level</label>
                        <div class="col-md-9 col-xl-8">
                            <select required="" name="role" id="level" class="form-control role">
                                <option value="">-- Level --</option>
                                <option value="1">
                                    Admin
                                </option>
                                <option value="0">
                                    Client
                                </option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary button_user_update">Save changes</button>
            </div>
        </form>

    </div>
</div>
</div>