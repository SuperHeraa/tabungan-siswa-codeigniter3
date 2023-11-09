<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="card shadow mb-4">
                <h5 class="card-header m-0 font-weight-bold text-primary">Identitas Sekolah</h5>
                <div class="card-body">
                    <?php
                    foreach ($sekolah as $sk) :
                    ?>
                        <p class="card-text"><i class="fas fa-fw fa-university"></i>&nbsp;<?= $sk->jenjang ?></p>
                        <p class="card-text"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;<?= $sk->nama_sekolah ?></p>
                        <p class="card-text"><i class="fas fa-fw fa-map-marker"></i>&nbsp;<?= $sk->alamat_sekolah ?></p>
                        <p class="card-text ml-4"></i>&nbsp;<?= $sk->alamat_2 ?></p>
                        <p class="card-text"><i class="fas fa-fw fa-building"></i></i>&nbsp;<?= $sk->kota ?></p>
                        <p class="card-text"><i class="fas fa-fw fa-mail-bulk"></i>&nbsp;<?= $sk->kontak_sekolah ?></p>
                        <p class="card-text"><i class="fas fa-fw fa-globe"></i>&nbsp;<?= $sk->situs_sekolah ?></p>
                        <p class="card-text"><i class="fas fa-fw fa-graduation-cap"></i>&nbsp;<?= $sk->jumlah_siswa ?> Siswa Terdaftar</p>
                    <?php endforeach; ?>

                    <a href="#modalIdentitas<?= $sk->id ?>" class="card-link" data-toggle="modal">-> Edit Identitas</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-4 px-2 py-2">
                <?= $this->session->flashdata('message-logo'); ?>
                <div class="text-center">
                    <img src="<?= base_url('assets/img/') . $logo['logo']; ?>" class="img-fluid" width="300">
                </div>
                <div class="card-footer">
                    <a href="#modalLogo" class="btn btn-success btn-sm" data-toggle="modal"> Ganti Logo</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="card shadow mb-4">
                <h5 class="card-header m-0 font-weight-bold text-primary">Pengelola Tabsis</h5>
                <div class="card-body">
                    <p class="card-text"><b>Nama : </b><?= $pengelola['nama_pengelola'] ?></p>
                    <a href="#modalEdit<?= $pengelola['id'] ?>" class="card-link" data-toggle="modal">-> Edit Pengelola Tabsis</a>
                </div>
            </div>
        </div>

    </div>


</div>
<!-- /.container-fluid -->

<!-- Modal update data kepsek -->

<div class="modal fade" id="modalEdit<?= $pengelola['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-light">
                <h4 class="modal-title" id="exampleModalLabel">Update Pengelola</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url() . 'sekolah/edit_pengelola/' . $pengelola['id'] ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id_pengelola" class="form-control" value="<?= $pengelola['id'] ?>">
                        <label>Nama Pengelola</label>
                        <input type="text" name="nama_pengelola" class="form-control" value="<?= $pengelola['nama_pengelola'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Akhir modal update data kepsek -->

<!-- Modal update data identitas sekolah -->
<?php foreach ($sekolah as $sk) : ?>
    <div class="modal fade" id="modalIdentitas<?= $sk->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h4 class="modal-title" id="exampleModalLabel">Update Identitas Sekolah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?= base_url() . 'sekolah/edit_identitas/' . $sk->id ?>" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control" value="<?= $sk->id ?>">
                            <label>Jenjang</label>
                            <input type="text" name="jenjang" class="form-control" value="<?= $sk->jenjang ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Sekolah</label>
                            <input type="text" name="nama_sekolah" class="form-control" value="<?= $sk->nama_sekolah ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat 1</label>
                            <input type="text" name="alamat" class="form-control" value="<?= $sk->alamat_sekolah ?>">
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Alamat 2</label>
                                    <input type="text" name="alamat2" class="form-control" value="<?= $sk->alamat_2 ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input type="text" name="kota" class="form-control" value="<?= $sk->kota ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Kontak</label>
                                    <input type="text" name="kontak" class="form-control" value="<?= $sk->kontak_sekolah ?>">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Jumlah Siswa</label>
                                    <input type="number" name="jumlah_siswa" class="form-control" value="<?= $sk->jumlah_siswa ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Situs Web</label>
                                    <input type="text" name="situs" class="form-control" value="<?= $sk->situs_sekolah ?>">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir modal update data identitas sekolah -->

<!-- Modal update logo -->
<div class="modal fade" id="modalLogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-light">
                <h4 class="modal-title" id="exampleModalLabel">Ganti Logo Sekolah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-warning font-italic" role="alert">
                <b class="text-dark">Ketentuan Upload</b><br>
                -> Ukuran maksimal 2 MB<br>
                -> Format gambar (<span class="font-weight-italic" style="color: red;">jpg, jpeg, png</span>)
            </div>
            <div class="modal-body">
                <?= form_open_multipart('sekolah/logo'); ?>
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Pilih File</label>
                </div>
                <div class="col mt-3 text-right">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button class="btn btn-success btn-sm" type="submit">Upload</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Akhir modal update logo -->





</div>
<!-- End of Main Content -->