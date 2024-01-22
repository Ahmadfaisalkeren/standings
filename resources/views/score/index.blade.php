@extends('template.index')

@section('title', 'Score')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary btn-sm" id="addScore">
                                    <i class="fas fa-plus"></i> Add Score
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped score-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Result</th>
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

    @include('score.form')

    @push('scripts')
        <script>
            const scoreIndex = '{{ route('score.index') }}';
            const scoreStore = '{{ route('score.store') }}';
            const scoreDelete = '{{ route('score.destroy', ['id' => 'score_id']) }}';
        </script>
    @endpush
@endsection
