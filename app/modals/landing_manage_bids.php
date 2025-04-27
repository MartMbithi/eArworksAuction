<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="space-bottom-30">
                        <div class="ec-vendor-upload-detail">
                            You are about to rebid this bid, kindly enter a new bid amount which is higher than the current bid amount.
                            <form class="row g-3" method="POST" enctype="multipart/form-data">
                                <div class="col-md-6 space-t-15">
                                    <label class="form-label">First name</label>
                                    <input type="hidden" name="bid_date" value="<?php echo date('d M Y g:ia'); ?>">
                                    <input type="hidden" name="bid_id" value="<?php echo $orders['bid_id']; ?>" required class="form-control">
                                    <input type="number" name="bid_cost" required class="form-control">
                                </div>
                                <div class="col-md-12 space-t-15 text-right">
                                    <button type="submit" name="Ammend_Bid" class="btn btn-primary">Update</button>
                                    <a href="#" class="btn btn-lg btn-secondary qty_close" data-bs-dismiss="modal" aria-label="Close">Close</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>