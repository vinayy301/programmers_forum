<?php
echo'<!-- Modal -->
<div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginmodal">iDiscuss- Account Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="./partials/handle_login_page.php" method="post" >
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="pass" class="form-label">Password</label>
        <input type="password" class="form-control" id="pass" name="pass">
      </div>
     
      <div class="d-grid gap-2 col-1 mx-auto">
      <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
      </div>
      </div>
    </div>
  </div>'
  ?>
      