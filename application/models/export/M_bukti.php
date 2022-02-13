<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bukti extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = $this->start();
		$data['title'][1] = '';
		
		/*$data['html'] = report($data['table'],
						$data['field'],
						$data['condition'],
						$data['fn'],$data['start'],$data['width'],$data['title']);*/

		$pj = select2($data['table'],$data['field'],$data['condition']);
		$js = select2("jenis_surat","*","WHERE id_jenis_surat='$pj[id_jenis_surat]'");
		$mhs = select2(
			"mahasiswa a",
			"*,
			(SELECT c.name FROM konsentrasi b,prodi c WHERE a.id_konsentrasi=b.id_konsentrasi AND b.id_prodi=c.id_prodi) as prodi,
			(SELECT c.strata FROM konsentrasi b,prodi c WHERE a.id_konsentrasi=b.id_konsentrasi AND b.id_prodi=c.id_prodi) as strata,
			(SELECT c.gelar_sebutan FROM konsentrasi b,prodi c WHERE a.id_konsentrasi=b.id_konsentrasi AND b.id_prodi=c.id_prodi) as gelar_sebutan,
			(SELECT c.gelar_singkatan FROM konsentrasi b,prodi c WHERE a.id_konsentrasi=b.id_konsentrasi AND b.id_prodi=c.id_prodi) as gelar_singkatan,
			(SELECT b.name FROM konsentrasi b WHERE a.id_konsentrasi=b.id_konsentrasi) as konsentrasi",
			"WHERE id_mahasiswa='$pj[id_mahasiswa]'"
		);

		$data['html'] = '
		<table width="100%" style="border: 2px solid black; width: 14cm; font-family: arial; font-size: 12pt; " border="0" cellpadding="1">
			<tr>
				<td style="font-size: 14pt; font-weight: bold; text-align: center; padding-top: 15px">
					Sistem Informasi Administrasi Pelayanan Akademik
				</td>
			</tr>
			<tr>
				<td style="font-size: 14pt; font-weight: bold; text-align: center">(SIAPIK)</td>
			</tr>
			<tr>
				<td style="font-size: 14pt; font-weight: bold; text-align: center">Pascasarjana Universitas Halu Oleo
					<hr style="border: 1px solid black">
				</td>
			</tr>

			<tr>
				<td style="padding-top: 20px; font-size: 16pt; font-weight: bold; text-align: center; text-decoration: underline">
					BUKTI PENGAJUAN
				</td>
			</tr>
			<tr>
				<td style="padding-top: 15px; font-size: 16pt; text-align: center">
					'.strtoupper($js['name']).'
				</td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td>
					<table width="100%" cellspacing="0" cellpadding="2" border="0">
						<tr>
							<td width="20%"></td>
							<td width="30%">Tanggal Pengajuan</td>
							<td width="5%">:</td>
							<td width="45%">'.date_id2($pj['created']).'</td>
						</tr>
						<tr>
							<td></td>
							<td>Nama</td>
							<td>:</td>
							<td>'.$mhs['name'].'</td>
						</tr>
						<tr>
							<td></td>
							<td>NIM</td>
							<td>:</td>
							<td>'.$mhs['nim'].'</td>
						</tr>
						<tr>
							<td></td>
							<td>Program Studi</td>
							<td>:</td>
							<td>'.$mhs['prodi'].'</td>
						</tr>
						<tr>
							<td></td>
							<td>Keterangan</td>
							<td>:</td>
							<td></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td>
					<ol>
						<li>Bukti Pengajuan dibawah serta pada saat pengambilan surat</li>
						<li>Proses surat 3 hari kerja (Kecuali Surat Cuti menunggu pengesahan dari Rektorat)</li>
						<li>Dokumen persyaratan asli dibawa serta saat pengambilan surat</li>
						<li>Cek Secara berkala Riwayat Pengajuan pada Sistem Siapik</li>
					</ol>
				</td>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>';

		$data['file_name'] = 'Bukti Pengajuan';

		return $data;
	}

	public function start(){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'1',1);

		$data['id'] = '';
		if(isset($_GET['id'])){
			$data['id'] = $_GET['id'];
		}

		$data['table'] = "pengajuan";
		$data['field'] = "*";
		$data['condition'] = "WHERE id_pengajuan='$data[id]'";
		$data['fn'] = array('Nama Kegiatan','Jam','Foto');
		$data['width'] = array('5%','28%','17%','50%');
		$data['start'] = 0;
		
		$data['orientation'] = 'P';
		$data['format'] = 'A5';
		$data['font_size'] = 12;

		$data['title'][0] = '';

		return $data;
	}
}