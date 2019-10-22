<!--
 * @author David Dubach
 * @version 2019
 *
 * Template Liste Orte. Responsiv mit Bootstrap.
 *
-->

<form name="fort" action="<?= getValue('formaction') ?>" method="post">
    <div class="form-group row">
        <div class="col-auto">
            <input class="btn btn-outline-secondary" type="submit" name="neu" value="neu">
        </div>
    </div>
</form>

<table class="tstacked dataTable">
    <thead>
    <tr>
        <th>Plz</th>
        <th>Ort</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach (getValue('data') as $ort): ?>
        <tr onclick="selectOrt(<?= $ort['oid'] ?>)">
            <td data-label="Plz"><?= $ort['plz'] ?></td>
            <td data-label="Ort"><?= $ort['ort'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script language="javascript">
    function selectOrt(oid) {
        window.location.href = "<?= getValue('phpmodule') ?>" + "&soid=" + oid;
    }
</script>
