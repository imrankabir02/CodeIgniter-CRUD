<?= $this->extend('home') ?>
<?= $this->section('content') ?>
<?= $this->include('Templates/header') ?>

<p>
    Hello, <strong><?= $user->name ?></strong>! <br>
    You are <?= $user->age ?> years old!

    See your Mates <a href="<?= base_url('users/') ?>">here</a>
</p>
<?= $this->endSection() ?>