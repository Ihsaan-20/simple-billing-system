
<footer class="main-footer">
  <strong>Copyright &copy; 2023 <a href="https://www.linkedin.com/in/ihsaan-chandio-20aa11a5/">Ihsaan Chandio</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.2.0
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../admin/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../admin/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>



<!-- JQVMap -->
<script src="../admin/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../admin/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../admin/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../admin/assets/plugins/moment/moment.min.js"></script>
<script src="../admin/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../admin/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../admin/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../admin/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../admin/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../admin/assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../admin/assets/dist/js/pages/dashboard.js"></script>
<!-- datatables -->


<!-- DataTables  & Plugins -->
<script src="../admin/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../admin/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../admin/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../admin/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../admin/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../admin/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../admin/assets/plugins/jszip/jszip.min.js"></script>
<script src="../admin/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../admin/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../admin/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../admin/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../admin/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="../admin/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Toastr -->
<script src="../admin/assets/plugins/toastr/toastr.min.js"></script>
<!-- SweetAlert -->
<script src="../admin/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>
<script src="../admin/assets/dist/js/custom.js"></script>
<script src="../admin/assets/dist/js/custom2.js"></script>
<script src="../admin/assets/dist/js/storekey.js"></script>

</body>

</html>

