Vorlage für den eigenen Projektplan
1. Projektziel
Was soll die Anwendung leisten?
Die Anwendung soll eine digitale Einkaufsliste ermöglichen, mit der Benutzer Produkte verwalten können.
Man kann Produkte hinzufügen, bearbeiten, löschen und als erledigt markieren.

Wer verwendet die Anwendung?
Die Anwendung wird von einzelnen Nutzern verwendet, die ihre Einkäufe einfach organisieren möchten (z. B. privat oder im Unterrichtsprojekt).

2. Pflichtfunktionen

 Produkte hinzufügen (Create)
 Produkte anzeigen (Read)
 Produkte bearbeiten (Update)
 Produkte löschen (Delete)
 Produkte als erledigt markieren
 Datenbankanbindung mit PDO
 Validierung von Eingaben
 Anzeige aller Items in einer Liste


3. Optionale Erweiterungen

 Kategorien anzeigen (Food, Convenience, Non-Food)
 Sortierung nach Kategorien
 Erledigte Items ausblenden
 Benutzer-Login
 Suchfunktion
 Prioritätsstufen für Items
 Mobile Optimierung


4. Benötigte Seiten oder Dateien


   Datei       	                              Aufgabe
list.php	                            Anzeige der Einkaufsliste
create.php	                            Neues Item erstellen
update.php	                            Item bearbeiten
delete.php	                            Item löschen
check.php	                            Status umschalten
clear.php	                            Liste komplett löschen
index.php	                            Weiterleitung zur Liste
inc/database.inc.php	                Databaseverbindung
inc/database_functions.inc.php	        SQL Funktionen
inc/functions.inc.php	                Hilfsfunktionen


5. Datenbankplanung
Spalte   	     Datentyp	    Bedeutung	            Besonderheit
  id	        INT	       	    eindeutige ID	        AUTOMATIC
  title	        VARCHAR(40)	    Produktname	            Pflicht
  quantity	    DECIMAL(8,2)	Menge	                > 0
  unit	        ENUM	        Einheit	                l, g, kg, St., Pk.
  information	VARCHAR(120)	Zusatzinfo	            optional
  category	    ENUM	        Kategorie	            food, convenience, non-food 
  status	    TINYINT	        erledigt	            0 oder 1
  created_at	TIMESTAMP	    erstellt	            automatisch         
  updated_at	TIMESTAMP	    geändert	            auto update 



6. Arbeitsschritte
 Projektordner und Git-Repository anlegen
 Datenbank planen
 Tabelle erstellen
 PDO-Verbindung testen
 CRUD-Funktionen implementieren
 list.php erstellen
 create.php erstellen
 update.php erstellen
 delete/check/clear Funktionen implementieren
 Anwendung testen
 Fehler beheben
 Dokumentation erstellen


7. Zeitplan

  Zeitraum	              Aufgaben	                   Ergebnis
Vorbereitung	Planung + Datenbankdesign	        Projektstruktur
Projekttag 1	Datenbank + PDO + Grundstruktur	    funktionierende DB
Projekttag 2	CRUD Funktionen + list.php	        Basis Anwendung
Projekttag 3	Update/Delete/Check + Design	    vollständige App
Abschluss	    Testen + Dokumentation	            fertiges Projekt



8. Risiken und offene Fragen

Frage oder Risiko     Entscheidung oder Lösung

Ungültige Eingaben	   Validierung in PHP
UI unübersichtlich     CSS Verbesserung



9. Testfälle

Funktion	             Testeingabe	            Erwartetes Ergebnis

Item hinzufügen	         "Milch", 2 l	            Item erscheint in Liste
Item löschen	         Delete klicken	            Item wird entfernt
Status ändern	         Checkbox klicken	        Status wechselt
Validierung	             leeres Title	            Fehlermeldung
Filter	                 hide=1	                    nur offene Items    



Funktion Testeingabe oder Ausgangslage Erwartetes Ergebnis
Checkliste vor dem Programmieren
[X] Ich kann das Ziel der Anwendung in eigenen Worten erklären.
[X] Ich habe Pflichtfunktionen und Erweiterungen getrennt.
[X] Ich habe die benötigten Seiten oder Dateien notiert.
[X] Ich habe die Datenbanktabelle geplant.
[X] Ich habe die Arbeit in kleine Schritte zerlegt.
[X] Ich habe die Arbeitsschritte zeitlich eingeplant.
[X] Ich habe Zeit für Tests und Fehlerbehebung reserviert.
[X] Ich habe offene Fragen geklärt oder notiert.
[X] Ich weiß, mit welchem kleinen Schritt ich beginne.
[] Das Git-Repository ist eingerichtet