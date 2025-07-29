<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
	<div class="row justify-content-center">

		<div class="col-md-6">

			<h2 class="text-center mb-4">Daftar Akun</h2>

			<!-- Flash message -->
			<?php if ($this->session->flashdata('success')): ?>
				<p style="color: green;"><?= html_escape($this->session->flashdata('success')) ?></p>
			<?php endif; ?>

			<?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

			<?= form_open('auth/register') ?>

			<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
				value="<?= $this->security->get_csrf_hash(); ?>" />

			<div class="mb-3">
				<label for="name" class="form-label">Nama</label>
				<input type="text" class="form-control" id="name" name="name" required
					value="<?= html_escape(set_value('name')) ?>">
			</div>

			<div class="mb-3">
				<label for="email" class="form-label">Email</label>
				<input type="email" class="form-control" id="email" name="email" required
					value="<?= html_escape(set_value('email')) ?>">
			</div>

			<div class="mb-3">
				<label for="password" class="form-label">Password</label>
				<input type="password" class="form-control" id="password" name="password" required>
			</div>

			<button type="submit" class="btn btn-primary w-100">Daftar</button>
			<?= form_close() ?>

		</div>
	</div>
</div>