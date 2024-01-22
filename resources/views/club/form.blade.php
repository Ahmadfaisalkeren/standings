<div class="modal fade" id="clubModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="clubForm" name="clubForm">
                    <input type="hidden" name="club_id" id="club_id">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="club_name" class="col-sm-2 control-label">Club Name</label>
                                <div class="col-lg-12">
                                    <input type="text" name="club_name" id="club_name" class="form-control"
                                        placeholder="Club Name" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-sm-2 control-label">City</label>
                                <div class="col-lg-12">
                                    <input type="text" name="city" id="city" class="form-control"
                                        placeholder="City" value="" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 mt-2">
                            <button type="submit" class="btn btn-primary btn-sm" id="saveClub"><i
                                    class="fas fa-plus"></i> Add Club</button>
                            <button type="submit" class="btn btn-primary btn-sm" id="updateClub"><i
                                    class="far fa-edit"></i> Update Club</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
