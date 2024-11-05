
@section('custom-css')
<style>
td:hover{
  cursor:move;
  }
  </style>

@endsection

@section('custom-js')
<script src="{{asset('/')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('/')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('/')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('/')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('/')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('/')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('/')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('/')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('/')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('/')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
      }).buttons().container().appendTo('#example1_wrapper .col-md-12:eq(0)');
  
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
  
    var fixHelperModified = function(e, tr) {
          var $originals = tr.children();
          var $helper = tr.clone();
          $helper.children().each(function(index) {
              $(this).width($originals.eq(index).width())
          });
          return $helper;
      },
          updateIndex = function(e, ui) {
              $('td.index', ui.item.parent()).each(function (i) {
                  $(this).html(i+1);
              });
              $('input[type=text]', ui.item.parent()).each(function (i) {
                  $(this).val(i + 1);
              });
          };
  
      $("#example1 tbody").sortable({
          helper: fixHelperModified,
          stop: updateIndex
      }).disableSelection();
      
          $("tbody").sortable({
          distance: 5,
          delay: 100,
          opacity: 0.6,
          cursor: 'move',
          update: function() {}
              });
  
  </script>
@endsection