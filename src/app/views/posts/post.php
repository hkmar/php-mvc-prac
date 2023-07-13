<div class="row">
  <div class="col-8 mx-auto">
    <div class="card card-body">
      <h5 class="card-title">
        <?php echo $data['title'] ?>
      </h5>
      <div class="card-subtitle">
        <?php echo $data['author'] ?>
      </div>
      <div class="card-text">
        <?php echo $data['body'] ?>
      </div>
      <div class="row">
        <a href="<?php echo URLROOT ?>/posts/edit/<?php echo $data['post_id'] ?>"
          class="btn btn-primary ml-auto mr-3">
          Edit post</a>
        <a href="<?php echo URLROOT ?>/posts/delete/<?php echo $data['post_id'] ?>"
          class="btn btn-primary mr-3"> Delete
          post</a>
      </div>
    </div>
  </div>
</div>