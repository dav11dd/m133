<?php
/**
 *  @autor Florian Leimer
 *  @version 2019
 *
 *  Dieses Modul beinhaltet sämtliche Datenbankfunktionen.
 *  Die Funktionen formulieren die SQL-Anweisungen und rufen dann die Funktionen
 *  sqlQuery() und sqlSelect() aus dem Modul basic_functions.php auf.
 *
 */

function db_insert_land($params)
{
    $sql = "INSERT INTO land (land) VALUES ('" . addslashes($params['land']) . "')";
    sqlQuery($sql);
}

function db_update_land($params)
{
    $sql = "UPDATE land SET land = '" . $params['land'] . "' WHERE lid = " . $params['slid'];
    sqlQuery($sql);
}

function db_search_land($name)
{
    return sqlSelect("SELECT * FROM land WHERE land LIKE '" . $name . "%'");
}

function db_get_laender()
{
    return sqlSelect("SELECT * FROM land");
}

function db_get_land($lid)
{
    return array_shift(sqlSelect("SELECT * FROM land WHERE lid='$lid'"));
}

function db_delete_land($lid)
{
    if (isCleanNumber($lid)) sqlQuery("DELETE FROM land WHERE lid='$lid'");
}


function db_insert_ort($params)
{
    $sql = "INSERT INTO ort (plz, ort) VALUES ('" . addslashes($params['plz']) . "', '" . addslashes($params['ort']) . "')";
    sqlQuery($sql);
}

function db_update_ort($params)
{
    $sql = "UPDATE ort SET plz = '" . $params['plz'] . "', ort = '" . $params['ort'] . "' WHERE oid = " . $params['soid'];
    sqlQuery($sql);
}

function db_get_orte()
{
    return sqlSelect("SELECT * FROM ort ORDER BY ort");
}

function db_get_ort($oid)
{
    return array_shift(sqlSelect("SELECT * FROM ort WHERE oid='$oid'"));
}

function db_delete_ort($oid)
{
    if (isCleanNumber($oid)) sqlQuery("DELETE FROM ort WHERE oid='$oid'");
}

function db_insert_person($params)
{
    $sql = "INSERT INTO personen (name, vorname, strasse, oid, email, tel_priv, tel_gesch, lid) " .
        "VALUES ('" . addslashes($params['name']) . "', '" . addslashes($params['vorname']) . "', '" . addslashes($params['strasse']) . "', '" . addslashes($params['oid']) . "', '" . addslashes($params['email']) . "', '" . addslashes($params['tel_priv']) . "', '" . addslashes($params['tel_gesch']) . "', '" . addslashes($params['lid']) . "')";
    sqlQuery($sql);
}

function db_update_person($params)
{
    $sql = "UPDATE personen " .
        "SET name = '" . $params['name'] . "', " .
        "vorname = '" . $params['vorname'] . "', " .
        "strasse = '" . $params['strasse'] . "', " .
        "oid = '" . $params['oid'] . "', " .
        "email = '" . $params['email'] . "', " .
        "tel_priv = '" . $params['tel_priv'] . "', " .
        "tel_gesch = '" . $params['tel_gesch'] . "', " .
        "lid = '" . $params['lid'] . "' " .
        "WHERE pid = " . $params['pid'];
    sqlQuery($sql);
}

function search_person_statement()
{
    $searchParams = $_SESSION['searchParams'];

    $sqlSelect = "SELECT * FROM personen " .
        "WHERE name LIKE '" . $searchParams['name'] . "%' " .
        "AND vorname LIKE '" . $searchParams['vorname'] . "%' " .
        "AND strasse LIKE '" . $searchParams['strasse'] . "%' " .
        "AND email LIKE '" . $searchParams['email'] . "%' " .
        "AND tel_priv LIKE '" . $searchParams['tel_priv'] . "%' " .
        "AND tel_gesch LIKE '" . $searchParams['tel_gesch'] . "%' ";
    if (!empty($searchParams['oid'])) {
        $sqlSelect .= "AND oid = '" . $searchParams['oid'] . "' ";
    }
    if (!empty($searchParams['lid'])) {
        $sqlSelect .= "AND lid = '" . $searchParams['lid'] . "' ";
    }
    return $sqlSelect;
}

function db_get_first_person()
{
    $sqlSelect = search_person_statement();
    $sqlSelect .= "ORDER BY pid LIMIT 1";

    return array_shift(sqlSelect($sqlSelect));
}

function db_get_last_person()
{
    $sqlSelect = search_person_statement();
    $sqlSelect .= "ORDER BY pid DESC LIMIT 1";

    return array_shift(sqlSelect($sqlSelect));
}

function db_get_previous_person($cpid)
{
    $sqlSelect = search_person_statement();
    $sqlSelect .= "AND pid < '" . $cpid . "' ";
    $sqlSelect .= "ORDER BY pid LIMIT 1";

    $foundPerson = sqlSelect($sqlSelect);
    if (sizeof($foundPerson) < 1) {
        return db_get_last_person();
    }
    return array_shift($foundPerson);
}

function db_get_next_person($cpid)
{
    $sqlSelect = search_person_statement();
    $sqlSelect .= "AND pid > '" . $cpid . "' ";
    $sqlSelect .= "ORDER BY pid LIMIT 1";

    $foundPerson = sqlSelect($sqlSelect);
    if (sizeof($foundPerson) < 1) {
        return db_get_first_person();
    }
    return array_shift($foundPerson);
}

function db_delete_person($pid)
{
    if (isCleanNumber($pid)) sqlQuery("DELETE FROM personen WHERE pid='$pid'");
}

?>