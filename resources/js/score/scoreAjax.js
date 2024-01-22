$(function () {
    var table = $('.score-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: scoreIndex,
        columns: [
        {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
        },
        {
            data: 'result',
            name: 'result',
        },
        {
            data: 'action',
            name: 'action',
            sortable: false,
            searchable: false,
        },
    ]
    });

    $('#addScore').click(function () {
        $('#exampleModalLabel').html("Tambah Score");
        $('#saveScore').show();
        $('#updateScore').hide();
        $('#saveScore').val("create-score");
        $('#score_id').val('');
        $('#scoreForm').trigger('reset');
        $('#scoreModal').modal('show');
    })

    $('#saveScore').click(function (e) {
        e.preventDefault();

        var formData = new FormData($("#scoreForm")[0]);

        var url = scoreStore;
        var method = "POST";

        $.ajax({
            data: formData,
            processData: false,
            contentType: false,
            url: url,
            type: method,
            dataType: 'json',
            success: function (data) {
                $('#scoreForm').trigger("reset");
                $('#scoreModal').modal('hide');
                table.draw();
                $('.error-message').remove();
                Swal.fire({
                    title: "Success!",
                    text: "Score Added Successfully",
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

    $('body').on('click', '.deleteScore', function () {
        var score_id = $(this).data('id');

        Swal.fire({
            title: 'You sure want to delete the score data ?',
            text: 'Deleted data can\'t be revert',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = scoreDelete.replace('score_id', score_id);

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        const dataTable = $('.score-table').DataTable();
                        dataTable.row(`[data-id="${data.id}"]`).remove().draw();
                        Swal.fire({
                            title: 'Score Deleted!',
                            icon: 'success',
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        alert('Failed to delete score data');
                    }
                });
            }
        });
     })
})
