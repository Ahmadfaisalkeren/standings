<div class="modal fade" id="scoreModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="scoreForm" name="scoreForm" enctype="multipart/form-data">
                    <input type="hidden" name="score_id" id="score_id">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="home_club_id" class="control-label">Home Club</label>
                                <select class="form-select" id="home_club_id" name="home_club_id">
                                    <option selected>Choose Club ...</option>
                                    @foreach ($clubData as $item)
                                        <option value="{{ $item->id }}">{{ $item->club_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="away_club_id" class="control-label">Away Club</label>
                                <select class="form-select" id="away_club_id" name="away_club_id">
                                    <option selected>Choose Club ...</option>
                                    @foreach ($clubData as $item)
                                        <option value="{{ $item->id }}">{{ $item->club_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="home_score" class="control-label">Home Score</label>
                                <input type="number" class="form-control" id="home_score" name="home_score" placeholder="Enter Home Score">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="away_score" class="control-label">Away Score</label>
                                <input type="number" class="form-control" id="away_score" name="away_score" placeholder="Enter Away Score">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 mt-2">
                            <button type="submit" class="btn btn-primary btn-sm" id="saveScore"><i class="fas fa-plus"></i> Add Score</button>
                            <button type="submit" class="btn btn-primary btn-sm" id="updateScore"><i class="far fa-edit"></i> Update Score</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
