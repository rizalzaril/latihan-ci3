<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tambah Anggota</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.required {
			color: red;
		}
	</style>
</head>

<body>

	<div class="container mt-5">
		<h2 class="mb-4">Form Tambah Anggota</h2>

		<div class="container">

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

			<form action="<?= site_url('dashboard/store_anggota') ?>" method="POST">

				<div class="mb-3">
					<label for="nama_lengkap" class="form-label">Nama Lengkap <span class="required">*</span></label>
					<input type="text" name="nama_lengkap" class="form-control" required>
				</div>

				<div class="mb-3">
					<label class="form-label">Jenis Kelamin <span class="required">*</span></label><br>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="jenis_kelamin" value="L" checked>
						<label class="form-check-label">Laki-laki</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="jenis_kelamin" value="P">
						<label class="form-check-label">Perempuan</label>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 mb-3">
						<label for="tempat_lahir" class="form-label">Tempat Lahir</label>
						<input type="text" name="tempat_lahir" class="form-control">
					</div>
					<div class="col-md-6 mb-3">
						<label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
						<input type="date" name="tanggal_lahir" class="form-control">
					</div>
				</div>

				<div class="mb-3">
					<label for="alamat" class="form-label">Alamat</label>
					<textarea name="alamat" class="form-control" rows="3"></textarea>
				</div>

				<div class="mb-3">
					<label for="no_telepon" class="form-label">No. Telepon</label>
					<input type="text" name="no_telepon" class="form-control">
				</div>

				<div class="mb-3">
					<label for="email" class="form-label">Email (opsional)</label>
					<input type="email" name="email" class="form-control">
				</div>

				<div class="mb-3">
					<label for="status" class="form-label">Status</label>
					<select name="status" class="form-select">
						<option value="aktif" selected>Aktif</option>
						<option value="nonaktif">Nonaktif</option>
					</select>
				</div>

				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?= site_url('anggota') ?>" class="btn btn-secondary">Kembali</a>
			</form>
		</div>
	</div>

</body>

</html>