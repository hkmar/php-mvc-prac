<div class="row mb-3">
  <div class="col-md-6">
    <h1> Posts </h1>
  </div>
  <div class="col-md-6">
    <a href="<?php echo URLROOT ?>/posts/add" class="btn btn-primary float-right">
      <i class='fa fa-plus'></i> Add Post</a>
  </div>
</div>

<?php flash_msg('post_message') ?>
<?php foreach ($data['posts'] as $post): ?>
<div class="col-8 mx-auto card card-body mb-3">
  <h4 class="card-title">
    <?php echo $post->title ?>
  </h4>
  <p class='card-subtitle mb-2 text-muted'>
    by
    <?php echo $post->name ?>
  </p>
  <div class="card-text">
    <?php echo $post->body ?>
  </div>
  <a class="col-3 ml-auto btn btn-primary mt-3 float-right"
    href="<?php echo URLROOT ?>/posts/post/<?php echo $post->postID ?>">
    View post </a>
</div>
<?php endforeach; ?>