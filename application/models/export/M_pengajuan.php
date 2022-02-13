<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengajuan extends CI_Model {
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
			(SELECT b.name FROM prodi b WHERE a.id_prodi=b.id_prodi) as prodi,
			(SELECT b.strata FROM prodi b WHERE a.id_prodi=b.id_prodi) as strata,
			(SELECT b.gelar_sebutan FROM prodi b WHERE a.id_prodi=b.id_prodi) as gelar_sebutan,
			(SELECT b.gelar_singkatan FROM prodi b WHERE a.id_prodi=b.id_prodi) as gelar_singkatan,
			(SELECT c.name FROM konsentrasi c WHERE a.id_konsentrasi=c.id_konsentrasi) as konsentrasi",
			"WHERE id_mahasiswa='$pj[id_mahasiswa]'"
		);

		$data['html'] = '
		<table width="100%" cellspacing="0" cellpadding="1" border="0">
	      	<tr>
				<td align="center" width="15%">
					<img src="'.base_url().'img/logo.png" width="80" height="80">
				</td>
				<td align="center" width="70%">
					'.$data['title'][0].'
				</td>
				<td align="center" width="15%">
					<img src="'.base_url().'upload/qrcode/img/'.$pj['id_pengajuan'].'.png" width="80" height="80">
				</td>
	      	</tr>
	      	<tr>
	        	<td colspan="3"><hr></td>
	      	</tr>
		</table>';
		

		$data['file_name'] = $js['name'];
	
		if($pj['id_jenis_surat']=='JS20201128233805X4W'){
			$data['html'] .= $this->surat_1($pj,$js,$mhs);
		}
		elseif($pj['id_jenis_surat']=='JS20201128233504urr'){
			$data['html'] .= $this->surat_2($pj,$js,$mhs);
		}
		elseif($pj['id_jenis_surat']=='JS20201128233118SHg'){
			$data['html'] .= $this->surat_3($pj,$js,$mhs);
		}
		elseif($pj['id_jenis_surat']=='JS20201128233015H62'){
			$data['html'] .= $this->surat_4($pj,$js,$mhs);
		}
		elseif($pj['id_jenis_surat']=='JS20201128232939Tow'){
			$data['html'] .= $this->surat_5($pj,$js,$mhs);
		}
		elseif($pj['id_jenis_surat']=='JS20201128222640fB5'){
			$data['html'] .= $this->surat_6($pj,$js,$mhs);
		}
		elseif($pj['id_jenis_surat']=='JS202011282226219aS'){
			$data['html'] .= $this->surat_7($pj,$js,$mhs);
		}
		elseif($pj['id_jenis_surat']=='JS20201208134406xdb'){
			$data['html'] .= $this->surat_8($pj,$js,$mhs);
		}
		
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
		$data['format'] = 'A4';
		$data['font_size'] = 12;

		$data['title'][0] = '
		<div style="font-weight: bold;">
			KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN <br>
			UNIVERSITAS HALU OLEO<br>
			PASCASARJANA
		</div>
		<span style="font-size: 11px;">
			Kampus Abdullah Silandae Jl. Mayjen S.Parman Kemaraya Kendari, 93121 <br>
			Telp/Fax (0401) 3127187, Email : pps_unhalu@yahoo.com, Web. : www.pasca.uho.ac.id
		</span>';

		return $data;
	}

	public function surat_1($pj,$js,$mhs){
		$data = '
		<span align="center">
			<b><u>'.strtoupper($js['name']).'</u></b><br>
			Nomor :
		</span>
		<p align="justify">
			Berdasarkan Keputusan Direktur Pascasarjana Universitas Halu Oleo Nomor :.........../UN29.19/KR/'.date('Y').'
			...........................
			Tanggal
			...........................
			Tentang Penetapan Dosen Penguji Ujian Tesis, <br> Maka Saudara yang namanya tercantum dibawah ini :
		</p>
		<table width="100%" cellspacing="0" cellpadding="2" border="1">
	      	<tr style="font-weight: bold; text-align: center;">
				<th width="5%">NO</th>
				<th width="75%">NAMA</th>
				<th width="20%">JABATAN</th>
			</tr>';

			$js_metadata = select("jenis_surat_metadata","*","WHERE id_jenis_surat='$js[id_jenis_surat]' AND type='select' ORDER BY urutan");
			foreach($js_metadata as $i => $r){
				$r2 = select2("pengajuan_detail","*","WHERE id_pengajuan='$pj[id_pengajuan]' AND id_jenis_surat_metadata='$r[id_jenis_surat_metadata]'");
				$r3 = select2("dosen","*","WHERE id_dosen='$r2[value]'");
				$data .= '
				<tr>
					<td align="center">'.($i+1).'</td>
					<td>'.$r3['name'].'</td>
					<td align="center">'.$r['name'].'</td>
				</tr>';
			}

		$data .= '
		</table>
		<p align="justify">Untuk menjadi pembimbing pada Ujian Tesis Mahasiswa : </p>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			  	<td width="5%"></td>
				<td width="20%">Nama</td>
				<td width="5%">:</td>
				<td width="70%">'.$mhs['name'].'</td>
			</tr>
			<tr>
			  	<td></td>
				<td>No. Registrasi</td>
				<td>:</td>
				<td>'.$mhs['nim'].'</td>
			</tr>
			<tr>
			  	<td></td>
				<td>Program Studi</td>
				<td>:</td>
				<td>'.$mhs['prodi'].'</td>
			</tr>
		</table>';

		$jsm = select2("jenis_surat_metadata","*","WHERE id_jenis_surat='$js[id_jenis_surat]' AND name='Judul' ORDER BY urutan");
		$pd = select2("pengajuan_detail","*","WHERE id_pengajuan='$pj[id_pengajuan]' AND id_jenis_surat_metadata='$jsm[id_jenis_surat_metadata]'");
		$ttd = select2("tanda_tangan","*","WHERE flag_aktif='1' AND id_tanda_tangan='TT20201208151712n1Q'");
		$data .= '
		<p align="justify">Yang akan dilaksanakan pada : </p>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			  	<td width="5%"></td>
				<td width="20%">Hari/Tanggal</td>
				<td width="5%">:</td>
				<td width="70%"></td>
			</tr>
			<tr>
			  	<td></td>
				<td>Jam</td>
				<td>:</td>
				<td></td>
			</tr>
			<tr>
			  	<td></td>
				<td>Tempat</td>
				<td>:</td>
				<td></td>
			</tr>
			<tr>
			  	<td></td>
				<td>Judul</td>
				<td>:</td>
				<td>'.$pd['value'].'</td>
			</tr>
		</table>
		<p align="justify">Demikian penugasan ini untuk dilaksanakan dengan penuh tanggung jawab. </p>
		<table width="100%" cellspacing="0" cellpadding="3" border="0">
			<tr>
				<td width="40%"></td>
				<td width="60%">
					Kendari, '.date_id2(date('Y-m-d')).'<br>
					Wakil Direktur Bidang Akademik & Kemahasiswaan <br>
					Pascasarjana Universitas Halu Oleo,
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><b><u>'.$ttd['name'].'</u> <br>NIP '.$ttd['nip'].'</b></td>
			</tr>
		</table>
		<p align="justify">
			Catatan : <br>
			<small>Dosen penguji memankai Baju Batik/Kain Tenun</small> <br>
			<small>Minimal 3 (tiga) hari sebelum ujian, naskah proposal/hasil penelitian/tesis sudah harus sampai pada penguji</small>
		</p>
		<p style="page-break-before: always;"></p>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="15%">Lampiran</td>
				<td width="5%">:</td>
				<td width="80%">Keputusan Direktur Pascasarjana Universitas Haluoleo</td>
			</tr>
			<tr>
				<td>Nomor</td>
				<td>:</td>
				<td>2116/SK/UN29.9/PP/2012</td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td>:</td>
				<td><b>6 Maret 2012</b></td>
			</tr>
			<tr>
				<td>Tentang</td>
				<td>:</td>
				<td>
					Pengangkatan Dosen Pembimbing Seminar Proposal Mahasiswa Program Studi '.$mhs['prodi'].' Pascasarjana Universitas Haluoleo.
				</td>
			</tr>
		</table>
		<br><br>
		<table width="100%" cellspacing="0" cellpadding="3" border="1">
	      	<tr style="font-weight: bold; text-align: center;">
				<th width="5%">NO</th>
				<th width="20%">NAMA <br>MAHASISWA<br>/STAMBUK</th>
				<th width="20%">JUDUL THESIS</th>
				<th width="15%">PROGRAM STUDI</th>
				<th width="40%">PEMBIMBING</th>
			</tr>
			<tr align="center">
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
			</tr>
			<tr style="vertical-align:middle;">
				<td align="center">01</td>
				<td>'.$mhs['name'].'</td>
				<td>'.$pd['value'].'</td>
				<td>'.$mhs['prodi'].'</td>
				<td>
					<table width="100%" border="0">';
					foreach($js_metadata as $i => $r){
						$r2 = select2("pengajuan_detail","*","WHERE id_pengajuan='$pj[id_pengajuan]' AND id_jenis_surat_metadata='$r[id_jenis_surat_metadata]'");
						$r3 = select2("dosen","*","WHERE id_dosen='$r2[value]'");
						$data .= '
						<tr>
							<td width="35%">'.$r['name'].'</td>
							<td width="5%"> : </td>
							<td width="60%">'.$r3['name'].'</td>
						</tr>';
					}
				$data .= '
					</table>
				</td>
			</tr>
		</table>
		<p style="page-break-before: always;"></p>
		<table width="100%" cellspacing="0" cellpadding="1" border="0">
	      	<tr>
				<td align="center" width="100%" colspan="" style="font-weight: bold;">
					KEPUTUSAN<br>
                    DIREKTUR PASCASARJANA<br>
                    UNIVERSITAS HALU OLEO<br>
                    NOMOR : T/.........../UN29.19/ KR /'.date('Y').' <br>
                    Tentang<br>
                    PENETAPAN DOSEN PENGUJI PADA SEMINAR PROPOSAL MAHASISWA<br>
                    PASCASARJANA UNIVERSITAS HALU OLEO<br>
                    DIREKTUR PASCASARJANA
				</td>
	      	</tr>
		</table>
		<table width="100%" cellspacing="0" cellpadding="1" border="0" style="text-align: justify;">
	      	<tr>
				<td width="15%">Mengingat</td>
				<td width="5%">:</td>
				<td width="5%">a.</td>
				<td width="75%">
					bahwa dalam rangka penyelesaian studi mahasiswa Pascasarjana Universitas Halu Oleo, perlu diadakan Seminar Proposal
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>b.</td>
				<td>
					bahwa Seminar Proposal dimaksud untuk mengetahui kemampuan Ilmiah dalam hal penguasaan materi yang telah dipelajari dalam rangka pengembangan profesi/keahlian
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>c.</td>
				<td>
					bahwa mahasiswa tersebut dalam lampiran surat keputusan ini adalah mahasiswa Pascasarjana
                          Universitas Halu Oleo yang telah memenuhi syarat untuk mengikuti Seminar Proposal
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>d.</td>
				<td>
					bahwa untuk maksud tersebut diatas perlu ditetapkan dengan surat keputusan penetapan penguji
                          pada Seminar Proposal
				</td>
			</tr>
			<tr>
				<td>Mengingat</td>
				<td>:</td>
				<td>1.</td>
				<td>
					Undang-Undang Nomor : 20 Tahun 2003; tentang sistem Pendidikan Nasional
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>2.</td>
				<td>
					Undang – Undang Nomor 12 Tahun 2012 Tentang Pendidikan Tinggi
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>3.</td>
				<td>
					Peraturan Pemerintah No: 66 Tahun 2010, tentang Perubahan atas Peraturan Pemerintah No : 17
                          Tahun 2010 tentang Pengelolaan dan Penyelenggaraan Pendidikan
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>4.</td>
				<td>
					Keputusan Presiden R.I. No: 37 Tahun 1981 tentang Pendirian Universitas Halu Oleo
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>5.</td>
				<td>
					Keputusan Mendiknas R.I. Nomor : 43 Tahun 2012 tentang Statuta Universitas Halu Oleo
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>6.</td>
				<td>
					Peraturan Menteri Pendidikan dan Kebudayaan Nomor 149 Tahun 2014 Tentang Organisasi dan Tata
                          Kelola Universitas Halu Oleo
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>7.</td>
				<td>
					Keputusan Menteri Riset Teknologi dan Pendidikan Tinggi Nomor : 327/M/KPT.KP/2017 Tentang
                          Pengangkatan Rektor Universitas Halu Oleo Periode 2017 - 2021Tanggal 17 Juli 2017
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>8.</td>
				<td>
					Keputusan Rektor Universitas Halu Oleo No. 09/H.29/SK/PP/2008, Tahun 2008, tentang Pembukaan
                          Pascasarjana di Universitas Halu Oleo
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>9.</td>
				<td>
					Keputusan Rektor Universitas Halu Oleo No. 10/H.29/SK/OT/2008, Tahun 2008, tentang
                          pembentukan Struktur Organisasi Pascasarjana Universitas Halu Oleo
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>10.</td>
				<td>
					Surat Keputusan Rektor Universitas Halu Oleo Nomor: 1282/UN.29/SK/KP/2017, , tentang
                          Pemberhentian dan Pengangkatan Pejabat Non Struktural ( Tugas Tambahan Dosen ) Universitas
                          Halu Oleo
				</td>
			</tr>
			<tr>
				<td>Memperhatikan</td>
				<td>:</td>
				<td>1.</td>
				<td>
					Petunjuk Pelaksanaan sistem kredit semester pada Perguruan Tinggi Tahun 2014
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>2.</td>
				<td>
					Surat Direktur Pascasarjana tentang mahasiswa peserta ujian dan penetapan penguji pada
                          Seminar Proposal Januari 2019
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>3.</td>
				<td>
					Peraturan Rektor Universitas Halu Oleo Nomor 1 Tahun 2019 tentang peraturan Akademik di
                          Lingkup Universitas Halu Oleo
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>4.</td>
				<td>
					Surat Keputusan Direktur Pascasarjana Universitas Halu Oleo No. 7575/UN29.19/SK/2019 Tentang
                          Panduan Akademik Pascasarjana Universitas Halu Oleo
				</td>
			</tr>
		</table>
		<p style="page-break-before: always;"></p>
		<table width="100%" cellspacing="0" cellpadding="1" border="0" style="text-align: justify;">
	      	<tr>
				<td width="15%">Menetapkan</td>
				<td width="85%" align="center" colspan="2"><b>MEMUTUSKAN :</b></td>
			</tr>
			<tr>
				<td width="15%">Pertama</td>
				<td width="5%">:</td>
				<td width="80%">
					Mengangkat Dosen pembimbing pada Seminar Proposal mahasiswa Pascasarjana
                          Universitas Halu
                          Oleo sebagaimana tersebut dalam lampiran surat keputusan ini
				</td>
			</tr>
			<tr>
				<td>Kedua</td>
				<td>:</td>
				<td>
					Konsekuensi keuangan yang timbul akibat dari keputusan ini dibebankan pada
                          anggaran DIPA BLU
                          UHO
				</td>
			</tr>
			<tr>
				<td>Ketiga</td>
				<td>:</td>
				<td>
					Surat Keputusan ini berlaku sejak tanggal ditetapkan, dengan ketentuan apabila
                          dikemudian
                          hari terdapat kekeliruan dalam keputusan ini akan diadakan perbaikan sebagaimana mestinya.
				</td>
			</tr>
		</table>';

		$ttd = select2("tanda_tangan","*","WHERE flag_aktif='1' AND id_tanda_tangan='TT20201208151745ZnM'");
		$data .= '
		<table width="100%" cellspacing="0" cellpadding="3" border="0">
			<tr>
				<td width="60%"></td>
				<td width="40%">
					DITETAPKAN DI : K E N D A R I <br>
					<u>PADA TANGGAL : '.date_id2(date('Y-m-d')).'</u><br>
					Direktur
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><b><u>'.$ttd['name'].'</u> <br>NIP '.$ttd['nip'].'</b></td>
			</tr>
		</table>';

		return $data;
	}

	public function surat_2($pj,$js,$mhs){
		$ttd = select2("tanda_tangan","*","WHERE flag_aktif='1' AND id_tanda_tangan='TT20201208151925hPy'");
		$data = '
		<span align="right">
			Kendari, '.date_id2(date('Y-m-d')).'
		</span><br><br>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			  	<td width="15%">Nomor</td>
				<td width="5%">:</td>
				<td width="80%">.........../UN29.19.1/KR/'.date('Y').'</td>
			</tr>
			<tr>
				<td>Lampiran</td>
				<td>:</td>
				<td>1 ( Satu ) Berkas</td>
			</tr>
			<tr>
				<td>Hal</td>
				<td>:</td>
				<td>Rekomendasi Mengikuti Test TOEFL</td>
			</tr>
		</table>
		<p align="justify">
			Kepada <br>
			Yth. Ketua UPT Bahasa Universitas Halu Oleo
		</p>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			  	<td width="15%">Nama</td>
				<td width="5%">:</td>
				<td width="80%">'.$ttd['name'].'</td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>:</td>
				<td>Kasubag Akademik dan Kemahasiswaan Pascasarjana</td>
			</tr>
			<tr>
				<td>Unikerja</td>
				<td>:</td>
				<td>Pascasarjana UHO</td>
			</tr>
		</table>
		<p align="justify">
			Dengan ini menerangkan bahwa :
		</p>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			  	<td width="15%">Nama</td>
				<td width="5%">:</td>
				<td width="80%">'.$mhs['name'].'</td>
			</tr>
			<tr>
				<td>NIM</td>
				<td>:</td>
				<td>'.$mhs['nim'].'</td>
			</tr>
			<tr>
				<td>Program Studi</td>
				<td>:</td>
				<td>'.$mhs['prodi'].'</td>
			</tr>
		</table>
		<p align="justify">
			Yang bersangkutan adalah benar benar mahasiswa Pascasarjana universitas Halu Oleo yang masih
			aktif pada Tahun Ajaran 2020/2021 Semester Ganjil Untuk Mengikuti Test TOEFL di UPT Bahasa
			Universitas Halu Oleo.		
		</p>
		<p align="justify">
			Demikian surat Rekomndasi ini dibuat untuk dapat digunakan sebagaimana mestinya.
		</p>
		<table width="100%" cellspacing="0" cellpadding="3" border="0">
			<tr>
				<td width="60%"></td>
				<td width="40%">
					Kepala Bagian Tata Usaha Pascasarjana <br>
					Kasubag Akademik dan Kemahasiswaan <br>
					Pascasarjana Universitas Halu Oleo
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><b><u>'.$ttd['name'].'</u> <br>NIP '.$ttd['nip'].'</b></td>
			</tr>
		</table>';

		return $data;
	}

	public function surat_3($pj,$js,$mhs){
		$ttd = select2("tanda_tangan","*","WHERE flag_aktif='1' AND id_tanda_tangan='TT20201208151712n1Q'");
		$data = '
		<span align="center">
			<b>
				SURAT KETERANGAN <br>
				<u>TIDAK SEDANG MENERIMA BEASISWA DARI SUMBER LAIN</u>
			</b><br>
			Nomor : .........../UN29.19.1/KR/'.date('Y').'
		</span><br><br>
		<p align="justify">
			Yang bertanda tangan dibawah ini Direktur Program Pascasarjana Universitas Halu Oleo menerangkan
			bahwa :		
		</p>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			  	<td width="30%">Nama</td>
				<td width="5%">:</td>
				<td width="65%">'.$mhs['name'].'</td>
			</tr>
			<tr>
				<td>Tempat & Tanggal Lahir</td>
				<td>:</td>
				<td>'.$mhs['tempat_lahir'].', '.date_id2($mhs['tgl_lahir']).'</td>
			</tr>
			<tr>
				<td>NIM</td>
				<td>:</td>
				<td>'.$mhs['nim'].'</td>
			</tr>
			<tr>
				<td>Program Studi</td>
				<td>:</td>
				<td>'.$mhs['prodi'].'</td>
			</tr>
			<tr>
				<td>Jenjang Pendidikan</td>
				<td>:</td>
				<td>'.$mhs['gelar_sebutan'].' ('.$mhs['strata'].')</td>
			</tr>
		</table>
		<p align="justify">
			Adalah benar mahasiswa Program Pascasarjana Universitas Halu Oleo pada Program Studi ('.$mhs['strata'].')
			'.$mhs['prodi'].' yang masih aktif dan berdasarkan surat pernyataan yang dibuat mahasiswa
			tersebut yang bersangkutan tidak sedang mendapatkan beasiswa dari sumber lain pada Tahun '.date('Y').'			
		</p>
		<p align="justify">
			Demikian surat keterangan ini kami berikan untuk dapat dipergunakan dan apabila terdapat kekeliruan
			akan diperbaiki sebagaimana mestinya.		
		</p>
		<table width="100%" cellspacing="0" cellpadding="3" border="0">
			<tr>
				<td width="60%"></td>
				<td width="40%">
					Kendari, '.date_id2(date('Y-m-d')).' <br>
					Wakil Direktur Bidang Akademik & Kemahasiswaan <br>
					Pascasarjana Universitas Halu Oleo,				
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><b><u>'.$ttd['name'].'</u> <br>NIP '.$ttd['nip'].'</b></td>
			</tr>
		</table>';
		return $data;
	}

	public function surat_4($pj,$js,$mhs){
		$jsm = select2("jenis_surat_metadata","*","WHERE id_jenis_surat='$js[id_jenis_surat]' AND name='IPK' ORDER BY urutan");
		$pd = select2("pengajuan_detail","*","WHERE id_pengajuan='$pj[id_pengajuan]' AND id_jenis_surat_metadata='$jsm[id_jenis_surat_metadata]'");

		$jsm2 = select2("jenis_surat_metadata","*","WHERE id_jenis_surat='$js[id_jenis_surat]' AND name='Tanggal Yudisium' ORDER BY urutan");
		$pd2 = select2("pengajuan_detail","*","WHERE id_pengajuan='$pj[id_pengajuan]' AND id_jenis_surat_metadata='$jsm2[id_jenis_surat_metadata]'");

		$ttd = select2("tanda_tangan","*","WHERE flag_aktif='1' AND id_tanda_tangan='TT20201208151745ZnM'");
		$data = '
		<span align="center">
			<b>
				<u>'.strtoupper($js['name']).'</u>
			</b><br>
			Nomor : .........../UN29.19/KR/'.date('Y').'
		</span><br><br>
		<p align="justify">
			Direktur Pascasarjana Universitas Halu Oleo menerangkan bahwa yang tersebut di bawah ini :	
		</p>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="20%"></td>
			  	<td width="30%">Nama</td>
				<td width="5%">:</td>
				<td width="25%">'.$mhs['name'].'</td>
				<td width="20%"></td>
			</tr>
			<tr>
				<td></td>
				<td>Tempat & Tanggal Lahir</td>
				<td>:</td>
				<td>'.$mhs['tempat_lahir'].', '.date_id2($mhs['tgl_lahir']).'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>NIM</td>
				<td>:</td>
				<td>'.$mhs['nim'].'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>Program Studi</td>
				<td>:</td>
				<td>'.$mhs['prodi'].'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>Konsentrasi</td>
				<td>:</td>
				<td>'.$mhs['konsentrasi'].'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>IPK</td>
				<td>:</td>
				<td>'.$pd['value'].'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>Jenjang Pendidikan</td>
				<td>:</td>
				<td>'.$mhs['gelar_sebutan'].' ('.$mhs['strata'].')</td>
				<td></td>
			</tr>
		</table>
		<p align="justify">
			Sesuai dengan hasil rapat yudisium pada tanggal '.date_id2(date_en($pd2['value'])).' dinyatakan <b>LULUS</b> pada Program
			Studi <b>'.$mhs['strata'].' '.$mhs['prodi'].'</b> Pascasarjana Universitas Halu Oleo dan berhak memperoleh Gelar
			Akademis <b>"'.$mhs['gelar_sebutan'].'" ('.$mhs['gelar_singkatan'].')</b>	
		</p>
		<p align="justify">
			Demikian surat keterangan lulus ini dibuat untuk dipergunakan sebagaimana mestinya	
		</p>
		<table width="100%" cellspacing="0" cellpadding="3" border="0">
			<tr>
				<td width="50%"></td>
				<td width="50%">
					Kendari, '.date_id2(date('Y-m-d')).' <br>
					Direktur,		
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><b><u>'.$ttd['name'].'</u> <br>NIP '.$ttd['nip'].'</b></td>
			</tr>
		</table>';
		return $data;
	}

	public function surat_5($pj,$js,$mhs){
		$jsm = select2("jenis_surat_metadata","*","WHERE id_jenis_surat='$js[id_jenis_surat]' AND name='IPK' ORDER BY urutan");
		$pd = select2("pengajuan_detail","*","WHERE id_pengajuan='$pj[id_pengajuan]' AND id_jenis_surat_metadata='$jsm[id_jenis_surat_metadata]'");

		$jsm2 = select2("jenis_surat_metadata","*","WHERE id_jenis_surat='$js[id_jenis_surat]' AND name='Tanggal Yudisium' ORDER BY urutan");
		$pd2 = select2("pengajuan_detail","*","WHERE id_pengajuan='$pj[id_pengajuan]' AND id_jenis_surat_metadata='$jsm2[id_jenis_surat_metadata]'");

		$ttd = select2("tanda_tangan","*","WHERE flag_aktif='1' AND id_tanda_tangan='TT20201208151745ZnM'");
		$data = '
		<span align="center">
			<b>
				<u>'.strtoupper($js['name']).'</u>
			</b><br>
			Nomor : .........../UN29.19/KR/'.date('Y').'
		</span><br><br>
		<p align="justify">
			Direktur Pascasarjana Universitas Halu Oleo menerangkan bahwa yang tersebut di bawah ini :	
		</p>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			  	<td width="30%">Nama</td>
				<td width="5%">:</td>
				<td width="65%">'.$mhs['name'].'</td>
			</tr>
			<tr>
				<td>Tempat & Tanggal Lahir</td>
				<td>:</td>
				<td>'.$mhs['tempat_lahir'].', '.date_id2($mhs['tgl_lahir']).'</td>
			</tr>
			<tr>
				<td>NIM</td>
				<td>:</td>
				<td>'.$mhs['nim'].'</td>
			</tr>
			<tr>
				<td>Program Studi</td>
				<td>:</td>
				<td>'.$mhs['prodi'].'</td>
			</tr>
			<tr>
				<td>Konsentrasi</td>
				<td>:</td>
				<td>'.$mhs['konsentrasi'].'</td>
			</tr>
			<tr>
				<td>IPK</td>
				<td>:</td>
				<td>'.$pd['value'].'</td>
			</tr>
			<tr>
				<td>Jenjang Pendidikan</td>
				<td>:</td>
				<td>'.$mhs['gelar_sebutan'].' ('.$mhs['strata'].')</td>
			</tr>
		</table>
		<p align="justify">
			Yang bersangkutan adalah benar Mahasiswa yang terdaftar pada Tahun Akademik 2016/2017 dan
			telah menyelesaikan Studi Pascasarjana Program Studi '.$mhs['prodi'].' UHO pada tanggal '.date_id2(date_en($pd2['value'])).' 
			dengan (IPK) Indeks Prestasi Kumulatif '.$pd['value'].'		
		</p>
		<p align="justify">
			Demikian surat keterangan Alumni ini dibuat dan diberikan kepada yang bersangkutan untuk
			dipergunakan sebagaimana mestinya.	
		</p>
		<table width="100%" cellspacing="0" cellpadding="3" border="0">
			<tr>
				<td width="50%"></td>
				<td width="50%">
					Kendari, '.date_id2(date('Y-m-d')).' <br>
					Direktur,		
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><b><u>'.$ttd['name'].'</u> <br>NIP '.$ttd['nip'].'</b></td>
			</tr>
		</table>';
		return $data;
	}

	public function surat_6($pj,$js,$mhs){
		$ttd = select2("tanda_tangan","*","WHERE flag_aktif='1' AND id_tanda_tangan='TT20201208151712n1Q'");
		$data = '
		<span align="center">
			<b>
				<u>'.strtoupper($js['name']).'</u>
			</b><br>
			Nomor : .........../UN29.19.1/KR/'.date('Y').'
		</span><br><br>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			  	<td width="30%">Nama</td>
				<td width="5%">:</td>
				<td width="65%">'.$ttd['name'].'</td>
			</tr>
			<tr>
				<td>NIP</td>
				<td>:</td>
				<td>'.$ttd['nip'].'</td>
			</tr>
			<tr>
				<td>Pangkat / Gol. Ruang</td>
				<td>:</td>
				<td>Pembina Utama Madya / Gol. IV/d</td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>:</td>
				<td>'.$ttd['jabatan'].'</td>
			</tr>
		</table>
		<p align="justify">
			Dengan ini menerangkan, bahwa :
		</p>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			  	<td width="30%">Nama</td>
				<td width="5%">:</td>
				<td width="65%">'.$mhs['name'].'</td>
			</tr>
			<tr>
				<td>Tempat & Tanggal Lahir</td>
				<td>:</td>
				<td>'.$mhs['tempat_lahir'].', '.date_id2($mhs['tgl_lahir']).'</td>
			</tr>
			<tr>
				<td>NIM</td>
				<td>:</td>
				<td>'.$mhs['nim'].'</td>
			</tr>
			<tr>
				<td>Program Studi</td>
				<td>:</td>
				<td>'.$mhs['prodi'].'</td>
			</tr>
			<tr>
				<td>Jenjang Pendidikan</td>
				<td>:</td>
				<td>'.$mhs['gelar_sebutan'].' ('.$mhs['strata'].')</td>
			</tr>
		</table>
		<p align="justify">
			Adalah benar-benar mahasiswa Pascasarjana Universitas Halu Oleo yang aktif kuliah pada semester
			Ganjil Tahun Akademik 2020/2021.
		</p>
		<p align="justify">
			Demikian surat keterangan ini kami berikan untuk dapat dipergunakan dan apabila terdapat kekeliruan
			akan diperbaiki sebagaimana mestinya.
		</p>
		<table width="100%" cellspacing="0" cellpadding="3" border="0">
			<tr>
				<td width="50%"></td>
				<td width="50%">
					Kendari, '.date_id2(date('Y-m-d')).' <br>
					Wakil Direktur Bidang Akademik & Kemahasiswaan <br>
					Pascasarjana Universitas Halu Oleo,	
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><b><u>'.$ttd['name'].'</u> <br>NIP '.$ttd['nip'].'</b></td>
			</tr>
		</table>';
		return $data;
	}

	public function surat_7($pj,$js,$mhs){
		$jsm = select2("jenis_surat_metadata","*","WHERE id_jenis_surat='$js[id_jenis_surat]' AND name='IPK' ORDER BY urutan");
		$pd = select2("pengajuan_detail","*","WHERE id_pengajuan='$pj[id_pengajuan]' AND id_jenis_surat_metadata='$jsm[id_jenis_surat_metadata]'");

		$jsm2 = select2("jenis_surat_metadata","*","WHERE id_jenis_surat='$js[id_jenis_surat]' AND name='Tanggal Yudisium' ORDER BY urutan");
		$pd2 = select2("pengajuan_detail","*","WHERE id_pengajuan='$pj[id_pengajuan]' AND id_jenis_surat_metadata='$jsm2[id_jenis_surat_metadata]'");

		$ttd = select2("tanda_tangan","*","WHERE flag_aktif='1' AND id_tanda_tangan='TT20201208151712n1Q'");
		$data = '
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			  	<td width="15%">Nomor</td>
				<td width="5%">:</td>
				<td width="50%">.........../UN29.19.1/KR/'.date('Y').'</td>
				<td width="30%">Kendari, '.date_id2(date('Y-m-d')).'</td>
			</tr>
			<tr>
				<td>Perihal</td>
				<td>:</td>
				<td>Izin Penelitian</td>
				<td></td>
			</tr>
		</table>
		<p align="justify">
			Kepada<br>
			Yth. Yth kepala balitbang provinsi sulawesi tenggara<br>
			Di - <br>
			Tempat
		</p>
		<p align="justify">
			Yang bertanda tangan di bawah ini Direktur Pascasarjana Universitas Halu Oleo menerangkan bahwa :		
		</p>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			  	<td width="30%">Nama</td>
				<td width="5%">:</td>
				<td width="65%">'.$mhs['name'].'</td>
			</tr>
			<tr>
				<td>NIM</td>
				<td>:</td>
				<td>'.$mhs['nim'].'</td>
			</tr>
			<tr>
				<td>Program Studi</td>
				<td>:</td>
				<td>'.$mhs['prodi'].'</td>
			</tr>
			<tr>
				<td>Jenjang Pendidikan</td>
				<td>:</td>
				<td>'.$mhs['gelar_sebutan'].' ('.$mhs['strata'].')</td>
			</tr>
		</table>
		<p align="justify">
			Bahwa sehubungan dengan rencana penulisan tesis/disertasi, sebagai salah satu syarat untuk
			memperoleh gelar '.$mhs['gelar_sebutan'].' ('.$mhs['strata'].') pada Prodi '.$mhs['prodi'].'
			Pascasarjana UHO, maka mahasiswa tersebut diwajibkan melaksanakan penelitian sehubungan
			dengan judul tesis/disertasi yang diajukan yaitu :		
		</p>
		<p align="justify">
			<b>Strategi promosi kesehatan perilaku hidup bersih dan sehat(phbs) pada tatanan rumah tangga
			di kecamatan lasolo kabupaten konawe utara provinsi sulawesi tenggara</b>
		</p>
		<p align="justify">
			Demikian penyampaian kami, atas perhatian dan kerjasama yang baik diucapkan terima kasih.
		</p>
		<table width="100%" cellspacing="0" cellpadding="3" border="0">
			<tr>
				<td width="50%"></td>
				<td width="50%">
					A.n. Direktur<br>
					Wakil Direktur Bidang Akademik & Kemahasiswaan<br>
					Pascasarjana UHO,				
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><b><u>'.$ttd['name'].'</u> <br>NIP '.$ttd['nip'].'</b></td>
			</tr>
		</table>';
		return $data;
	}

	public function surat_8($pj,$js,$mhs){
		$data = '
		<span align="center">
			<b><u>'.strtoupper($js['name']).'</u></b><br>
			Nomor :
		</span>
		<p align="justify">
			Berdasarkan Keputusan Direktur Pascasarjana Universitas Halu Oleo Nomor :.........../UN29.19/KR/'.date('Y').'
			...........................
			Tanggal
			...........................
			Tentang Penetapan Dosen Penguji Ujian Seminar Hasil, <br> Maka Saudara yang namanya tercantum dibawah ini :
		</p>
		<table width="100%" cellspacing="0" cellpadding="0" border="1" style="font-size: 13px;">
	      	<tr style="font-weight: bold; text-align: center;">
				<th width="5%">NO</th>
				<th width="75%">NAMA</th>
				<th width="20%">JABATAN</th>
			</tr>';

			$js_metadata = select("jenis_surat_metadata","*","WHERE id_jenis_surat='$js[id_jenis_surat]' AND (type='select' OR name='Penguji Kehormatan' OR name='Penguji Eksternal') ORDER BY urutan");
			foreach($js_metadata as $i => $r){
				$r2 = select2("pengajuan_detail","*","WHERE id_pengajuan='$pj[id_pengajuan]' AND id_jenis_surat_metadata='$r[id_jenis_surat_metadata]'");
				$r3 = select2("dosen","*","WHERE id_dosen='$r2[value]'");

				$value = $r2['value'];
				if($r3!=NULL){
					$value = $r3['name'];
				}
				$data .= '
				<tr>
					<td align="center">'.($i+1).'</td>
					<td> '.$value.'</td>
					<td align="center">'.$r['name'].'</td>
				</tr>';
			}

		$data .= '
		</table>
		<br><br>Untuk menjadi pembimbing pada Ujian Seminar Hasil Mahasiswa : <br>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			  	<td width="5%"></td>
				<td width="20%">Nama</td>
				<td width="5%">:</td>
				<td width="70%">'.$mhs['name'].'</td>
			</tr>
			<tr>
			  	<td></td>
				<td>No. Registrasi</td>
				<td>:</td>
				<td>'.$mhs['nim'].'</td>
			</tr>
			<tr>
			  	<td></td>
				<td>Program Studi</td>
				<td>:</td>
				<td>'.$mhs['prodi'].'</td>
			</tr>
		</table>';

		$jsm = select2("jenis_surat_metadata","*","WHERE id_jenis_surat='$js[id_jenis_surat]' AND name='Judul' ORDER BY urutan");
		$pd = select2("pengajuan_detail","*","WHERE id_pengajuan='$pj[id_pengajuan]' AND id_jenis_surat_metadata='$jsm[id_jenis_surat_metadata]'");
		$ttd = select2("tanda_tangan","*","WHERE flag_aktif='1' AND id_tanda_tangan='TT20201208151712n1Q'");
		$data .= '
		<br><br>Yang akan dilaksanakan pada : <br>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			  	<td width="5%"></td>
				<td width="20%">Hari/Tanggal</td>
				<td width="5%">:</td>
				<td width="70%"></td>
			</tr>
			<tr>
			  	<td></td>
				<td>Jam</td>
				<td>:</td>
				<td></td>
			</tr>
			<tr>
			  	<td></td>
				<td>Tempat</td>
				<td>:</td>
				<td></td>
			</tr>
			<tr>
			  	<td></td>
				<td>Judul</td>
				<td>:</td>
				<td>'.$pd['value'].'</td>
			</tr>
		</table>
		<br><br>Demikian penugasan ini untuk dilaksanakan dengan penuh tanggung jawab. <br>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="40%"></td>
				<td width="60%">
					Kendari, '.date_id2(date('Y-m-d')).'<br>
					Wakil Direktur Bidang Akademik & Kemahasiswaan <br>
					Pascasarjana Universitas Halu Oleo,
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><b><u>'.$ttd['name'].'</u> <br>NIP '.$ttd['nip'].'</b></td>
			</tr>
		</table>
		<p align="justify">
			Catatan : <br>
			<small>Dosen penguji memankai Baju Batik/Kain Tenun</small> <br>
			<small>Minimal 3 (tiga) hari sebelum ujian, naskah proposal/hasil penelitian/tesis sudah harus sampai pada penguji</small>
		</p>
		<p style="page-break-before: always;"></p>
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="15%">Lampiran</td>
				<td width="5%">:</td>
				<td width="80%">Keputusan Direktur Pascasarjana Universitas Haluoleo</td>
			</tr>
			<tr>
				<td>Nomor</td>
				<td>:</td>
				<td>2116/SK/UN29.9/PP/2012</td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td>:</td>
				<td><b>6 Maret 2012</b></td>
			</tr>
			<tr>
				<td>Tentang</td>
				<td>:</td>
				<td>
					Pengangkatan Dosen Pembimbing Seminar Proposal Mahasiswa Program Studi '.$mhs['prodi'].' Pascasarjana Universitas Haluoleo.
				</td>
			</tr>
		</table>
		<br><br>
		<table width="100%" cellspacing="0" cellpadding="3" border="1">
	      	<tr style="font-weight: bold; text-align: center;">
				<th width="5%">NO</th>
				<th width="20%">NAMA <br>MAHASISWA<br>/STAMBUK</th>
				<th width="20%">JUDUL THESIS</th>
				<th width="15%">PROGRAM STUDI</th>
				<th width="40%">PEMBIMBING</th>
			</tr>
			<tr align="center">
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
			</tr>
			<tr style="vertical-align:middle;">
				<td align="center">01</td>
				<td>'.$mhs['name'].'</td>
				<td>'.$pd['value'].'</td>
				<td>'.$mhs['prodi'].'</td>
				<td>
					<table width="100%" border="0">';
					foreach($js_metadata as $i => $r){
						$r2 = select2("pengajuan_detail","*","WHERE id_pengajuan='$pj[id_pengajuan]' AND id_jenis_surat_metadata='$r[id_jenis_surat_metadata]'");
						$r3 = select2("dosen","*","WHERE id_dosen='$r2[value]'");

						$value = $r2['value'];
						if($r3!=NULL){
							$value = $r3['name'];
						}
						$data .= '
						<tr>
							<td width="35%">'.$r['name'].'</td>
							<td width="5%"> : </td>
							<td width="60%">'.$value.'</td>
						</tr>';
					}
				$data .= '
					</table>
				</td>
			</tr>
		</table>
		<p style="page-break-before: always;"></p>
		<table width="100%" cellspacing="0" cellpadding="1" border="0">
	      	<tr>
				<td align="center" width="100%" colspan="" style="font-weight: bold;">
					KEPUTUSAN<br>
                    DIREKTUR PASCASARJANA<br>
                    UNIVERSITAS HALU OLEO<br>
                    NOMOR : T/.........../UN29.19/ KR /'.date('Y').' <br>
                    Tentang<br>
                    PENETAPAN DOSEN PENGUJI PADA SEMINAR PROPOSAL MAHASISWA<br>
                    PASCASARJANA UNIVERSITAS HALU OLEO<br>
                    DIREKTUR PASCASARJANA
				</td>
	      	</tr>
		</table>
		<table width="100%" cellspacing="0" cellpadding="1" border="0" style="text-align: justify;">
	      	<tr>
				<td width="15%">Mengingat</td>
				<td width="5%">:</td>
				<td width="5%">a.</td>
				<td width="75%">
					bahwa dalam rangka penyelesaian studi mahasiswa Pascasarjana Universitas Halu Oleo, perlu diadakan Seminar Proposal
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>b.</td>
				<td>
					bahwa Seminar Proposal dimaksud untuk mengetahui kemampuan Ilmiah dalam hal penguasaan materi yang telah dipelajari dalam rangka pengembangan profesi/keahlian
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>c.</td>
				<td>
					bahwa mahasiswa tersebut dalam lampiran surat keputusan ini adalah mahasiswa Pascasarjana
                          Universitas Halu Oleo yang telah memenuhi syarat untuk mengikuti Seminar Proposal
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>d.</td>
				<td>
					bahwa untuk maksud tersebut diatas perlu ditetapkan dengan surat keputusan penetapan penguji
                          pada Seminar Proposal
				</td>
			</tr>
			<tr>
				<td>Mengingat</td>
				<td>:</td>
				<td>1.</td>
				<td>
					Undang-Undang Nomor : 20 Tahun 2003; tentang sistem Pendidikan Nasional
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>2.</td>
				<td>
					Undang – Undang Nomor 12 Tahun 2012 Tentang Pendidikan Tinggi
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>3.</td>
				<td>
					Peraturan Pemerintah No: 66 Tahun 2010, tentang Perubahan atas Peraturan Pemerintah No : 17
                          Tahun 2010 tentang Pengelolaan dan Penyelenggaraan Pendidikan
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>4.</td>
				<td>
					Keputusan Presiden R.I. No: 37 Tahun 1981 tentang Pendirian Universitas Halu Oleo
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>5.</td>
				<td>
					Keputusan Mendiknas R.I. Nomor : 43 Tahun 2012 tentang Statuta Universitas Halu Oleo
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>6.</td>
				<td>
					Peraturan Menteri Pendidikan dan Kebudayaan Nomor 149 Tahun 2014 Tentang Organisasi dan Tata
                          Kelola Universitas Halu Oleo
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>7.</td>
				<td>
					Keputusan Menteri Riset Teknologi dan Pendidikan Tinggi Nomor : 327/M/KPT.KP/2017 Tentang
                          Pengangkatan Rektor Universitas Halu Oleo Periode 2017 - 2021Tanggal 17 Juli 2017
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>8.</td>
				<td>
					Keputusan Rektor Universitas Halu Oleo No. 09/H.29/SK/PP/2008, Tahun 2008, tentang Pembukaan
                          Pascasarjana di Universitas Halu Oleo
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>9.</td>
				<td>
					Keputusan Rektor Universitas Halu Oleo No. 10/H.29/SK/OT/2008, Tahun 2008, tentang
                          pembentukan Struktur Organisasi Pascasarjana Universitas Halu Oleo
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>10.</td>
				<td>
					Surat Keputusan Rektor Universitas Halu Oleo Nomor: 1282/UN.29/SK/KP/2017, , tentang
                          Pemberhentian dan Pengangkatan Pejabat Non Struktural ( Tugas Tambahan Dosen ) Universitas
                          Halu Oleo
				</td>
			</tr>
			<tr>
				<td>Memperhatikan</td>
				<td>:</td>
				<td>1.</td>
				<td>
					Petunjuk Pelaksanaan sistem kredit semester pada Perguruan Tinggi Tahun 2014
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>2.</td>
				<td>
					Surat Direktur Pascasarjana tentang mahasiswa peserta ujian dan penetapan penguji pada
                          Seminar Proposal Januari 2019
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>3.</td>
				<td>
					Peraturan Rektor Universitas Halu Oleo Nomor 1 Tahun 2019 tentang peraturan Akademik di
                          Lingkup Universitas Halu Oleo
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>4.</td>
				<td>
					Surat Keputusan Direktur Pascasarjana Universitas Halu Oleo No. 7575/UN29.19/SK/2019 Tentang
                          Panduan Akademik Pascasarjana Universitas Halu Oleo
				</td>
			</tr>
		</table>
		<p style="page-break-before: always;"></p>
		<table width="100%" cellspacing="0" cellpadding="1" border="0" style="text-align: justify;">
	      	<tr>
				<td width="15%">Menetapkan</td>
				<td width="85%" align="center" colspan="2"><b>MEMUTUSKAN :</b></td>
			</tr>
			<tr>
				<td width="15%">Pertama</td>
				<td width="5%">:</td>
				<td width="80%">
					Mengangkat Dosen pembimbing pada Seminar Proposal mahasiswa Pascasarjana
                          Universitas Halu
                          Oleo sebagaimana tersebut dalam lampiran surat keputusan ini
				</td>
			</tr>
			<tr>
				<td>Kedua</td>
				<td>:</td>
				<td>
					Konsekuensi keuangan yang timbul akibat dari keputusan ini dibebankan pada
                          anggaran DIPA BLU
                          UHO
				</td>
			</tr>
			<tr>
				<td>Ketiga</td>
				<td>:</td>
				<td>
					Surat Keputusan ini berlaku sejak tanggal ditetapkan, dengan ketentuan apabila
                          dikemudian
                          hari terdapat kekeliruan dalam keputusan ini akan diadakan perbaikan sebagaimana mestinya.
				</td>
			</tr>
		</table>';
		$ttd = select2("tanda_tangan","*","WHERE flag_aktif='1' AND id_tanda_tangan='TT20201208151745ZnM'");
		$data .= '
		<table width="100%" cellspacing="0" cellpadding="3" border="0">
			<tr>
				<td width="60%"></td>
				<td width="40%">
					DITETAPKAN DI : K E N D A R I <br>
					<u>PADA TANGGAL : '.date_id2(date('Y-m-d')).'</u><br>
					Direktur
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><b><u>'.$ttd['name'].'</u> <br>NIP '.$ttd['nip'].'</b></td>
			</tr>
		</table>';

		return $data;
	}
}