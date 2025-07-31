<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

	<div class="container d-flex justify-content-center align-items-center min-vh-100">
		<div class="col-lg-6 col-md-8 col-sm-10">
			<div class="card">
				<div class="card-body">
					<h3>Hello, <?= $this->session->userdata('name') ?></h3>
					<h4>Anda bergabung sejak <span class="text-success"> <?= $this->session->userdata('created_at') ?> </span> </h4>
					<hr>
					<h3>Profile anda</h3>
					<span>

						<?php
						$total_fields = 5;
						$filled = 0;

						if ($user->kode_user) $filled++;
						if ($user->email) $filled++;
						if ($user->name) $filled++;
						if ($user->address) $filled++;
						if ($user->phone) $filled++;

						$percentage = ($filled / $total_fields) * 100;
						?>

						<!-- Kelengkapan Profil -->
						<div class="mb-3">
							<label class="form-label fw-bold">Kelengkapan Profil: <?= round($percentage) ?>%</label>
							<div class="progress">
								<div class="progress-bar 
			<?= $percentage < 50 ? 'bg-danger' : ($percentage < 100 ? 'bg-warning' : 'bg-success') ?>"
									role="progressbar" style="width: <?= $percentage ?>%"
									aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100">
									<?= round($percentage) ?>%
								</div>
							</div>
						</div>

						<?php if ($percentage < 100): ?>
							<div class="alert alert-warning mt-3">
								Profil anda belum lengkap. Silakan lengkapi semua data.
							</div>
						<?php endif; ?>

						<!-- Tombol untuk membuka modal -->
						<button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addProfileModal">
							Tambah / Edit Data Profile
						</button>

						<!-- Modal Tambah/Edit Profile -->
						<div class="modal fade" id="addProfileModal" tabindex="-1" aria-labelledby="addProfileModalLabel" aria-hidden="true">
							<div class="modal-dialog ">
								<form action="<?= base_url('/auth/save_profile') ?>" method="post" id="profileForm" novalidate>
									<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
									<div class="modal-content">
										<?php if ($this->session->flashdata('errors')): ?>
											<div class="alert alert-danger">
												<?= $this->session->flashdata('errors') ?>
											</div>
										<?php endif; ?>

										<div class="modal-header">
											<h5 class="modal-title" id="addProfileModalLabel">Lengkapi Profil Anda</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<div class="mb-3">
												<label for="address" class="form-label">Alamat</label>
												<textarea class="form-control" id="address" name="address" rows="2" required><?= html_escape($user->address) ?></textarea>
											</div>
											<div class="mb-3">
												<label for="phone" class="form-label">No. Telepon</label>
												<input type="text" class="form-control" id="phone" name="phone" value="<?= html_escape($user->phone) ?>" required>
												<small id="phone-error" class="text-danger d-none">Hanya boleh angka</small>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-success">Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div>

					</span>

					<!-- Profile Info -->
					<p><?= $user->kode_user ?></p>
					<p><?= $user->name ?></p>
					<p><?= $user->email ?></p>
					<p><?= $user->address ?></p>
					<p><?= $user->phone ?></p>

					<!-- Tombol modal ubah password -->
					<a href="<?= base_url('/auth/ubah_password_view') ?>" target="_blank" class="btn btn-primary mt-2">
						Ubah password
					</a>

					<!-- Modal ubah password -->

					<!-- Modal Tambah/Edit Profile -->
					<div class="modal fade" id="updatePasswordModal" tabindex="-1" aria-labelledby="updatePasswordLabel" aria-hidden="true">
						<div class="modal-dialog ">
							<form action="<?= base_url('/auth/ubah_password') ?>" method="post">
								<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
								<div class="modal-content">
									<?php if ($this->session->flashdata('errors')): ?>
										<div class="alert alert-danger">
											<?= $this->session->flashdata('errors') ?>
										</div>
									<?php endif; ?>

									<div class="modal-header">
										<h5 class="modal-title" id="updatePasswordLabel">Ubah password anda</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<div class="mb-3">
											<label for="address" class="form-label">Password lama</label>
											<input type="text" class="form-control" id="passwordLama" name="passwordLama" required></input>
										</div>
										<div class="mb-3">
											<label for="phone" class="form-label">Password baru</label>
											<input type="text" class="form-control" id="passwordBaru" name="passwordBaru" required>
											<small id="p" class="text-danger d-none">Hanya boleh angka</small>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
										<button type="submit" class="btn btn-success">Simpan</button>
									</div>
								</div>
							</form>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>

	<!-- JavaScript Validasi -->
	<script>
		const phoneInput = document.getElementById('phone');
		const form = document.getElementById('profileForm');

		phoneInput.addEventListener('input', function() {
			const onlyDigits = /^\d*$/;
			if (!onlyDigits.test(phoneInput.value)) {
				phoneInput.classList.add('is-invalid');
			} else {
				phoneInput.classList.remove('is-invalid');
			}
		});

		form.addEventListener('submit', function(e) {
			if (!/^\d+$/.test(phoneInput.value)) {
				phoneInput.classList.add('is-invalid');
				e.preventDefault(); // Gagalkan submit jika bukan angka
			}
		});
	</script>

	<!-- Bootstrap Bundle JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
