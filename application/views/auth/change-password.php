<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-md-center">

        <div class="col-lg-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h4><?= $title ?></h4>
                                <h6><?= $this->session->userdata('reset_email'); ?></h6>
                            </div>
                            <?= $this->session->flashdata('message'); ?>
                            <form class="user" method="POST" action="<?= base_url('auth/changepassword'); ?>">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Masukan Password Baru...">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Password Baru...">
                                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block mt-4">
                                    Ganti Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>