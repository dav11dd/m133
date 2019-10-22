<!--
 * @author Florian Leimer
 * @version 2019
 *
 * Template Formular und Liste Land. Responsiv mit Bootstrap.
 *
-->

<form name="fland" action="<?= getValue('formaction') ?>" method="post">
    <div class="form-group row">
        <label for="land" class="col-sm-2 col-form-label">Land(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo getCssClass('land') ?>" type="text" id="land" name="land" value="<?= getHtmlValue('land') ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-auto">
            <input class="btn btn-outline-secondary" type="submit" name="suchen" value="suchen">
            <input class="btn btn-outline-secondary" type="submit" name="neu" value="neu">
            <input class="btn btn-outline-secondary" type="submit" name="speichern" value="speichern">
            <input class="btn btn-outline-secondary" type="submit" name="loeschen" value="löschen" <?= getAdditionalAttributes('loeschen') ?>>
        </div>
    </div>
</form>

<?php if (getValue('showSearchResults')): ?>
    <table class="tstacked">
        <thead>
        <tr>
            <th>Land</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (getValue('data') as $land): ?>
            <tr onclick="selectLand(<?= $land['lid'] ?>)">
                <td data-label="Land"><?= $land['land'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <script language="javascript">
        function selectLand(lid) {
            window.location.href = "<?= getValue('phpmodule') ?>" + "&slid=" + lid;
        }
    </script>
<?php endif; ?>

<?php if (getValue('showNoSearchResults')): ?>
    <div class="alert alert-dark mt-4" role="alert">
        Kein Resultat gefunden.
    </div>
<?php endif; ?>
