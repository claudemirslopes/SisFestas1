
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021-2022 <a href="https://openbeta.com.br">Claudemir Lopes</a>.</strong>
    Direitos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Versão</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <!-- <aside class="control-sidebar control-sidebar-dark">
    
  </aside> -->
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://kit.fontawesome.com/a8568f4b07.js" crossorigin="anonymous"></script>
<script src="<?php echo pg; ?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo pg; ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Sweet Alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo pg; ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo pg; ?>/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Datatables -->
<script src="<?php echo pg; ?>/assets/datatables/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo pg; ?>/assets/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo pg; ?>/assets/datatables/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo pg; ?>/assets/datatables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo pg; ?>/assets/datatables/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo pg; ?>/assets/datatables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo pg; ?>/assets/datatables/jszip/jszip.min.js"></script>
<script src="<?php echo pg; ?>/assets/datatables/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo pg; ?>/assets/datatables/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo pg; ?>/assets/datatables/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo pg; ?>/assets/datatables/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo pg; ?>/assets/datatables/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- FullCalendar -->
<script src='<?php echo pg; ?>/assets/dist/js/moment.min.js'></script>
<script src='<?php echo pg; ?>/assets/dist/js/fullcalendar/fullcalendar.min.js'></script>
<script src='<?php echo pg; ?>/assets/dist/js/fullcalendar/fullcalendar.js'></script>
<script src='<?php echo pg; ?>/assets/dist/js/fullcalendar/locale/pt-br.js'></script>
<!-- Sparkline -->
<script src="<?php echo pg; ?>/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo pg; ?>/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo pg; ?>/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo pg; ?>/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo pg; ?>/assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo pg; ?>/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo pg; ?>/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo pg; ?>/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo pg; ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo pg; ?>/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src='<?php echo pg; ?>/assets/js/script.js'></script>
 <!-- Main JS -->
  <script src="<?php echo pg; ?>/assets/js/app.js"></script>
  <script src="<?php echo pg; ?>/assets/js/empresas.js"></script>
  <script src="<?php echo pg; ?>/assets/js/jquery.mask.min.js"></script>
<script src="<?php echo pg; ?>/assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo pg; ?>/assets/dist/js/pages/dashboard.js"></script>
<script>
$(function () {
    $("#example1").DataTable({
    "order": [[ 0, "desc" ]],
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
    $("#example3").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>
<script>

  $(document).ready(function() {

    var date = new Date();
       var yyyy = date.getFullYear().toString();
       var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
       var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
    
    $('#calendar').fullCalendar({
      header: {
         language: 'pt-br',
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay,listMonth',

      },
      defaultDate: yyyy+"-"+mm+"-"+dd,
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      selectable: true,
      selectHelper: true,
      select: function(start, end) {
        
        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalAdd').modal('show');
      },
      eventRender: function(event, element) {
        element.bind('dblclick', function() {
          $('#ModalEdit #id').val(event.id);
          $('#ModalEdit #title').val(event.title);
          $('#ModalEdit #color').val(event.color);
          $('#ModalEdit').modal('show');
        });
      },
      eventDrop: function(event, delta, revertFunc) { // si changement de position

        edit(event);

      },
      eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

        edit(event);

      },
      events: [
        {
          id: '1',
          title: 'Cas: Rita e Jonas',
          start: '2021-08-31 08:24:00',
          end: '2021-08-31 16:55:45',
          color: '#B40486',
        },
        {
          id: '2',
          title: 'Festa: Maria Eduarda',
          start: '2021-09-04 08:24:00',
          end: '2021-09-04 16:55:45',
          color: '#0040FF',
        },
        {
          id: '3',
          title: 'Boleto Pago',
          start: '2021-09-05 08:24:00',
          end: '2021-09-05 16:55:45',
          color: '#088A68',
        },
        {
          id: '4',
          title: 'Festa: Caio Ortolan',
          start: '2021-09-05 08:24:00',
          end: '2021-09-05 16:55:45',
          color: '#0040FF',
        },
        {
          id: '5',
          title: 'Boleto Vencido',
          start: '2021-09-09 14:24:00',
          end: '2021-09-09 16:55:45',
          color: '#FE2E2E',
        },
        {
          id: '6',
          title: 'Boleto Pago',
          start: '2021-09-13 17:24:00',
          end: '2021-09-13 16:55:45',
          color: '#088A68',
        },
        {
          id: '7',
          title: 'Cas: Maria e João',
          start: '2021-09-15 08:24:00',
          end: '2021-09-15 16:55:45',
          color: '#B40486',
        },
        {
          id: '8',
          title: 'Boleto Vencido',
          start: '2021-09-17 19:24:00',
          end: '2021-09-17 16:55:45',
          color: '#FE2E2E',
        },
        {
          id: '9',
          title: 'Festa: Mônica Santos',
          start: '2021-09-17 08:24:00',
          end: '2021-09-17 16:55:45',
          color: '#0040FF',
        },
        {
          id: '10',
          title: 'Boleto Vencido',
          start: '2021-09-22 11:24:00',
          end: '2021-09-22 16:55:45',
          color: '#FE2E2E',
        },
        {
          id: '11',
          title: 'Boleto Aberto',
          start: '2021-09-26 12:24:00',
          end: '2021-09-26 16:55:45',
          color: '#DBA901',
        },
        {
          id: '12',
          title: 'Deb: Sthefanie Laura',
          start: '2021-09-28 08:24:00',
          end: '2021-09-28 16:55:45',
          color: '#4B088A',
        },
        {
          id: '13',
          title: 'Boleto Aberto',
          start: '2021-09-30 12:24:00',
          end: '2021-09-30 16:55:45',
          color: '#DBA901',
        },
      ]
    });
    
    function edit(event){
      start = event.start.format('YYYY-MM-DD HH:mm:ss');
      if(event.end){
        end = event.end.format('YYYY-MM-DD HH:mm:ss');
      }else{
        end = start;
      }
      
      id =  event.id;
      
      Event = [];
      Event[0] = id;
      Event[1] = start;
      Event[2] = end;
      
      $.ajax({
       url: 'editEventDate.php',
       type: "POST",
       data: {Event:Event},
       success: function(rep) {
          if(rep == 'OK'){
            alert('Inserção realizada com sucesso');
          }else{
            alert('Não foi possível gravar, Tentar novamente!.'); 
          }
        }
      });
    }
    
  });

</script>
</body>
</html>
