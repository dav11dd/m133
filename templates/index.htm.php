<!--
 * @author Florian Leimer
 * @version 2019
 *
 * Haupttemplate.
 *
-->
<!doctype html>
<html>
<head>
    <title>MVC-GIBS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="datatables/dataTables.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="jquery/jquery-3.3.1.js"></script>
    <script src="popper/popper.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" charset="utf8" src="datatables/dataTables.js"></script>
</head>
<body>
    <header>
        <?php menu(getValue('cfg_menu_list'), getValue('cfg_menu')); ?>
    </header>

    <div class="container py-4">
        <?php echo getValue('inhalt'); ?>
    </div>
    <footer class="bg-dark text-white py-3">
        <div class="container">
            <span class="small">&copy; Copyright GIBS Solothurn</span>
        </div>
    </footer>

    <script language="javascript"> $(document).ready(function () {
            $('table.dataTable').DataTable({
                // Sprache "Deutsch" setzen
                language: {
                    url: "datatables/German.json",
                }
            });
        });
    </script>

</body>
</html>