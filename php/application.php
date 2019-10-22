<?php
/**
 * @autor David Dubach
 * @version 2019
 *
 *  Dieses Modul beinhaltet Funktionen, welche die Anwendungslogik implementieren.
 *
 */

/*
 * Gibt die entsprechende CSS-Klasse aus einem assiziativen Array (key: Name Eingabefeld) zur�ck.
 * Wird im Template aufgerufen.
 *
 * @param   $name       Name des Eingabefeldes
 */
function getCssClass($name)
{
    global $css_classes;
    if (isset($css_classes[$name])) return $css_classes[$name];
    else return getValue('cfg_css_class_normal');
}

/*
 * Entsprechende CSS-Klasse auf "Invalid" (fehlerhafte Eingabe) setzen.
 * 
 * @param   $name       Name des Eingabefeldes
 */
function setCssClassInvalid($name)
{
    global $css_classes;
    $css_classes[$name] = getValue('cfg_css_class_error');
}

/*
 * Gibt zus�tzliche Attribute f�r ein Feld aus einem assiziativen Array (key: Name Eingabefeld) zur�ck.
 * Wird im Template aufgerufen.
 *
 * @param   $name       Name des Eingabefeldes
 */
function getAdditionalAttributes($name)
{
    global $additional_attributes;
    if (isset($additional_attributes[$name])) return implode(' ', $additional_attributes[$name]);
    else return '';
}

/*
 * Entsprechendes Feld deaktivieren
 *
 * @param   $name       Name des Eingabefeldes
 */
function setDisabled($name)
{
    global $additional_attributes;
    $additional_attributes[$name][] = 'disabled';
}

/*
 * Funktion zur Eingabepr�fung eines Landes.
 */
function checkLandInput()
{
    $status = true;

    if (!CheckName($_REQUEST['land'])) {
        setCssClassInvalid('land');
        $status = false;
    }

    return $status;
}

/*
 * Funktion zur Eingabepr�fung eines Ortes.
 */
function checkOrtInput()
{
    $status = true;

    if (!CheckOrt($_REQUEST['ort'])) {
        setCssClassInvalid('ort');
        $status = false;
    }
    if (!CheckNumber($_REQUEST['plz'])) {
        setCssClassInvalid('plz');
        $status = false;
    }

    return $status;
}

/*
 * Funktion zur Eingabepr�fung einer Person.
 */
function checkPersonInput()
{
    $status = true;

    if (!CheckName($_REQUEST['name'])) {
        setCssClassInvalid('name');
        $status = false;
    }
    if (!CheckName($_REQUEST['vorname'], 'Y')) {
        setCssClassInvalid('vorname');
        $status = false;
    }
    if (!CheckStrasse($_REQUEST['strasse'], 'Y')) {
        setCssClassInvalid('strasse');
        $status = false;
    }
    if (!CheckEmail($_REQUEST['email'])) {
        setCssClassInvalid('email');
        $status = false;
    }
    if (!CheckPhone($_REQUEST['tel_priv'], 'Y')) {
        setCssClassInvalid('tel_priv');
        $status = false;
    }
    if (!CheckPhone($_REQUEST['tel_gesch'], 'Y')) {
        setCssClassInvalid('tel_gesch');
        $status = false;
    }

    return $status;
}

/*
 * Beinhaltet die Anwendungslogik zur Landverwaltung
 */
function land()
{
    $formaction = $_SERVER['SCRIPT_NAME'] . "?id=" . __FUNCTION__;
    $additionalValues = [
        'showSearchResults' => false,
        'showNoSearchResults' => false
    ];


    if (isset($_REQUEST['suchen'])) {
        $laender = db_search_land($_REQUEST['land']);

        if (count($laender) > 0) {
            setValue('data', $laender);
            setValue('land', $laender[0]['land']);

            $formaction .= '&slid=' . $laender[0]['lid'];
            //setDisabled('loeschen');
            $additionalValues['showSearchResults'] = true;
        } else {
            $additionalValues['showNoSearchResults'] = true;
        }
    } else if (isset($_REQUEST['neu'])) {
        redirect(__FUNCTION__);
    } else if (isset($_REQUEST['speichern'])) {
        if (checkLandInput()) {
            if (isset($_REQUEST['slid'])) {
                db_update_land($_REQUEST);
            } else {
                db_insert_land($_REQUEST);
            }
            redirect(__FUNCTION__);
        } else {
            setValues($_REQUEST);
        }
    } else if (isset($_REQUEST['loeschen'])) {
        if (isset($_REQUEST['slid'])) db_delete_land($_REQUEST['slid']);
        redirect(__FUNCTION__);
    } else if (isset($_REQUEST['slid'])) {
        setValues(db_get_land($_REQUEST['slid']));
        $formaction .= '&slid=' . $_REQUEST['slid'];
        //setDisabled('loeschen');
    }

    // Template abf�llen und Resultat zur�ckgeben
    setValue('formaction', $formaction);
    setValue('phpmodule', $_SERVER['SCRIPT_NAME'] . "?id=" . __FUNCTION__);
    setValues($additionalValues);
    return runTemplate("templates/land.htm.php");
}

