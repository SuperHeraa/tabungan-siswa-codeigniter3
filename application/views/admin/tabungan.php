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
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data</h6>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                    <a href="<?= base_url('Setoran'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Setoran</a>
                    <a href="<?= base_url('Penarikan'); ?>" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i> Penarikan</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Id Member</th>
                            <th>Jurusan</th>
                            <th>Saldo</th>
                            <th>Aksi</th>
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
                                <td><?= $tb->id_member ?></td>
                                <td><?= $tb->id_jurusan ?></td>
                                <td>Rp. <?= rupiah($tb->jml_setoran - $tb->jml_penarikan) ?></td>
                                <td class="text-center" width="5%">
                                    <a href="<?= base_url('Detail/index/' . encrypt_url($tb->id_siswa)); ?>" data-toggle="tooltip" title="Detail Tabungan" class="badge badge-primary"><i class="fa fa-info-circle fa-sm"></i> Detail</a>
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

<!-- Modal Ceetak Laporan Tabungan -->
<div class="modal fade bd-example-modal-lg" id="modalCetak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Print Laporan Data Tabungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe name="display-frame" src="<?= base_url('report/cetakTabungan'); ?>" style="width:100%;height:520px;border:2px solid #4e46e5;"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Cetak Laporan Tabungan -->

</div>
<!-- End of Main Content -->