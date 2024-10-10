<?= $this->extend('home') ?>
<?= $this->section('content') ?>

<form action="/users/<?= $user->id; ?>" method="POST">
    <h3>
        Update User at Id: <?= $user->id; ?>
    </h3>

    <div class="mb-3 row col-6">
        <?php csrf_field() ?>
        <input type="hidden" name="_method" value="PUT" />
        <input type="hidden" name="id" value="<?php echo $user->id; ?>">
        <label class="form-label" required>Name</label>
		<input type="text" class="form-control" name="name" value="<?= $user->name ?>" required>
	</div>
	<div class="mb-3 row col-6">
		<label class="form-label">Age</label>
		<input type="number" class="form-control"name="age" value="<?= $user->age ?>">
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<?= $this->endSection(); ?>