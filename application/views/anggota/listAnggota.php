<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<title>Daftar Anggota</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		@media (max-width: 768px) {
			.table-responsive .table thead {
				display: none;
			}

			.table-responsive .table tbody tr {
				display: block;
				margin-bottom: 1rem;
				border: 1px solid #dee2e6;
				border-radius: 0.5rem;
				padding: 0.75rem;
			}

			.table-responsive .table tbody td {
				display: flex;
				justify-content: space-between;
				padding: 0.5rem 0;
				border: none;
			}

			.table-responsive .table tbody td::before {
				content: attr(data-label);
				font-weight: bold;
				color: #6c757d;
			}
		}
	</style>
</head>

<body>

	<div class="container mt-5">
		<h2 class="mb-4">Daftar Anggota</h2>

		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
		<?php endif; ?>

		<a href="<?= site_url('dashboard/create_anggota') ?>" class="btn btn-primary mb-3">Tambah Anggota</a>

		<div class="table-responsive">
			<table class="table table-bordered table-striped align-middle">
				<thead class="table-dark text-center">
					<tr>
						<th>#</th>
						<th>Kode Anggota</th>
						<th>Nama Lengkap</th>
						<th>Jenis Kelamin</th>
						<th>Tempat, Tanggal Lahir</th>
						<th>Alamat</th>
						<th>No. Telepon</th>
						<th>Email</th>
						<th>Tanggal Daftar</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($list_anggota)): ?>
						<?php $no = 1;
						foreach ($list_anggota as $anggota): ?>
							<tr>
								<td data-label="#"> <?= $no++ ?> </td>
								<td data-label="Kode Anggota"> <?= $anggota->kode_anggota ?> </td>
								<td data-label="Nama Lengkap"> <?= $anggota->nama_lengkap ?> </td>
								<td data-label="Jenis Kelamin"> <?= $anggota->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' ?> </td>
								<td data-label="Tempat, Tgl Lahir"> <?= $anggota->tempat_lahir . ', ' . date('d-m-Y', strtotime($anggota->tanggal_lahir)) ?> </td>
								<td data-label="Alamat"> <?= $anggota->alamat ?> </td>
								<td data-label="No. Telepon"> <?= $anggota->no_telepon ?> </td>
								<td data-label="Email"> <?= $anggota->email ?> </td>
								<td data-label="Tanggal Daftar"> <?= date('d-m-Y', strtotime($anggota->tanggal_daftar)) ?> </td>
								<td data-label="Status">
									<span class="badge <?= $anggota->status == 'aktif' ? 'bg-success' : 'bg-secondary' ?>">
										<?= ucfirst($anggota->status) ?>
									</span>
								</td>
								<td data-label="Aksi" class="text-center">
									<div class="d-flex justify-content-center gap-2 flex-wrap">
										<a href="<?= site_url('anggota/edit/' . $anggota->id_anggota) ?>" class="btn btn-sm btn-warning">Edit</a>
										<a href="<?= site_url('anggota/delete/' . $anggota->id_anggota) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus anggota ini?')">Hapus</a>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="11" class="text-center text-muted">Belum ada data anggota.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>

</body>

</html>