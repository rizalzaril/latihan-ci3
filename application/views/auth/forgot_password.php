<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lupa Password</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

	<div class="container mt-5">
		<div class="row justify-content-center">

			<div class="col-md-6">

				<h2 class="text-center mb-4">Lupa Password</h2>

				<!-- Flash message -->
				<?php if ($this->session->flashdata('error')): ?>
					<div class="alert alert-danger">
						<?= html_escape($this->session->flashdata('error')) ?>
					</div>
				<?php endif; ?>

				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success">
						<?= html_escape($this->session->flashdata('success')) ?>
					</div>
				<?php endif; ?>

				<!-- Menampilkan validasi error -->
				<?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

				<!-- Form dengan proteksi CSRF -->
				<?= form_open('auth/forgot_password') ?>

				<div class="mb-3">
					<label for="email" class="form-label">Email</label>
					<input type="email" class="form-control" id="email" name="email" required
						value="<?= html_escape(set_value('email')) ?>">
				</div>

				<button type="submit" class="btn btn-primary w-100">Kirim Link Reset</button>

				<?= form_close() ?>

				<div class="text-center mt-3">
					<?php if ($this->session->flashdata('reset_link')): ?>
						<p>Link reset password telah dibuat:</p>
						<a href="<?= $this->session->flashdata('reset_link') ?>" class="btn btn-sm btn-primary" target="_blank">Reset Password</a>
					<?php endif; ?>
				</div>


			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>