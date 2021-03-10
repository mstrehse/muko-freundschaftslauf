# Digitaler Muko Freundschaftslauf Website

Website für die Durchführung des digitalen Muko Freundschaftslaufes ursprünglich entwickelt für den Mukoviszidose Landesverband Berlin Brandenburg e.V.

**Was funktioniert:**

- Registrierung von Teams
- Teammitgrlieder hinzufügen
- Sponsoren hinzufügen
- Zwischenergebnisse für Team eintragen
- Beiträge Text und Bild hochladen
- Beiträge melden
- Export der Ergebnisse als Excel Datei

## Export der Daten

Mit den aufgelisteten URLs können Daten aus dem System in Excel exportiert werden. Der Platzhalter `{key}` steht für den API Key den Sie in der `.env` Datei festgelegt haben.  
  
Teams: `/team/export/{key}`  
Team Members: `/member/export/{key}`  
Sponsoren: `/sponsor/export/{key}`  
Laufergebnisse: `/result/export/{key}`  

## Systemvoraussetzungen

- PHP >= 7.2.5
- PHP Erweiterungen
    - BCMath
    - Ctype
    - Fileinfo
    - JSON
    - Mbstring
    - OpenSSL
    - PDO
    - Tokenizer
    - XML
- MySQL / MariaDB Server
- Imageproxy Server (https://github.com/willnorris/imageproxy)

## Installation

1. Herunterladen und in den Zielordner auf dem Webserver entspacken
2. Per SSH auf den Server verbinden und die Abhängigkeiten herunter laden `composer install` und `npm install`
3. `.env.example` kopieren und als `.env` einfügen. Die Werte für die Datenbank, Email, Imageproxy und den API Key anpassen. Der API Key erlaubt den Zugriff auf die Exportschnittstellen und sollte auf jeden Fall geändert werden!
4. Datenbank einspielen z.B. mit PHPMyAdmin und der `database.sql` Datei im Projekt oder `php artisan migrate`
5. Symlink für den Storage Ordner setzen `php artisan storage:link` oder manuell (https://laravel.com/docs/8.x/filesystem#the-public-disk)
6. Der Document Root des Webserver muss auf den Ordner `public` zeigen (https://laravel.com/docs/8.x/deployment)

## Alternativ: Installation lokal mit ddev (MacOSX)

1. Homebrew installieren: `/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"`
2. Docker installieren: [Docker CE Downloads](https://hub.docker.com/search?q=&type=edition&offering=community)
3. DDEV installieren: `brew tap drud/ddev && brew install ddev`
4. Projekt auschecken: `git clone https://github.com/mstrehse/muko-freundschaftslauf.git`
5. In das Projektverzeichnis wechseln `cd muko-freundschaftslauf`
6. DDEV starten: `ddev start`
7. `.env.local` nach `.env` kopieren und Werte anpassen wenn gewollt
8. Abhängigkeiten installieren `ddev exec composer install` und `ddev exec npm install`
9. Datenbank einspielen `ddev exec php artisan migrate`
10. Storage verlinken `ddev exec php artisan storage:link`
11. Seite im Browser öffnen: [https://muko-freundschaftslauf.ddev.site](https://muko-freundschaftslauf.ddev.site)

## Registrierungen freischalten und Countdown neu starten

Damit Bewerbungen wieder erlaubt sind, muss der Wert `FSL_ALLOW_REGISTRATIONS` in der `.env` auf das Zieldatum gestellt werden. Die Zeitzone des Servers sollte die gleiche sein wie die der Nutzer, sonst gibt es eine Differenz zwischen dem Countdown und dem Zeitpunkt an welchem die Plattform geschlossen wird.

## Plattform zurücksetzen

Um alle Daten zu löschen und die Plattform komplett zurück zu setzen, lösche die Datenbank und spiele diese erneut mit der `database.sql` Datei oder `php artisan migrate` ein. Lösche im Anschluss die Nutzerdateien unter `storage/public`.

## Texte und Templates anpassen

Die Texte und Templates findest du im Ordner `resources/views`. Übersetzungen für Buttons und Fehlermeldungen liegen zum Teil auch in den Übersetzungsdateien in `resources/lang`.
## Wenn was nicht geht

Gleich zu Beginn ist es wichtig zu wissen, dass ich keinerlei Arbeitsverhältnis mit dem Mukoviszidose Landesverbank habe. Alles passiert hier absolut freiwillig, bitte behalte das bei deinen Anfragen im Hinterkopf. Ich werde hier auch keine Angebote für die Weiterentwicklung annehmen.

Sonst gilt natürlich, wenn dir ein Feature fehlt oder du einen Bug gefunden hast, kannst du gerne hier im Github ein Issue aufmachen. Je nachdem ob mir das Feature gefällt werde ich es in das Projekt einbauen. Alternativ kannst du natürlich jederzeit einen Pull Request aufmachen und Bugs selber schließen und Features einbauen. 

Wenn du das Projekt nutzt wäre es deshalb nett wenn du mir zumindest einen Kaffee spendieren würdest https://www.buymeacoffee.com/maxman
