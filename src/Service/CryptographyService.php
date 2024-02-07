<?php

declare(strict_types=1);

namespace App\Service;

class CryptographyService
{
    // Jako że nie kodujemy przecinka oraz kropki, w sytuacji kiedy bylyby one w kluczu otrzymalibyśmy blędny rezultat
    // Po zakodowaniu i zdekodowaniu wiadmości z zadania dodatkowego
    public const INVALID_KEY_CHARS = ',.';

    public function encrypt(string $message, string $key): string
    {
        $keyArr = str_split($key);
        return implode('', array_map(function (string $char) use ($keyArr) {
            if (ord($char) >= ord('a') && ord($char) <= ord('z')) {
                return $keyArr[ord($char) - ord('a')];
            } else {
                return $char;
            }
        }, str_split($message)));
    }

    public function decrypt(string $message, string $key): string
    {
        return implode('', array_map(function (string $char) use ($key) {
            if (str_contains($key, $char)) {
                return chr(strpos($key, $char) + ord('a'));
            } else {
                return $char;
            }
        }, str_split($message)));
    }

    public function validateKeyInvalidChars($key): bool
    {
        return !!strpbrk($key, self::INVALID_KEY_CHARS);
    }

    public function compareLengthToAlphabetRange($key): int
    {
        return strlen($key) <=> (ord('z') - ord('a') + 1);
    }

    public function checkIfKeyHasDuplicatedChars($key): bool
    {
        foreach (count_chars($key, 1) as $count) {
            if ($count > 1) {
                return true;
            }
        }

        return false;
    }
}