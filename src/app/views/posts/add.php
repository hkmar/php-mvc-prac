<div class="container">
  <div class="col-8 mx-auto">
    <div class="card card-body">
      <h4 class="card-title">
        Edit post
      </h4>
      <form action="<?php echo URLROOT ?>/posts/add" method="post">
        <div class="form-group">
          <label for="title">Title</label>
          <input name="title" id="" class='form-control'></input>
        </div>
        <div class="form-group">
          <label for="body">Description</label>
          <textarea name="body" id="" class='form-control' rows="8"></textarea>
        </div>
        <div class="row">
          <button type="submit" class='btn btn-primary ml-auto mr-3'>Publish</button>
        </div>
      </form>
    </div>
  </div>
</div>