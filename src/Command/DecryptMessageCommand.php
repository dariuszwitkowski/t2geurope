<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\CryptographyService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:decrypt-message',
    description: 'decrypts message for given key',
)]
class DecryptMessageCommand extends Command
{
    private const ENCRYPT_OPTION = 'encrypt';

    private const ENCRYPTED_MESSAGE = 'Zaszyfrowana wiadomość to: %s';

    private const DECRYPTED_MESSAGE = 'Odszyfrowana wiadomość to: %s';

    private const INVALID_CHARS_IN_KEY_MESSAGE = 'Klucz zawiera jeden z niedozwolonych znaków: %s';

    private const KEY_IS_TOO_SHORT_MESSAGE = 'Klucz jest za krótki';

    private const KEY_IS_TOO_LONG_MESSAGE = 'Klucz jest za dlugi';

    private const KEY_HAS_DUPLICATED_CHARS = 'Klucz zawiera zduplikowane znaki';

    private const ASK_FOR_MESSAGE_QUESTION = 'Podaj wiadomość';

    private const ASK_FOR_KEY_QUESTION = 'Podaj klucz';

    public function __construct(private CryptographyService $cryptographyService, string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addOption(
                self::ENCRYPT_OPTION,
                null, InputOption::VALUE_NONE,
                'Pass this flag if you want to encrypt message instead of decrypting')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Używam ask() zamiast argumentów żeby uniknąć problemów związanych z escape'owaniem special char'ów na różnych systemach
        $message = $io->ask(self::ASK_FOR_MESSAGE_QUESTION, null, function (string $answer) use ($input) {
            return $answer;
        });
        $key = $io->ask(self::ASK_FOR_KEY_QUESTION, null, function (string $answer) {
            return str_replace(' ', '', $answer);
        });

        $err = $this->validateKey($key);
        if ($err) {
            $io->error($err);
            return Command::FAILURE;
        }

        $shouldEncrypt = $input->getOption(self::ENCRYPT_OPTION);
        $result = $shouldEncrypt ? $this->cryptographyService->encrypt($message, $key) : $this->cryptographyService->decrypt($message, $key);

        $io->success(sprintf($shouldEncrypt ? self::ENCRYPTED_MESSAGE : self::DECRYPTED_MESSAGE, $result));

        return Command::SUCCESS;
    }

    private function validateKey($key): ?string
    {
        if ($this->cryptographyService->validateKeyInvalidChars($key)) {
            return sprintf(self::INVALID_CHARS_IN_KEY_MESSAGE, CryptographyService::INVALID_KEY_CHARS);
        }

        $compareResult = $this->cryptographyService->compareLengthToAlphabetRange($key);
        if ($compareResult !== 0) {
            return $compareResult === -1 ? self::KEY_IS_TOO_SHORT_MESSAGE : self::KEY_IS_TOO_LONG_MESSAGE;
        }

        if ($this->cryptographyService->checkIfKeyHasDuplicatedChars($key)) {
            return self::KEY_HAS_DUPLICATED_CHARS;
        }

        return null;
    }
}

