<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <div class="card px-4 py-4">
                <div class="table-responsive px-1 pb-2">
                    <table id="example" class="table table-hover nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Petugas</th>
                                <th>Setoran</th>
                                <th>Penarikan</th>
                                <th>Keterangan</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($tmp_riwayat as $tr) : ?>
                                <tr class="det" style="color:<?php if ($tr->setoran == 0) { ?>
                            red;
                            <?php } else { ?>
                             green;   
                                <?php } ?>">
                                    <td style="width: 2%;"><?= $no++ ?></td>
                                    <td style="width: 20%;"><?= tgl_id($tr->tanggal) ?></td>
                                    <td><?= $tr->petugas ?></td>
                                    <td><?= rupiah($tr->setoran) ?></td>
                                    <td><?= rupiah($tr->penarikan) ?></td>
                                    <td><?= $tr->keterangan ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->