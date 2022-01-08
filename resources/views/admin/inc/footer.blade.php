<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2022 D3VCMS.</strong>
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1
    </div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Tooltips -->
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<!-- overlayScrollbars -->
<script src="{{asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $(function () {
        // Summernote
        $('#summernote').summernote()
    })
</script>
</body>

</html>
