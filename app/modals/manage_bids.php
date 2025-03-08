<!-- Approve Bid -->
<div class="modal fade" id="accept_<?php echo $bids['bid_id']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ACCEPT BID PRICE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body text-center ">
                    <h4 class="text-danger">
                        Approve This Bid: <?php echo  $bids['bid_code']; ?>?
                    </h4>
                    <br>
                    <!-- Hide This -->
                    <input type="hidden" name="order_code" value="<?php echo $orders['order_code']; ?>">
                    <button type="button" class="text-center btn btn-success" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="text-center btn btn-danger" name="D">Yes, Accept</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Bid Approval -->


<!-- Decline Bid -->
<div class="modal fade" id="reject_<?php echo $bids['bid_id']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DECLINE BID</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body text-center ">
                    <h4 class="text-danger">
                        Decline This Bid: <?php echo  $bids['bid_code']; ?>?
                    </h4>
                    <br>
                    <!-- Hide This -->
                    <input type="hidden" name="bid_id" value="<?php echo $bids['bid_id']; ?>">
                    <button type="button" class="text-center btn btn-success" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="text-center btn btn-danger" name="Decline_Bid">Yes, Decline</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Decline -->