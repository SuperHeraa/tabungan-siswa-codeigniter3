<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('Pengajuan/add'); ?>" method="post">
                <div class="form-group">
                    <label for="subjek">Subjek</label>
                    <input type="text" class="form-control" id="subjek" name="subjek" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea style="height: 10rem;" type="textarea" class="form-control" id="keterangan" name="keterangan" required></textarea>
                </div>
                <div class="form-group">
                    <label for="keterangan">Nominal Penarikan</label>
                    <input name="penarikan" type="text" class="form-control" placeholder="Masukkan Jumlah" value="<?= set_value('penarikan'); ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="convertToRupiah(this);">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Ajukan</button>
                    <a href="<?= base_url('Pengajuan') ?>" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->



</div>
<!-- End of Main Content -->