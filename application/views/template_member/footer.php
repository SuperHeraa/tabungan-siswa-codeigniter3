 <!-- Footer -->
 <footer class="sticky-footer bg-white">
     <div class="container my-auto">
         <div class="copyright text-center my-auto">
             <span>Created with <img src="<?= base_url('assets/img/love.gif'); ?>"> &copy; Tabsis SMK Citra Mandiri <?= date('Y'); ?></span>
         </div>
     </div>
 </footer>
 <!-- End of Footer -->

 </div>
 <!-- End of Content Wrapper -->

 </div>
 <!-- End of Page Wrapper -->

 <!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
     <i class="fas fa-angle-up"></i>
 </a>

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Apa Anda Yakin Keluar?</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">Tekan "Logout" jika ingin mengakhiri sesi</div>
             <div class="modal-footer">
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                 <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
             </div>
         </div>
     </div>
 </div>

 <!-- Bootstrap core JavaScript-->
 <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
 <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
 <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

 <!-- Page level plugins -->
 <script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
 <script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

 <!-- Page level custom scripts -->
 <script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>
 <!-- convert to rupiah -->
 <script src="<?= base_url('assets/'); ?>js/rupiah.js"></script>

 <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>

 <script src="<?= base_url('assets/js/') ?>croppie.min.js"></script>
 <script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>



 <script>
     function inputAngka(evt) {

         var charCode = (evt.which) ? evt.which : event.keyCode

         if (charCode > 31 && (charCode < 48 || charCode > 57))

             return false;

         return true;

     }

     $('.custom-file-input').on('change', function() {
         let filename = $(this).val().split('\\').pop();
         $(this).next('.custom-file-label').addClass("selected").html(filename);
     });

     $('.det').hover(function() {
         $(this).css('background-color', 'rgba(27, 54, 197, 0.1)');
     }, function() {
         $(this).css('background-color', '');
     });

     //  if (jQuery.browser.mobile) {
     //      $("#accordionSidebar").addClass("toggled");
     //  } else {
     //      $("#accordionSidebar").removeClass("toggled");
     //  }

     if ($(window).width() <= 480) {
         $(".sidemobile").addClass('toggled');
         $("#nm_sw").addClass('text-nowrap');
         $(".item").css('display', 'none');
         $("#item").css('display', 'none');
         $(".item-saldo").css('width', '20%');
         $(".item-saldo").css('font-size', '13px');
         $(".item-nama").css('font-size', '13px');
         $(".trans-month").css('height', '20rem');

     } else {
         $(".sidemobile").removeClass('toggled');
         $(".item-saldo").css('width', '20%');
         $(".item-nama").css('font-size', '16px');
     }

     //  $(document).ready(function() {
     //      $("#btnAksi").click(function() {
     //          $("#tdAksi").css('width', '10%');
     //          if (!$("#thAksi, #tdAksi").is(':visible')) {
     //              $('#thAksi, #tdAksi').css('display', 'table-cell');
     //              $('#btnAksi').text('Sembunyikan Aksi');
     //          } else {
     //              $('#thAksi, #tdAksi').css('display', 'none');
     //              $('#btnAksi').text('Tampil Aksi');
     //          }
     //      });
     //  });
 </script>


 <script type="text/javascript">
     // autoclose flashdata
     window.setTimeout(function() {
         $(".mess").fadeTo(500, 0).slideUp(500, function() {
             $(this).remove();
         });
     }, 2000);


     $(document).ready(function() {

         $(document).on('click', '#penarikan', function(e) {
             document.getElementById("id_siswa").value = $(this).attr('data-id_siswa');
             document.getElementById("id_member").value = $(this).attr('data-id_member');
             document.getElementById("nama").value = $(this).attr('data-nama');
             document.getElementById("saldo").value = $(this).attr('data-saldo');
             $('#modal').modal('hide');
         });

     });

     $(document).ready(function() {

         $(document).on('click', '#setor_tunai', function(e) {
             document.getElementById("id_member").value = $(this).attr('data-id_member');
             document.getElementById("id_siswa").value = $(this).attr('data-id_siswa');
             document.getElementById("nama").value = $(this).attr('data-nama');
             $('#modal').modal('hide');
         });

     });

     $(document).ready(function() {
         $('#show-password').click(function() {
             if ($(this).is(':checked')) {
                 $('#inputPassword').attr('type', 'text');
             } else {
                 $('#inputPassword').attr('type', 'password');
             }
         });
     });

     $(document).ready(function() {
         var table = $('#example').DataTable({
             responsive: true
         });
         new $.fn.dataTable.FixedHeader(table);

     });
     // croppie
     $(document).ready(function() {
         $image_crop = $('#image_demo').croppie({
             enableExif: true,
             viewport: {
                 width: 200,
                 height: 230,
                 type: 'square' //circle
             },
             boundary: {
                 width: 350,
                 height: 350
             }
         });

         $('#upload_image').on('change', function() {
             var reader = new FileReader();
             reader.onload = function(event) {
                 $image_crop.croppie('bind', {
                     url: event.target.result
                 }).then(function() {
                     console.log('jQuery bind complete');
                 });
             }
             reader.readAsDataURL(this.files[0]);
             $('#editGambar').modal('hide');
             $('#uploadimageModal').modal('show');
         });

         $('.crop_image').click(function(event) {
             $image_crop.croppie('result', {
                 type: 'canvas',
                 size: 'viewport'
             }).then(function(response) {
                 $.ajax({
                     url: "<?= base_url('Profil_m/upload') ?>",
                     type: "POST",
                     data: {
                         "image": response
                     },
                     success: function(data) {
                         $('#uploadimageModal').modal('hide');
                         $('#uploaded_image').html(data);
                     }
                 });
             })
         });
     });
 </script>



 </body>

 </html>