@extends('template.index')

@section('title', 'Club')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <p>Data Club</p>
                                <button class="btn btn-primary btn-xs" id="addClub"><i class="fas fa-plus"></i> Add Club</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped club-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Club Name</th>
                                        <th>City</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('club.form')

    @push('scripts')
        <script>
            const clubIndex = '{{ route('club.index') }}';
            const clubStore = '{{ route('club.store') }}';
            const clubShow = '{{ route('club.edit', ['id' => 'club_id']) }}';
            const clubUpdate = '{{ route('club.update', ['id' => 'club_id']) }}';
            const clubDelete = '{{ route('club.destroy', ['id' => 'club_id']) }}';
        </script>
    @endpush
@endsection
