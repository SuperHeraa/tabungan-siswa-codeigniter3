<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow px-2 py-2 mb-4">
        <table class="table table-borderless">
            <tr>
                <td style="width: 20%;font-weight:bold;">Subjek</td>
                <td> : <?= $detail_pengajuan['subjek'] ?></td>
            </tr>
            <tr>
                <td style="width: 20%;font-weight:bold;">Keterangan</td>
                <td> : <?= $detail_pengajuan['keterangan'] ?></td>
            </tr>
            <tr>
                <td style="width: 20%;font-weight:bold;">Tanggal Pengajuan</td>
                <td> : <?= date('d-m-Y', $detail_pengajuan['date_created']) ?></td>
            </tr>
            <tr>
                <td style="width: 20%;font-weight:bold;">Status Saat Ini</td>
                <td> : <span class="<?php if ($detail_pengajuan['status'] == '0') { ?>
                                badge badge-warning
                                <?php } elseif ($detail_pengajuan['status'] == '1') { ?>
                                    badge badge-success
                                    <?php } elseif ($detail_pengajuan['status'] == '2') { ?>
                                        badge badge-danger 
                                        <?php } else { ?>
                                            badge badge-secondary 
                                            <?php } ?>">
                        <?php if ($detail_pengajuan['status'] == '0') { ?>
                            Pending
                        <?php } elseif ($detail_pengajuan['status'] == '1') { ?>
                            Diterima
                        <?php } elseif ($detail_pengajuan['status'] == '2') { ?>
                            Ditolak
                        <?php } else { ?>
                            error
                        <?php } ?>
                    </span></td>
            </tr>
            <tr>
                <td style="width: 20%;font-weight:bold;">Petugas</td>
                <td> : <?= $detail_pengajuan['petugas'] ?> </td>
            </tr>
            <tr>
                <td style="width: 20%;font-weight:bold;">Catatan</td>
                <td> : <?= $detail_pengajuan['catatan'] ?> </td>
            </tr>
        </table>
        <div class="row">
            <div class="col-sm-4">
                <a href="<?= base_url('Pengajuan') ?>" class="btn btn-secondary btn-sm">
                    << kembali</a>
                        <a href="#resend<?= $detail_pengajuan['id_pengajuan'] ?>" data-toggle="modal" class="btn btn-warning btn-sm <?php if ($detail_pengajuan['status'] == '2') { ?>
            d-inline
            <?php } else { ?>
                d-none
                <?php } ?>">Ajukan Ulang</a>
            </div>
        </div>


    </div>


</div>
<!-- /.container-fluid -->


<!-- modal resend-->

<div id="resend<?= $detail_pengajuan['id_pengajuan'] ?>" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perbaiki Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() . 'pengajuan/resend/' . $detail_pengajuan['id_pengajuan'] ?>" method="post">
                    <div class="form-group">
                        <label for="subjek">Subjek</label>
                        <input type="text" name="subjek" id="subjek" class="form-control" value="<?= $detail_pengajuan['subjek'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="ket">Keterangan</label>
                        <textarea style="height: 10rem;" type="text" class="form-control" name="keterangan" id="ket" required><?= $detail_pengajuan['keterangan'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Nominal Penarikan</label>
                        <input name="penarikan" type="text" class="form-control" placeholder="Masukkan Jumlah" value="<?= $detail_pengajuan['nominal'] ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="convertToRupiah(this);">
                    </div>
            </div>
            <div class=" from-group row justify-content-end">
                <div class="col-sm-2 mb-2 mr-3">
                    <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                </div>
            </div>
            </form>
        </div>
    </div>


    <!-- Akhir modal catatan -->

</div>
<!-- End of Main Content -->