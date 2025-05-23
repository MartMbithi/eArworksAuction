<div class="modal fade" id="delete_staff_<?php echo $customers['user_id']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body text-center ">
                    <h4 class="text-danger">
                        Delete <?php echo  $customers['user_first_name'] . ' ' . $customers['user_last_name']; ?>?
                    </h4>
                    <br>
                    <!-- Hide This -->
                    <input type="hidden" name="user_id" value="<?php echo $customers['user_id']; ?>">
                    <button type="button" class="text-center btn btn-success" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="text-center btn btn-danger" name="Delete_User">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Verify -->
<div class="modal fade" id="verify_<?php echo $customers['user_id']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verify Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body text-center ">
                    <h4 class="text-danger">
                        Verify <?php echo  $customers['user_first_name'] . ' ' . $customers['user_last_name']; ?>?
                    </h4>
                    <br>
                    <!-- Hide This -->
                    <input type="hidden" name="user_id" value="<?php echo $customers['user_id']; ?>">
                    <button type="button" class="text-center btn btn-success" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="text-center btn btn-danger" name="Verify_Account">Yes, Verify</button>
                </div>
            </form>
        </div>
    </div>
</div>