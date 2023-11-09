<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="col-lg-12">
        <?= $this->session->flashdata('message_mg_tb'); ?>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 mt-2">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="m-0 font-weight-bold text-primary">Pengaturan Kelas</h5>
                </div>
                <div class="card-body">
                    <div class="text-right mb-1">
                        <a href="#tambahKelas" class="badge badge-success" data-toggle="modal"><i class=" fa fa-plus"></i> Tambah</a>
                    </div>
                    <table class="table table-sm table-hover">
                        <thead>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Wali Kelas</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kelas as $kls) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $kls->kelas; ?></td>
                                    <td><?= $kls->walas; ?></td>
                                    <td style="width: 20%;" class="text-nowrap">
                                        <a href="#editKelas<?= $kls->id ?>" data-toggle="modal" class="badge badge-primary">edit</a>
                                        <a href="#hapusKelas<?= $kls->id ?>" data-toggle="modal" class="badge badge-danger">hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 mt-2">
            <?= $this->session->flashdata('message_jrs'); ?>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="m-0 font-weight-bold text-primary">Pengaturan Jurusan</h5>
                </div>
                <div class="card-body">
                    <div class="text-right mb-1">
                        <a href="#tambahJurusan" data-toggle="modal" class="badge badge-success"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                    <table class="table table-sm table-hover">
                        <thead>
                            <th>No</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($jurusan as $jrs) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $jrs->jurusan ?></td>
                                    <td style="width: 20%;" class="text-nowrap">
                                        <a href="#editJurusan<?= $jrs->id_jurusan ?>" data-toggle="modal" class="badge badge-primary">edit</a>
                                        <a href="#hapusJurusan<?= $jrs->id_jurusan ?>" data-toggle="modal" class="badge badge-danger">hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="card shadow mt-2">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manajemen Tabungan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive col-lg-12 col-md-12">
                <form action="<?= base_url('Alat/remove'); ?>" method="post">
                    <table class="table table-hover text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Saldo</th>
                                <th>
                                    <button type="submit" name="hapusSemua" class="btn btn-danger btn-sm" style="border: none;">Hapus</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data_tabungan as $tb) :
                            ?>
                                <tr>
                                    <td width="5%"><?= $no++ ?></td>
                                    <td><?= $tb->nama ?></td>
                                    <td><?= $tb->kelas ?></td>
                                    <td><?= $tb->id_jurusan ?></td>
                                    <td>Rp . <?= rupiah($tb->jml_setoran - $tb->jml_penarikan) ?></td>
                                    <td class="text-center" width="5%"><input type="checkbox" name="isi_checkbox[]" value="<?= $tb->id_siswa ?>"></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div> -->

    <div class="row mt-3 mb-4">
        <div class="col-sm-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-success font-weight-bold"><i class="fas fa-database"></i> Backup Database</h5>
                    <p class="card-text">Untuk memaksimalkan keamanan data, sebaiknya <b>backup database satu minggu 1x</b></p>
                    <a href="<?= base_url('Alat/backup_db'); ?>" class="btn btn-success btn-sm">Backup Sekarang</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-danger font-weight-bold"><i class="fas fa-undo-alt"></i> Reset Aplikasi</h5>
                    <p class="card-text">Mengembalikan aplikasi ke setelan awal. <b>Semua data yang tersimpan di database akan di kosongkan!</b></p>
                    <a href="#Reset" data-toggle="modal" class="btn btn-danger btn-sm">Reset Aplikasi</a>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->


<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h4 class="modal-title" id="exampleModalLabel">Tambah Kelas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="<?= base_url() . 'alat/tambah_kelas' ?>">
                    <div class="form-group">
                        <label>Masukan Kelas</label>
                        <input type="text" name="kelas" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Wali Kelas</label>
                        <input type="text" name="walas" class="form-control" required>
                    </div>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah Data -->

<!-- Modal Tambah Data Jurusan -->
<div class="modal fade" id="tambahJurusan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h4 class="modal-title" id="exampleModalLabel">Tambah Kelas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="<?= base_url() . 'alat/tambah_jurusan' ?>">
                    <div class="form-group">
                        <label>Singkatan Jurusan</label>
                        <input type="text" name="id_jurusan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" required>
                    </div>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah Data Jurusan -->

<!-- Modal update data -->
<?php foreach ($kelas as $kls) : ?>
    <div class="modal fade" id="editKelas<?= $kls->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h4 class="modal-title" id="exampleModalLabel">Update Data Kelas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?= base_url() . 'alat/edit_kelas/' . $kls->id ?>" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id_kelas" class="form-control" value="<?= $kls->id ?>">
                            <label>Nama Kelas</label>
                            <input type="text" name="kelas" class="form-control" value="<?= $kls->kelas ?>">
                        </div>
                        <div class="form-group">
                            <label>Wali Kelas</label>
                            <input type="text" name="walikelas" class="form-control" value="<?= $kls->walas ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal update data -->

<!-- Modal update data Jurusan -->
<?php foreach ($jurusan as $jrs) : ?>
    <div class="modal fade" id="editJurusan<?= $jrs->id_jurusan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h4 class="modal-title" id="exampleModalLabel">Update Data Jurusan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?= base_url() . 'alat/edit_jurusan/' . $jrs->id_jurusan ?>" method="post">
                        <div class="form-group">
                            <label>Singkatan Jurusan</label>
                            <input type="text" name="id_jurusan" class="form-control" value="<?= $jrs->id_jurusan ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" value="<?= $jrs->jurusan ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal update data Jurusan -->

<!-- Modal Hapus Data -->
<?php foreach ($kelas as $kls) : ?>
    <div class="modal fade" id="hapusKelas<?= $kls->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <?= anchor('alat/hapus_kelas/' . $kls->id, '<button class="btn btn-primary">Yakin</button>') ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal hapus data -->

<!-- Modal Hapus Data Jurusan -->
<?php foreach ($jurusan as $jrs) : ?>
    <div class="modal fade" id="hapusJurusan<?= $jrs->id_jurusan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <?= anchor('alat/hapus_jurusan/' . $jrs->id_jurusan, '<button class="btn btn-primary">Yakin</button>') ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal hapus data Jurusan -->

<!-- Modal Reset -->
<div class="modal fade" id="Reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h4 class="modal-title" id="exampleModalLongTitle">Reset Aplikasi</h4>
            </div>
            <div class="modal-body text-dark">
                Proses Reset mungkin akan memakan waktu beberapa saat,<br />
                <b> Anda Ingin Me-reset Aplikasi ? </b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                <a href="<?= base_url('Alat/reset_apl'); ?>" class="btn btn-danger btn-sm">Reset Aplikasi</a>
            </div>
        </div>
    </div>
</div>
<!-- Akhir modal Reset -->

</div>
<!-- End of Main Content -->