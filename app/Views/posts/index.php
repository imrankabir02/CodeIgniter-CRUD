<?php $this->extend("layouts/layout"); ?>

<?php $this->section("title"); ?>
Posts
<?php $this->endsection(); ?>

<?php $this->section("content"); ?>
<div class="row my-5">
    <?php if ($posts) : ?>
        <?php foreach ($posts as $post) : ?>
            <div class="col-4">
                <div class="card" style="width: 18rem;">

                    <span class="badge bg-danger">
                        <?= $post->created_at ? date("Y-m-d H:i:s", strtotime($post->created_at)) : date("Y-m-d H:i:s", strtotime($post->updated_at)); ?>
                    </span>

                    <h5 class="card-title"><?= $post->title ?? 'No Title'; ?></h5>
                    <p class="card-text"><?= $post->description ?? 'No Description'; ?></p>

                    <!-- <a href="<?= site_url('/posts/show/' . $post->id); ?>" class="btn btn-primary">Read more</a> -->
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="alert alert-info">
            Nothing found
            <a href="/posts/create">
                Add new article
            </a>
        </div>
    <?php endif ?>
</div>
<?php $this->endsection(); ?>