/*
 * Beinhaltet die Anwendungslogik zur Ortverwaltung
 */
function ort()
{
    $formaction = $_SERVER['SCRIPT_NAME'] . "?id=" . __FUNCTION__;
    $template = "templates/ortliste.htm.php";

    if (isset($_REQUEST['neu'])) {
        $template = "templates/ortform.htm.php";
    } else if (isset($_REQUEST['speichern'])) {
        if (checkOrtInput()) {
            if (isset($_REQUEST['soid'])) {
                db_update_ort($_REQUEST);
            } else {
                db_insert_ort($_REQUEST);
            }
            redirect(__FUNCTION__);
        } else {
            setValues($_REQUEST);
            $template = "templates/ortform.htm.php";
        }
    } else if (isset($_REQUEST['loeschen'])) {
        if (isset($_REQUEST['soid'])) db_delete_ort($_REQUEST['soid']);
        redirect(__FUNCTION__);
    } else if (isset($_REQUEST['abbrechen'])) {
        redirect(__FUNCTION__);
    } else if (isset($_REQUEST['soid'])) {
        setValues(db_get_ort($_REQUEST['soid']));

        //setDisabled('loeschen');
        $formaction .= '&soid=' . $_REQUEST['soid'];
        $template = "templates/ortform.htm.php";
    }

    setValue('data', db_get_orte());

    // Template abf�llen und Resultat zur�ckgeben
    setValue('formaction', $formaction);
    setValue('phpmodule', $_SERVER['SCRIPT_NAME'] . "?id=" . __FUNCTION__);
    return runTemplate($template);
}

/*
 * Beinhaltet die Anwendungslogik zur Personenverwaltung
 */
function person()
{
    $additionalValues = [
        'showNoSearchResults' => false
    ];

    if (isset($_REQUEST['suchen'])) {
        $_SESSION['searchParams'] = $_REQUEST;
        $foundPerson = db_get_first_person();
        if (empty($foundPerson)) {
            session_destroy();
            unset($_SESSION);
            session_start();

            $additionalValues['showNoSearchResults'] = true;
        } else {
            setValues($foundPerson);
        }
    } else if (isset($_REQUEST['neu'])) {
        session_destroy();
        redirect(__FUNCTION__);
    } else if (isset($_REQUEST['speichern'])) {
        if (checkPersonInput()) {
            if (!empty($_REQUEST['pid'])) {
                db_update_person($_REQUEST);
            } else {
                db_insert_person($_REQUEST);
            }
            session_destroy();
            redirect(__FUNCTION__);
        } else {
            setValues($_REQUEST);
        }
    } else if (isset($_REQUEST['loeschen'])) {
        if (isset($_REQUEST['pid'])) db_delete_person($_REQUEST['pid']);
        if (isset($_SESSION['searchParams'])) {
            $foundPerson = db_get_next_person($_REQUEST['pid']);

            if (empty($foundPerson)) {
                session_destroy();
                unset($_SESSION);
                session_start();

                $additionalValues['showNoSearchResults'] = true;
            } else {
                setValues($foundPerson);
            }
        } else {
            redirect(__FUNCTION__);
        }
    } else if (isset($_REQUEST['navleft'])) {
        if (isset($_SESSION['searchParams'])) setValues(db_get_previous_person($_REQUEST['pid']));
    } else if (isset($_REQUEST['navright'])) {
        if (isset($_SESSION['searchParams'])) setValues(db_get_next_person($_REQUEST['pid']));
    }

    if (!isset($_SESSION['searchParams'])) {
        setDisabled('navleft');
        setDisabled('navright');
    }

    setValue('orte', db_get_orte());
    setValue('laender', db_get_laender());

    // Template abf�llen und Resultat zur�ckgeben
    setValue('phpmodule', $_SERVER['SCRIPT_NAME'] . "?id=" . __FUNCTION__);
    setValues($additionalValues);
    return runTemplate("templates/person.htm.php");
}

?>