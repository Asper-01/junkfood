<!--JavaScript executé par navigateur (plugin jQuery 
améliore la fonctionnalité des tableaux HTML en ajoutant des fonctionnalités de tri, 
de recherche et de pagination)-->
<script type="text/javascript">
    $(document).ready(function() {
        $('#data-table').DataTable({
            paging: true
        });
    });
</script>
</body>

</html>

<?php
if (isset($_SESSION['response'])) {
    unset($_SESSION['response']);
    unset($_SESSION['res_type']);
}
