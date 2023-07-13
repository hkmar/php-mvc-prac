<div class="container">
  <div class="col-8 mx-auto">
    <div class="card card-body">
      <h4 class="card-title">
        Edit post
      </h4>
      <form
        action="<?php echo URLROOT ?>/posts/edit/<?php echo $data['post_id'] ?>"
        method="post">
        <div class="form-group">
          <label for="title">Title</label>
          <input name="title" id="" value="<?php echo $data['title']?>"
            class="form-control <?php echo (!empty($data['title_error'])) ? "is-invalid" : "" ?>"></input>
          <span class="invalid-feedback"> <?php echo $data['title_error'] ?>
          </span>
        </div>
        <div class="form-group">
          <label for="body">Description</label>
          <textarea name="body" id="" rows="8"
            class="form-control <?php echo (!empty($data['body_error'])) ? "is-invalid" : "" ?>"><?php echo $data['body']?></textarea>
          <span class="invalid-feedback"> <?php echo $data['body_error'] ?>
          </span>
        </div>
        <div class="row">
          <button type="submit" class='btn btn-primary ml-auto mr-3'>Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>