<h1>Checkout System</h1>
<h2>Wymagania systemowe</h2>
<ul>
<li>PHP 7+</li>
<li>MySQL</li>
<li>Serwer WWW (np. Apache, Nginx)</li>
<li>Przeglądarka internetowa</li>
</ul>
<h2>Instalacja</h2>
<ul>
<li>Pobierz pliki projektu z repozytorium</li>
<li>Skonfiguruj połączenie z bazą danych w pliku db.php, który znajduje się w folderze includes</li>
<li>Wgraj pliki na serwer WWW</li>
<li>Otwórz projekt w przeglądarce internetowej</li>
<li>By sprawdzić działanie testu PHPUnit dla numeru telefonu trzeba skorzystać z Composer i wpisać komendę</li>
```
composer update
vendor/bin/phpunit phoneNumberValidationTest.php
```
</ul>
<h2>Baza danych</h2>
<p>Projekt korzysta z bazy danych MySQL. Schemat bazy danych znajduje się w pliku database.sql. Aby utworzyć schemat bazy danych, należy zaimportować ten plik do bazy danych.</p>

<h2>Uruchomienie</h2>
<p>Aby uruchomić projekt, należy wpisać adres URL do pliku index.php w przeglądarce internetowej.</p>