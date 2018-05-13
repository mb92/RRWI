<?php 
use yii\helpers\Url;
?>

<!-- jQuery 3.1.1 -->
<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- DataTables -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="/plugins/lightbox2-master/dist/js/lightbox.js"></script>
<!-- <script src="//code.jquery.com/jquery-1.12.4.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> -->

<!-- <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js"></script> -->

<script>
   $('#table').DataTable({
      "searching": true,
      "ordering": true,
      "order": [[ 3, "desc" ]],
      "autoWidth": false,
      "paging": false,
      "bInfo": false,
    });
</script>

<script>
   $('#tableBasic').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[ 3, "desc" ]],
      "info": true,
      "autoWidth": false,
      "bInfo": false,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "pagingType": "full_numbers",
    });
</script>

<!-- SlimScroll -->
<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
<!-- page script -->
