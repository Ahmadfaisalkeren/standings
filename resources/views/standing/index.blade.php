@extends('template.index')

@section('title', 'Standings')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <p>Standings</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped standing-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Club Name</th>
                                        <th>Match Played</th>
                                        <th>Win</th>
                                        <th>Draw</th>
                                        <th>Lose</th>
                                        <th>Goal Scored</th>
                                        <th>Goal Conceded</th>
                                        <th>Points</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const standingIndex = '{{ route('standing.index') }}';
        </script>
    @endpush
@endsection
