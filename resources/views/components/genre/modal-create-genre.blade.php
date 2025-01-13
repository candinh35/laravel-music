<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-add" action="" method="post" enctype="multipart/form-data">
                <div class="errMessage"></div>
                <div class="modal-body">
                    <div class="card-body">
                        @csrf
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary button_user_create">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
