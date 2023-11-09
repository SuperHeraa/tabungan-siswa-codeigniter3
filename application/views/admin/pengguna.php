<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow px-4 py-4">
        <div class="row mb-4">
            <div class="col-6">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Data</h6>
            </div>
            <div class="col-6 text-right">
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i> Tambah Data</button>
            </div>
        </div>
        <div class="table-responsive">
            <table id="dataTable" class="table table-hover nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($user as $usr) : ?>
                        <tr>
                            <td style="width: 5%;"><?= $no++ ?></td>
                            <td><?= $usr->nama ?></td>
                            <td><?= $usr->email ?></td>
                            <td>
                                <a href="#modalEdit<?= $usr->id ?>" class="badge badge-primary pt-1 pb-1 mr-2" data-toggle="modal"><i class="fa fa-edit fa-xs"></i> Edit</button>
                                    <a href="#modalHapus<?= $usr->id ?>" class="badge badge-danger pt-1 pb-1" data-toggle="modal"><i class="fa fa-trash fa-xs"></i> Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->



<!-- Modal update data -->
<?php foreach ($user as $usr) : ?>
    <div class="modal fade" id="modalEdit<?= $usr->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h4 class="modal-title" id="exampleModalLabel">Update data Pengguna</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?= base_url() . 'pengguna/edit/' . $usr->id ?>" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control" value="<?= $usr->id ?>">
                            <label>Nama Pengguna</label>
                            <input type="text" name="nama" class="form-control" value="<?= $usr->nama ?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?= $usr->email ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal update data -->

<!-- Modal Hapus Data -->
<?php foreach ($user as $usr) : ?>
    <div class="modal fade" id="modalHapus<?= $usr->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <?= anchor('pengguna/hapus/' . $usr->id, '<button class="btn btn-primary">Yakin</button>') ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal hapus data -->

<!-- Modal Tambah Data -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-light">
                <h4 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="<?= base_url() . 'pengguna/tambah_pengguna' ?>">
                    <div class="alert alert-warning font-italic" role="alert">
                        -> Email yang terdaftar akan menjadi username<br>
                        -> Password default (<span style="color: blue;">admin123456</span>)
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah Data -->

</div>
<!-- End of Main Content -->