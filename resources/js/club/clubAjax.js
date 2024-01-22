$(function () {
    var table = $('.club-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: clubIndex,
        columns: [
        {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
        },
        {
            data: 'club_name',
            name: 'club_name',
        },
        {
            data: 'city',
            name: 'city',
        },
        {
            data: 'action',
            name: 'action',
            sortable: false,
            searchable: false,
        },
    ]
    });

    $('#addClub').click(function () {
        $('#exampleModalLabel').html("Add Club");
        $('#saveClub').show();
        $('#updateClub').hide();
        $('#saveClub').val("create-club");
        $('#club_id').val('');
        $('#clubForm').trigger('reset');
        $('#clubModal').modal('show');
    })

    $('#saveClub').click(function (e) {
        e.preventDefault();

        var formData = new FormData($("#clubForm")[0]);

        var url = clubStore;
        var method = "POST";

        $.ajax({
            data: formData,
            processData: false,
            contentType: false,
            url: url,
            type: method,
            dataType: 'json',
            success: function (data) {
                $('#clubForm').trigger("reset");
                $('#clubModal').modal('hide');
                table.draw();
                Swal.fire({
                    title: "Success!",
                    text: "Club Added Successfully",
                    icon: "success",
                    timer: 3000
                });
            },
            error: function(response) {
                $('.error-message').remove();

                if (response.responseJSON && response.responseJSON.errors) {
                    $.each(response.responseJSON.errors, function(field, messages) {
                        $.each(messages, function(index, message) {
                            $('#' + field).after('<span class="text-danger error-message">' + message + '</span>');
                        });
                    });
                } else {
                    console.log('Error:', response);
                }
            }
        });
    });

    $('body').on('click', '.editClub', function () {
        var club_id = $(this).data('id');
        $.get(clubShow.replace('club_id', club_id), function (data) {
            $('#exampleModalLabel').html("Edit Club");
            $('#saveClub').hide();
            $('#updateClub').show();
            $('#updateClub').val("edit-club");
            $('#clubModal').modal('show');
            $('#club_id').val(data.id);
            $('#club_name').val(data.club_name);
            $('#city').val(data.city);
        });
    });

    $('#updateClub').click(function(e) {
        e.preventDefault();

        var club_id = $('#club_id').val();
        var url = clubUpdate.replace('club_id', club_id);
        var method = 'PUT';

        var formData = new FormData($('#clubForm')[0]);
        formData.append('_method', method);

        $.ajax({
            data: formData,
            url: url,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(data) {
                $('#clubForm').trigger("reset");
                $('#clubModal').modal('hide');
                table.draw();
                Swal.fire({
                    title: "Success!",
                    text: "Club Updated Successfully",
                    icon: "success",
                    timer: 3000
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });

    $('body').on('click', '.deleteClub', function () {
        var club_id = $(this).data('id');

        Swal.fire({
            title: 'You sure want to delete the club data ?',
            text: 'Deleted data can\'t be revert',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = clubDelete.replace('club_id', club_id);

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        const dataTable = $('.club-table').DataTable();
                        dataTable.row(`[data-id="${data.id}"]`).remove().draw();
                        Swal.fire({
                            title: 'Club Data Deleted!',
                            icon: 'success',
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        alert('Failed to delete club data');
                    }
                });
            }
        });
     })
})
