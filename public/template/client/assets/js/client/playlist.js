$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function addPlaylist() {

    $(document).off('submit', '.form-add-playlist').on('submit', '.form-add-playlist', function (e) {
        e.preventDefault();
        let route = $('.btn-add').data('route');
        let data = new FormData(this);
        $.ajax({
            type: 'post',
            url: route,
            data: data,
            contentType: false,
            processData: false,
            success: function (data) {
                Swal.fire('Added new to playlist successfully!', '', 'success')
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire(jqXHR.responseJSON.status, '', 'error')
            }

        });
    })

}

function downloadMp3() {
    $(document).off('submit', '.form-download').on('submit', '.form-download', function (e) {
        e.preventDefault();
        let route = $('.btn-download').data('route');
        let data = new FormData(this);
        Swal.fire({
            title: 'Are you sure download?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, download it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: route,
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        var a = document.createElement('a');
                        a.href = data;
                        a.download = data;
                        $('body').append(a);
                        a.click();
                        $(a).remove();
                        Swal.fire('Download successfully!', '', 'success')
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        Swal.fire(jqXHR.responseJSON.status, '', 'error')
                    }

                });
            }
        })

    })
}

function deletePlaylist() {
    $(document).off('submit', '.delete-playlist').on('submit', '.delete-playlist', function (e) {
        e.preventDefault();
        let route = $('.btn-delete').data('route');
        let data = new FormData(this);
        Swal.fire({
            title: 'Are you sure download?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, download it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: route,
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        getPlaylist();
                        Swal.fire('Delete playlist successfully!', '', 'success')
                    }, error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR, textStatus, errorThrown);
                        Swal.fire(jqXHR.responseJSON.status, '', 'error')
                    }
                });

            }
        })
    })
}


function getPlaylist()
{
    let route = $('.tab-content').data('route')
    $.ajax({
        type: "get",
        url: route,
        dataType: "html",
        success: function (response) {
            $('.tab-content').empty().append(response);
        }
    });
}
getPlaylist();
deletePlaylist();
addPlaylist();
downloadMp3();