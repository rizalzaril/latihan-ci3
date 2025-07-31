<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<title>Reset Password</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-6">

				<h2 class="text-center mb-4">Reset Password</h2>

				<?php if ($this->session->flashdata('error')): ?>
					<div class="alert alert-danger"><?= html_escape($this->session->flashdata('error')) ?></div>
				<?php endif; ?>

				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success"><?= html_escape($this->session->flashdata('success')) ?></div>
				<?php endif; ?>

				<?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

				<?= form_open('auth/reset_password?token=' . $token) ?>
				<div class="mb-3">
					<label for="password" class="form-label">Password Baru</label>
					<input type="password" class="form-control" id="password" name="password" required>
				</div>

				<div class="mb-3">
					<label for="password_confirm" class="form-label">Konfirmasi Password</label>
					<input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
				</div>

				<button type="submit" class="btn btn-primary w-100">Ganti Password</button>
				<?= form_close() ?>

			</div>
		</div>
	</div>
</body>

</html>