
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
<script src='<?php echo pg; ?>/assets/dist/js/fullcalendar/fullcalendar.js'></script>
<script src='<?php echo pg; ?>/assets/dist/js/fullcalendar/locale/pt-br.js'></script>
<!-- Sparkline -->
<script src="<?php echo pg; ?>/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!-- <script src="<?php echo pg; ?>/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo pg; ?>/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="<?php echo pg; ?>/assets/plugins/jquery-knob/jquery.knob.min.js"></script> -->
<!-- daterangepicker -->
<!-- <script src="<?php echo pg; ?>/assets/plugins/moment/moment.min.js"></script> -->
<!-- <script src="<?php echo pg; ?>/assets/plugins/daterangepicker/daterangepicker.js"></script> -->
<!-- Tempusdominus Bootstrap 4 -->
<!-- <script src="<?php echo pg; ?>/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
<!-- Summernote -->
<!-- <script src="<?php echo pg; ?>/assets/plugins/summernote/summernote-bs4.min.js"></script> -->
<!-- overlayScrollbars -->
<!-- <script src="<?php echo pg; ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
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
<?php
$result_events = "SELECT id, title, color, descricao, start, end, idcli FROM events";
$resultado_events = mysqli_query($conn, $result_events);
?>
<script>
  $(document).ready(function() {
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      defaultDate: Date(),
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      eventClick: function(event) {
        
        $('#visualizar #id').text(event.id);
        $('#visualizar #id').val(event.id);
        $('#visualizar #title').text(event.title);
        $('#visualizar #title').val(event.title);
        $('#visualizar #descricao').text(event.descricao);
        $('#visualizar #descricao').val(event.descricao);
        $('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
        $('#visualizar #start').val(event.start.format('DD/MM/YYYY HH:mm:ss'));
        $('#visualizar #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
        $('#visualizar #end').val(event.end.format('DD/MM/YYYY HH:mm:ss'));
        $('#visualizar #color').val(event.color);
        $('#visualizar').modal('show');
        return false;

      },
      
      selectable: true,
      selectHelper: true,
      select: function(start, end){
        $('#cadastrar #start').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
        $('#cadastrar #end').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
        $('#cadastrar').modal('show');						
      },
      events: [
        <?php while($row_events = mysqli_fetch_array($resultado_events)){ ?>
            {
            id: '<?php echo $row_events['id']; ?>',
            title: '<?php echo $row_events['title']; ?>',
            descricao: '<?php echo $row_events['descricao']; ?>',
            start: '<?php echo $row_events['start']; ?>',
            end: '<?php echo $row_events['end']; ?>',
            color: '<?php echo $row_events['color']; ?>',
            },
        <?php } ?>
      ]
    });
  });
  
  //Mascara para o campo data e hora
  function DataHora(evento, objeto){
    var keypress=(window.event)?event.keyCode:evento.which;
    campo = eval (objeto);
    if (campo.value == '00/00/0000 00:00:00'){
      campo.value=""
    }
    
    caracteres = '0123456789';
    separacao1 = '/';
    separacao2 = ' ';
    separacao3 = ':';
    conjunto1 = 2;
    conjunto2 = 5;
    conjunto3 = 10;
    conjunto4 = 13;
    conjunto5 = 16;
    if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19)){
      if (campo.value.length == conjunto1 )
      campo.value = campo.value + separacao1;
      else if (campo.value.length == conjunto2)
      campo.value = campo.value + separacao1;
      else if (campo.value.length == conjunto3)
      campo.value = campo.value + separacao2;
      else if (campo.value.length == conjunto4)
      campo.value = campo.value + separacao3;
      else if (campo.value.length == conjunto5)
      campo.value = campo.value + separacao3;
    }else{
      event.returnValue = false;
    }
  }
</script>

</body>
</html>
