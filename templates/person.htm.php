<!--
 * @author Florian Leimer
 * @version 2019
 *
 * Template Formular Person. Responsiv mit Bootstrap.
 *
-->
<?php if (getValue('showNoSearchResults')): ?>
    <div class="alert alert-dark mb-4" role="alert">
        Kein Resultat gefunden.
    </div>
<?php endif; ?>
<form name="fperson" action="<?= getValue('phpmodule') ?>" method="post">
    <div>
        <input type="hidden" id="pid" name="pid" value="<?= getHtmlValue('pid') ?>">
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo getCssClass('name') ?>" type="text" id="name" name="name" value="<?= getHtmlValue('name') ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="vorname" class="col-sm-2 col-form-label">Vorname</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo getCssClass('vorname') ?>" type="text" id="vorname" name="vorname" value="<?= getHtmlValue('vorname') ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="strasse" class="col-sm-2 col-form-label">Strasse</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo getCssClass('strasse') ?>" type="text" id="strasse" name="strasse" value="<?= getHtmlValue('strasse') ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="oid" class="col-sm-2 col-form-label">Plz/Ort</label>
        <div class="col-sm-10">
            <select class="form-control <?php echo getCssClass('oid') ?>" type="text" id="oid" name="oid">
                <option></option>
                <?php foreach (getValue('orte') as $ort): ?>
                    <option value="<?= $ort['oid'] ?>" <?= ($ort['oid'] === getValue('oid')) ? 'selected="selected"' : '' ?>><?= $ort['ort'] ?> <?= $ort['plz'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email(*)</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo getCssClass('email') ?>" type="text" id="email" name="email" value="<?= getHtmlValue('email') ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="tel_priv" class="col-sm-2 col-form-label">Telefon Privat</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo getCssClass('tel_priv') ?>" type="text" id="tel_priv" name="tel_priv" value="<?= getHtmlValue('tel_priv') ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="tel_gesch" class="col-sm-2 col-form-label">Telefon Geschäft</label>
        <div class="col-sm-10">
            <input class="form-control <?php echo getCssClass('land') ?>" type="text" id="tel_gesch" name="tel_gesch" value="<?= getHtmlValue('tel_gesch') ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="lid" class="col-sm-2 col-form-label">Land</label>
        <div class="col-sm-10">
            <select class="form-control <?php echo getCssClass('lid') ?>" id="lid" name="lid">
                <option></option>
                <?php foreach (getValue('laender') as $land): ?>
                    <option value="<?= $land['lid'] ?>" <?= ($land['lid'] === getValue('lid')) ? 'selected="selected"' : '' ?>><?= $land['land'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-auto">
            <input class="btn btn-outline-secondary" type="submit" name="suchen" value="suchen">
            <input class="btn btn-outline-secondary" type="submit" name="neu" value="neu">
            <input class="btn btn-outline-secondary" type="submit" name="speichern" value="speichern">
            <input class="btn btn-outline-secondary" type="submit" name="loeschen" value="löschen" <?= getAdditionalAttributes('loeschen') ?>>
        </div>
        <div class="col text-right">
            <input class="btn btn-outline-secondary" type="submit" name="navleft" value="<<" <?= getAdditionalAttributes('navleft') ?>>
            <input class="btn btn-outline-secondary" type="submit" name="navright" value=">>" <?= getAdditionalAttributes('navright') ?>>
        </div>
    </div>
</form>
