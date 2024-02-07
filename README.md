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
src/Command/DecryptMessageCommand.php
```
w tym przypadku mamy 2 flagi
```bash
--encrypt //jeśli wiadomość ma zostać zdekodowana zamiast zakodowana (zadanie dodatkowe)
--sensitive //jeśli chcemy aby wielkie litery nie byly traktowane jak male
```

następnie podajemy wiadomość oraz klucz

2. Zadanie opcjonalne - Wyświetlacz LCD

```bash
php bin/console app:display-number-like-lcd {number}
```

kod znajduje się w
```bash
src/Command/DisplayNumberLikeLcdCommand.php
```

## Dodatkowe informacje

Zapytania do zadań z SQL znajdują się w
```bash
./sql/wonTickets.sql // Zadanie "Wygrane losy"
./sql/statistics(dummy).sql // Zadanie "Statystyka zarobków" - rozwiązanie raczej średnie z użyciem subquery
./sql/statistics(clean).sql // Zadanie "Statystyka zarobków" - rozwqiązanie czystsze :D
```

Zadanie Frontendowe będzie można zobaczyć na glownym roucie aplikacji. 