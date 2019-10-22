<?php
/**
 *  @autor Florian Leimer
 *  @version 2019
 *
 *  Dieses Modul definert dall Konfigurationsparameter und stellt die DB-Verbindung her.
 */

// Default-CSS-Klasse zur Formatierung der Eingabefelder
setValue('cfg_css_class_normal',"");
// Klasse zur Formatierung der Eingabefelder, falls die Eingabeprüfung negativ ausfällt
setValue('cfg_css_class_error',"is-invalid");
// Akzeptierte Funktionen
setValue('cfg_func_list', ["person", "ort", "land"]);
// Inhalt des Menus
setValue( 'cfg_menu_list', ["person"=>"Personenverwaltung","ort"=>"Ortverwaltung","land"=>"Landverwaltung"] );
// Template für Menu
setValue('cfg_menu', 'templates/menuBar.htm.php');

// Datenbankverbundung herstellen
$db = mysqli_connect("127.0.0.1", "root", "", "adressen_fl");	// Zu Datenbankserver verbinden
setValue('cfg_db', $db);
?>