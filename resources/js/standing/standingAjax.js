$(function () {
    var table = $('.standing-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: standingIndex,
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
            data: 'game_played',
            name: 'game_played',
        },
        {
            data: 'win',
            name: 'win',
        },
        {
            data: 'draw',
            name: 'draw',
        },
        {
            data: 'lose',
            name: 'lose',
        },
        {
            data: 'goal_scored',
            name: 'goal_scored',
        },
        {
            data: 'goal_conceded',
            name: 'goal_conceded',
        },
        {
            data: 'points',
            name: 'points',
        },
    ]
    });

    $('#addStanding').click(function () {
        $('#exampleModalLabel').html("Tambah Standing");
        $('#saveStanding').show();
        $('#updateStanding').hide();
        $('#saveStanding').val("create-standing");
        $('#standing_id').val('');
        $('#standingForm').trigger('reset');
        $('#standingModal').modal('show');
    })

    $('#saveStanding').click(function (e) {
        e.preventDefault();

        var formData = new FormData($("#standingForm")[0]);

        var url = standingStore;
        var method = "POST";

        $.ajax({
            data: formData,
            processData: false,
            contentType: false,
            url: url,
            type: method,
            dataType: 'json',
            success: function (data) {
                $('#standingForm').trigger("reset");
                $('#standingModal').modal('hide');
                table.draw();
                Swal.fire({
                    title: "Success!",
                    text: "Standing Berhasil Ditambahkan",
                    icon: "success",
                    timer: 3000
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });

    $('body').on('click', '.editStanding', function () {
        var standing_id = $(this).data('id');
        $.get(standingShow.replace('standing_id', standing_id), function (data) {
            $('#exampleModalLabel').html("Edit Standing");
            $('#saveStanding').hide();
            $('#updateStanding').show();
            $('#updateStanding').val("edit-standing");
            $('#standingModal').modal('show');
            $('#standing_id').val(data.id);
            $('#nama_standing').val(data.nama_standing);
        });
    });

    $('#updateStanding').click(function(e) {
        e.preventDefault();

        var standing_id = $('#standing_id').val();
        var url = standingUpdate.replace('standing_id', standing_id);
        var method = 'PUT';

        var formData = new FormData($('#standingForm')[0]);
        formData.append('_method', method);

        $.ajax({
            data: formData,
            url: url,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(data) {
                $('#standingForm').trigger("reset");
                $('#standingModal').modal('hide');
                table.draw();
                Swal.fire({
                    title: "Success!",
                    text: "Standing Berhasil di perbaharui",
                    icon: "success",
                    timer: 3000
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });

    $('body').on('click', '.deleteStanding', function () {
        var standing_id = $(this).data('id');

        Swal.fire({
            title: 'Yakin ingin menghapus data standing ?',
            text: 'Data standing yang dihapus tidak dapat dikembalikan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Urungkan'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = standingDelete.replace('standing_id', standing_id);

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        const dataTable = $('.standing-table').DataTable();
                        dataTable.row(`[data-id="${data.id}"]`).remove().draw();
                        Swal.fire({
                            title: 'Standing Berhasil Dihapus!',
                            icon: 'success',
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        alert('Data Gagal Dihapus');
                    }
                });
            }
        });
     })
})
