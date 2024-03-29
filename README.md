# Zadanie rekrutacyjne

## Wymagania

```bash
PHP 8.0
NPM
composer
```

## Instalacja

```bash
git clone git@github.com:dariuszwitkowski/t2geurope.git
cd t2geurope
composer install
npm i
npm run dev
symfony serve
```

## Polecenia

1. Zadanie wymagane - Łamacz kodu
```bash
php bin/console app:decrypt-message
```
kod znajduje się w 
```bash
./src/Command/DecryptMessageCommand.php
./src/Service/CryptographyService.php
```
w tym przypadku mamy flagę
```bash
--encrypt //jeśli wiadomość ma zostać zakodowana zamiast zdekodowana (zadanie dodatkowe)
```

następnie podajemy wiadomość oraz klucz

2. Zadanie opcjonalne - Wyświetlacz LCD

```bash
php bin/console app:display-number-like-lcd {number}
```

kod znajduje się w
```bash
./src/Command/DisplayNumberLikeLcdCommand.php
```

## Dodatkowe informacje

Zapytania do zadań z SQL znajdują się w:
```bash
./sql/wonTickets.sql // Zadanie "Wygrane losy"
./sql/statistics(dummy).sql // Zadanie "Statystyka zarobków" - rozwiązanie raczej średnie z użyciem subquery
./sql/statistics(clean).sql // Zadanie "Statystyka zarobków" - rozwqiązanie czystsze :D
```

Zadanie Frontendowe będzie można zobaczyć na glownym roucie aplikacji. 

kod HTML znajduje się w:
```bash
./templates/counter/counter.html.twig
```
JS w:
```bash
./public/js/counter.js
```


