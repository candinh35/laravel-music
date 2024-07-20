$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function validation() {
        $('.form-submit').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 191,
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 191
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"

                },
                price: {
                    required: true,
                },
                singer_id: {
                    required: true,
                },
                album_id: {
                    required: true,
                },
                genre_id: {
                    required: true,
                },
                file_url: {
                    required: true,
                },
                image: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Name là bắt buộc",
                    maxlength: "Name cannot be more than 20 characters"
                },
                email: {
                    required: "Email là bắt buộc",
                    email: "Email must be a valid email address",
                    maxlength: "Email cannot be more than 30 characters",
                },
                password: {
                    required: "Password là bắt buộc",
                    minlength: "Password must be at least 5 characters"
                },
                password_confirmation: {
                    required: "Confirm password là bắt buộc",
                    equalTo: "Password and confirm password should same"
                },
                price: {
                    required: "Price là bắt buộc",
                },
                singer_id: {
                    required: "Singer là bắt buộc",
                },
                album_id: {
                    required: "Album là bắt buộc",
                },
                genre_id: {
                    required: "Genre là bắt buộc",
                },
                file_url: {
                    required: "Audio là bắt buộc",
                },
                image: {
                    required: "Image là bắt buộc",
                },
            }

        });
    }
    function getTable(page = 1, search = '') {
        let url = $('.table-responsive').data('table');
        if (search != '') {
            const newUrl = window.location.pathname + "?page=" + encodeURIComponent(page) + '&search=' + encodeURIComponent(search);
            // Cập nhật URL mà không tải lại trang
            history.pushState({}, '', newUrl);
        } else if (search == '') {
            const newUrl = window.location.pathname;
            // Cập nhật URL mà không tải lại trang
            history.pushState({}, '', newUrl);
        }

        $.ajax({
            type: "GET",
            url: url + "?page=" + page + '&search=' + search,
            dataType: "html",
            success: function (data) {
                $('.table-responsive').empty().append(data);
            }
        });
    }
    // function create
    function create() {
        $(document).off('click', '.btn-create').on('click', '.btn-create', function (e) {
            e.preventDefault();
            let url = $(this).data('route');
            $.ajax({
                type: "GET",
                url: url,
                dataType: "html",
                success: function (response) {
                    $('.modal-body').empty().append(response);
                }
            });
            $(document).off('submit', '.form-submit').on('submit', '.form-submit', function (event) {
                validation();
                event.preventDefault();
                let urlStore = $('.btn-save').data('route');
                var formData = new FormData($('.form-submit')[0]);
                if ($('.form-submit').valid()) {
                    createOrUpdate("POST", urlStore, formData, 'Create')
                }
            });

        });
    }
    // function edit User
    function edit() {
        $(document).off('click', '.btn-edit').on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var url = $(this).data('route'); console.log($('.input-name').val());
            $.ajax({
                type: "GET",
                url: url,
                dataType: "html",
                success: function (response) {
                    $('.modal-body').empty().append(response);
                }
            });

            $(document).off('submit', '.form-submit').on('submit', '.form-submit', function (event) {
                validation();
                event.preventDefault();
                let urlUpdate = $('.btn-save').data('route');
                let formData = new FormData(this);
                if ($('.form-submit').valid()) {
                    createOrUpdate("POST", urlUpdate, formData, 'Update')
                }
            });
        })
    }
    // function common update and create
    function createOrUpdate(method, url, data, alert) {
        $.ajax({
            type: method,
            url: url,
            data: data,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                    $('.errMessage').empty();
                    Swal.fire(alert + ' successfully!', '', 'success')
                    $('.close').click();
                    getTable();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                let error = jqXHR.responseJSON;
                let _htmlError = '';
                _htmlError += `<div class="alert alert-danger alert-dismissible fade show" role="alert">`;
                $.each(error.errors, function (indexInArray, valueOfElement) {
                    _htmlError += `<div>${valueOfElement}</div>`
                });
                _htmlError += `</div>`
                $('.errMessage').html(_htmlError);
            }
        });
    }
    // function delete
    function deleteTable() {
        $(document).off('click', '.btn-delete').on('click', '.btn-delete', function (event) {
            let url = $(this).data('route');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#696cff',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function (data) {
                            Swal.fire('Delete successfully!', '', 'success')
                            let page = $('.page-item.active .page-link').html();
                            let search = $('.search-input').val();
                            getTable(page, search);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            Swal.fire(jqXHR.responseJSON.status, '', 'error')
                        }
                    });
                }
            })

        });
    }

    function paginate() {
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            let search = $('.search-input').val();
            getTable(page, search);
        });
    }

    function search() {
        $(document).off('input', '.search-input').on('input', '.search-input', function (event) {
            event.preventDefault();
            let value = $(this).val();
            if (value !== null) {

                getTable(1, value)
            }
        });
    }

    search();
    paginate();
    create();
    edit();
    deleteTable();
    getTable();
    validation();
});
