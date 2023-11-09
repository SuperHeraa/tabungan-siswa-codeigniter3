<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <form method="post" action="<?= base_url() . 'setoran/setor_tunai' ?>" class="form-horizontal">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label">Nama Siswa</label>
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Belum Tersedia" value="<?= set_value('nama'); ?>" readonly>
                                </div>
                                <div class=" col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Nomor ID Member</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="id_member" name="id_member" placeholder="Belum Tersedia" value="<?= set_value('id_member'); ?>" readonly>
                                            <input type="hidden" class="form-control" id="id_siswa" name="id_siswa" value="<?= set_value('id_siswa'); ?>">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modal">CARI</button>
                                            </span>
                                        </div>
                                        <?= form_error('id_siswa', '<small class="text-danger pl-1">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Petugas</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                            </div>
                                            <input type="text" id="petugas" name="petugas" class="form-control" value="<?= $admin['nama'] ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Setor</label>
                                        <input class="form-control" name="tanggal_setor" type="date" value="<?= set_value('tanggal_setor'); ?>">
                                        <?= form_error('tanggal_setor', '<small class="text-danger pl-1">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Jumlah Setoran</label>
                                        <input name="setoran" type="text" class="form-control" placeholder="Masukkan Jumlah" value="<?= set_value('setoran'); ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="convertToRupiah(this);">
                                        <?= form_error('setoran', '<small class="text-danger pl-1">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Keterangan</label>
                                        <input name="keterangan" type="text" class="form-control" value="<?= set_value('keterangan'); ?>">
                                        <?= form_error('keterangan', '<small class="text-danger pl-1">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-right">
                            <button type="submit" class="btn btn-success pull-right">Setorkan</button>
                            <a href="<?= base_url('Tabungan'); ?>" class="btn btn-warning pull-right">Kembali</a>

                        </div>
                    </form>



                    <div id="modal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form role="form" id="form-tambah" method="post">
                                    <div class="modal-header">
                                        <center>
                                            <h3 class="modal-title">Pilih Siswa</h3>
                                        </center>
                                    </div>
                                    <div class="modal-body">

                                        <table width="100%" class="table table-hover" id="dataTable">
                                            <thead>
                                                <tr>

                                                    <th>No</th>
                                                    <th>Id Member</th>
                                                    <th>Nama</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $no = 1;
                                                foreach ($siswa as $sw) : ?>


                                                    <tr id="setor_tunai" data-id_member="<?= $sw->id_member ?>" data-nama="<?= $sw->nama ?>" data-id_siswa="<?= $sw->id_siswa ?>">


                                                        <td style="width: 5%;">
                                                            <?= $no++; ?>
                                                        </td>
                                                        <td style="width: 17%;">
                                                            <?= $sw->id_member ?>
                                                        </td>
                                                        <td>
                                                            <?= $sw->nama ?>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    </div>
                            </div>
                        </div>
                    </div>




                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->