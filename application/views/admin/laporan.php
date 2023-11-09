<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-4 mb-2 px-2 py-2">
            <div class="card shadow">
                <div class="card-header">
                    <h6>Laporan Data Siswa</h6>
                </div>
                <div class="card-body">
                    <a href="<?= base_url('report/cetakSiswa') ?>" class="btn btn-info btn-sm mb-1" target="_blank">Semua Siswa</a>
                    <a href="#cetakSiswaPerkelas" class="btn btn-info btn-sm mb-1" data-toggle="modal">Perkelas</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-2 px-2 py-2">
            <div class="card shadow">
                <div class="card-header">
                    <h6>Laporan Data Tabungan</h6>
                </div>
                <div class="card-body">
                    <a href="<?= base_url('report/cetakTabungan') ?>" class="btn btn-info btn-sm mb-1" target="_blank">Semua Tabungan</a>
                    <a href="#cetakTabunganPerkelas" class="btn btn-info btn-sm mb-1" data-toggle="modal">Perkelas</a>
                    <a href="#cetakTabunganPerbulan" class="btn btn-warning btn-sm mb-1" data-toggle="modal">Periodik</a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- modal siswa perkelas -->
<div id="cetakSiswaPerkelas" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light">Laporan Siswa Perkelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('report/siswaperkelas') ?>" target="_blank">
                    <div class="row">
                        <div class="col">
                            <select class="form-control" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <?php foreach ($kelas as $kls) : ?>
                                    <option value="<?= $kls->id ?>"><?= $kls->kelas ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control" name="jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                <?php foreach ($jurusan as $jrs) : ?>
                                    <option value="<?= $jrs->id_jurusan ?>"><?= $jrs->id_jurusan ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>


            </div>
            <div class="from-group row justify-content-end">
                <div class="col-sm-3 mb-2 mr-3">
                    <button type="submit" class="btn btn-primary btn-sm">Cetak</button>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>

<!-- Akhir modal siswa perkelas -->

<!-- modal siswa perbulan -->
<div id="cetakTabunganPerbulan" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light">Laporan Tabungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('report/tbperiodik') ?>" target="_blank">
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" name="tanggal_1" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" name="tanggal_2" class="form-control" required>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="from-group row justify-content-end">
                <div class="col-sm-3 mb-2 mr-3">
                    <button type="submit" class="btn btn-primary btn-sm">Cetak</button>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>

<!-- Akhir modal siswa perbulan -->

<!-- modal tabungan perkelas -->
<div id="cetakTabunganPerkelas" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light">Laporan Tabungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('report/tabunganperkelas') ?>" target="_blank">
                    <div class="row">
                        <div class="col">
                            <select class="form-control" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <?php foreach ($kelas as $kls) : ?>
                                    <option value="<?= $kls->id ?>"><?= $kls->kelas ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control" name="jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                <?php foreach ($jurusan as $jrs) : ?>
                                    <option value="<?= $jrs->id_jurusan ?>"><?= $jrs->id_jurusan ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="from-group row justify-content-end">
                <div class="col-sm-3 mb-2 mr-3">
                    <button type="submit" class="btn btn-primary btn-sm">Cetak</button>
                </div>
            </div>

            </form>
        </div>
    </div>

    <!-- Akhir modal tabungan perkelas -->



    <!-- end -->

</div>

</div>
<!-- End of Main Content -->