    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js "></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- slimscroll js -->
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js "></script>

    <!-- menu js -->
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/vertical/vertical-layout.min.js "></script>

    <script type="text/javascript" src="assets/js/script.js "></script>


    <!-- Datatables -->
     <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
     <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
     <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
     <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
     <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script> -->
     <script src="assets/datatables/bootstrap.bundle.min.js"></script>
     <script src="assets/datatables/dataTables.js"></script>
     <script src="assets/datatables/responsive.bootstrap5.js"></script>
     <script src="assets/datatables/dataTables.bootstrap5.js"></script>
     <script>
        new DataTable('#example', {
            responsive: true
        });
     </script>



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>


<script>
function toggleKategoria(id) {
    var shortText = document.getElementById('short_' + id);
    var fullText = document.getElementById('full_' + id);

    if (fullText.style.display === 'none') {
        shortText.style.display = 'none';
        fullText.style.display = 'block'; // Display the full text as a block element (below)
    } else {
        shortText.style.display = 'inline';
        fullText.style.display = 'none'; // Hide the full text
    }
}
</script>

</body>

</html>