<?php


defined('BASEPATH') or exit('No direct script access allowed');


class DashboardModel extends  CI_Model
{

	private $table = 'anggota';

	public function insert_anggota($data)
	{
		$this->db->insert('anggota', $data);
		return $this->db->insert_id(); // return inserted ID
	}

	public function get_all_anggota()
	{
		// return $this->db->get('anggota')->result();

		$this->db->select('*');
		$this->db->from('anggota');
		$this->db->order_by('id_anggota', 'DESC');
		return $this->db->get()->result();
	}

	public function generateKodeAnggota()
	{
		$tanggal = date('Ymd');
		$this->db->select('id_anggota');
		$this->db->order_by('id_anggota', 'DESC');
		$this->db->limit(1);
		$last = $this->db->get($this->table)->row();

		$next = ($last) ? $last->id_anggota + 1 : 1;
		$kode = 'AGT' . str_pad($next, 4, '0', STR_PAD_LEFT) . $tanggal;
		return $kode;
	}

	public function update($id, $data)
	{
		$this->db->where('id_anggota', $id);
		return $this->db->update('anggota', $data);
	}
}
