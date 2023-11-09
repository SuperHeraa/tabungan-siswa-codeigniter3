<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>
    <a class="btn btn-outline-danger btn-sm mb-2" type="button" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-file-pdf"></i> Cetak Pdf</a>
    <!-- <a class="btn btn-outline-success btn-sm mb-2" type="button" href="<?= base_url('report_siswa/cetakSiswa'); ?>" target="_self"><i class="fas fa-file-excel"></i> Cetak Excel</a> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data</h6>
                    <div class="small mt-4">
                        <ul class="list-inline">
                            <li class="list-inline-item"><i class="fas fa-square text-success"></i> Transaksi Ada</li>
                            <li class="list-inline-item"><i class="fas fa-square text-warning"></i> Transaksi Pending</li>
                            <li class="list-inline-item"><i class="fas fa-square text-danger"></i> Saldo Habis</li>
                        </ul>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive col-lg-12 col-md-12">
                <table id="example" class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($siswa as $sw) : ?>
                            <tr>
                                <td style="width: 5%;"><?= $no++ ?></td>
                                <td id="nm_sw"><?= $sw->nama ?></td>
                                <td><?= $sw->kelas ?></td>
                                <td><?= $sw->id_jurusan ?></td>
                                <td>
                                    <?php

                                    $id = $sw->id_siswa;
                                    $cek = $this->db->get_where('tb_tabungan', ['id_siswa' => $id])->row_array();
                                    $tb = $this->db->select("SUM(tb_tabungan.setoran) as jst, SUM(tb_tabungan.penarikan) as jpn FROM tb_tabungan WHERE id_siswa ='$id'")->get()->row_array();
                                    $saldo = $tb['jst'] - $tb['jpn'];

                                    if ($cek && $saldo != 0) { ?>
                                        <span class="badge badge-success">TA</span>
                                    <?php } elseif ($saldo == 0 && $cek) {  ?>
                                        <span class="badge badge-danger">SH</span>
                                    <?php } else { ?>
                                        <span class="badge badge-warning">TP</span>
                                    <?php } ?>
                                </td>
                                <td style="width: 12%;" class="text-nowrap">
                                    <a href="#detail<?= encrypt_url($sw->id_siswa) ?>" class="btn btn-secondary btn-sm" data-toggle="modal"><i class="fas fa-eye"></i></a>
                                    <a href="#modalEdit<?= $sw->id_siswa ?>" class="btn btn-primary btn-sm" data-toggle="modal"><i class="fa fa-edit fa-xs"></i></a>
                                    <a href="#modalHapus<?= $sw->id_siswa ?>" class="btn btn-danger btn-sm" data-toggle="modal"><i class="fa fa-trash fa-xs"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

<!-- Modal Tambah Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h4 class="modal-title" id="exampleModalLabel">Input data Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="<?= base_url() . 'datasiswa/tambah_siswa' ?>">
                    <div class="alert alert-warning font-italic" role="alert">
                        -> Email yang terdaftar akan menjadi username<br>
                        -> Password default (<span style="color: blue;">123456</span>)
                    </div>
                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <label>Nama Siswa</label>
                                <input type="text" name="nama" class="form-control" autofocus required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Kelas</label>
                                <select name="kelas" class="form-control" id="kelas" required>
                                    <option selected value="">Pilih</option>
                                    <?php foreach ($kelas as $kls) : ?>

                                        <option value="<?= $kls->id; ?>"><?= $kls->kelas; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                                    <option selected value="">Pilih</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Jurusan</label>
                                <select name="jurusan" class="form-control" id="jurusan" required>
                                    <option selected value="">Pilih</option>
                                    <?php foreach ($jurusan as $jrs) : ?>

                                        <option value="<?= $jrs->id_jurusan; ?>"><?= $jrs->id_jurusan; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Nomor Hp</label>
                                <input type="number" name="nohp" class="form-control" required>
                                <input type="hidden" name="role" class="form-control" value="<?= $role['id'] ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Id Member</label>
                                <input type="text" class="form-control" name="id_member" value="<?= $id_member ?>" readonly required>
                            </div>
                        </div>
                    </div>


                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah Data -->

<!-- Modal Hapus Data -->
<?php foreach ($siswa as $sw) : ?>
    <div class="modal fade" id="modalHapus<?= $sw->id_siswa ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">Menghapus Data</h4>
                </div>
                <div class="modal-body">
                    Yakin Anda Ingin Menghapus Data Ini ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <?= anchor('datasiswa/hapus/' . $sw->id_siswa, '<button class="btn btn-primary">Yakin</button>') ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal hapus data -->

<!-- Modal update data -->
<?php foreach ($siswa as $sw) : ?>
    <div class="modal fade" id="modalEdit<?= $sw->id_siswa ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h4 class="modal-title" id="exampleModalLabel">Update data Siswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?= base_url() . 'datasiswa/edit/' . $sw->id_siswa ?>" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id_siswa" class="form-control" value="<?= $sw->id_siswa ?>">
                            <label>Nama Siswa</label>
                            <input type="text" name="nama" class="form-control" value="<?= $sw->nama ?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?= $sw->email ?>">
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select name="kelas" class="form-control" id="kelas" required>
                                        <?php foreach ($kelas as $kls) : ?>

                                            <option value="<?= $kls->id; ?>" <?php if ($sw->id_kelas == $kls->id) {;  ?> selected='selected' <?php } ?>><?= $kls->kelas; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                                        <option value="">Pilih</option>
                                        <option value="L" <?php if ($sw->jenis_kelamin == 'L') {; ?> selected='selected' <?php } ?>>Laki-Laki</option>
                                        <option value="P" <?php if ($sw->jenis_kelamin == 'P') {; ?> selected='selected' <?php } ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <select name="jurusan" class="form-control" id="jurusan" required>
                                        <?php foreach ($jurusan as $jrs) : ?>

                                            <option value="<?= $jrs->id_jurusan; ?>" <?php if ($sw->id_jurusan == $jrs->id_jurusan) {;  ?> selected='selected' <?php } ?>><?= $jrs->id_jurusan; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="<?= $sw->alamat ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No hp</label>
                            <input type="text" name="nohp" class="form-control" value="<?= $sw->no_hp ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal update data -->

<!-- Modal Ceetak Laporan Siswa -->
<div class="modal fade bd-example-modal-lg" id="modalCetak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Print Laporan Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe name="display-frame" src="<?= base_url('report/cetakSiswa'); ?>" style="width:100%;height:520px;border:2px solid #4e46e5;"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Cetak Laporan Siswa -->

<!-- Modal Detail Siswa -->
<?php foreach ($siswa as $sw) : ?>
    <div class="modal fade bd-example-modal-lg" id="detail<?= encrypt_url($sw->id_siswa) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td style="width: 20%;">Id Member</td>
                            <td>: <?= $sw->id_member ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Email</td>
                            <td>: <?= $sw->email ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Nama</td>
                            <td>: <?= $sw->nama ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Jenis Kelamin</td>
                            <td>: <?php if ($sw->jenis_kelamin == 'L') { ?>
                                    Laki - Laki
                                <?php } else { ?> Perempuan <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Kelas</td>
                            <td>: <?= $sw->kelas ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Jurusan</td>
                            <td>: <?= $sw->id_jurusan ?> - <?= $sw->jurusan ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Alamat</td>
                            <td>: <?= $sw->alamat ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Kontak</td>
                            <td>: <?= $sw->no_hp ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Bergabung Sejak</td>
                            <td>: <?= date('d-M-Y', $sw->date_created) ?></td>
                        </tr>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir Modal Detail Siswa -->
</div>