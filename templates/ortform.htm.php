<!--
 * @author Florian Leimer
 * @version 2019
 *
 * Template Formular Ort. Responsiv mit Bootstrap.
 *
-->

<form name="fort" action="<?= getValue('formaction') ?>" method="post">
    <div class="form-group row">
        <label for="plz" class="col-sm-2 col-form-label">Plz</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo getCssClass('plz') ?>" type="text" id="plz" name="plz"
                   value="<?= getHtmlValue('plz') ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="ort" class="col-sm-2 col-form-label">Ort(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo getCssClass('ort') ?>" type="text" id="ort" name="ort"
                   value="<?= getHtmlValue('ort') ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-auto">
            <input class="btn btn-outline-secondary" type="submit" name="speichern" value="speichern">
            <input class="btn btn-outline-secondary" type="submit" name="loeschen" value="löschen" <?= getAdditionalAttributes('loeschen') ?>>
            <input class="btn btn-outline-secondary" type="submit" name="abbrechen" value="abbrechen">
        </div>
    </div>
</form>
