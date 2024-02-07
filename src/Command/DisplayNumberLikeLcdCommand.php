<?php

namespace App\Command;

use JetBrains\PhpStorm\Pure;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:display-number-like-lcd',
    description: 'Display given number like lcd screen',
)]
class DisplayNumberLikeLcdCommand extends Command
{
    private const NUMBER_OF_LINES = 3;

    private const HORIZONTAL_LINE_INDEX = 1;

    private const HORIZONTAL_LINE_CHAR = '_';

    private const VERTICAL_LINE_CHAR = '|';

    private const BLANK_CHAR_CHAR = ' ';

    private const NUMBER_ARG = 'number';

    // Cyfry odpowiadają indexom
    private const CIPHERS = [
        //0
        [
            [0,1,0],
            [1,0,1],
            [1,1,1],
        ],
        //1
        [
            [0,0,0],
            [0,0,1],
            [0,0,1],
        ],
        //2
        [
            [0,1,0],
            [0,1,1],
            [1,1,0],
        ],
        //3
        [
            [0,1,0],
            [0,1,1],
            [0,1,1],
        ],
        //4
        [
            [0,0,0],
            [1,1,1],
            [0,0,1],
        ],
        //5
        [
            [0,1,0],
            [1,1,0],
            [0,1,1],
        ],
        //6
        [
            [0,1,0],
            [1,1,0],
            [1,1,1],
        ],
        //7
        [
            [0,1,0],
            [0,0,1],
            [0,0,1],
        ],
        //8
        [
            [0,1,0],
            [1,1,1],
            [1,1,1],
        ],
        //9
        [
            [0,1,0],
            [1,1,1],
            [0,1,1],
        ]
    ];

    protected function configure(): void
    {
        $this->addArgument(self::NUMBER_ARG, InputArgument::REQUIRED, 'Number to display');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $number = str_split($input->getArgument(self::NUMBER_ARG));

        for ($i = 0; $i < self::NUMBER_OF_LINES; $i++) {
            $io->text($this->getLine($number, $i));
        }

        return Command::SUCCESS;
    }

    #[Pure]
    private function getLine(array $number, int $lineIndex): string
    {
        $line = "";
        foreach ($number as $cipher) {
            $lcdCipher = self::CIPHERS[(int)$cipher];
            foreach ($lcdCipher[$lineIndex] as $index => $lcdChar) {
                $line .= $this->determineChar((bool)$lcdChar, $index);
            }
        }

        return $line;
    }

    private function determineChar(bool $lcdChar, int $index): string
    {
        if ($lcdChar === false) {

            return self::BLANK_CHAR_CHAR;
        }

        if ($index === self::HORIZONTAL_LINE_INDEX) {

            return self::HORIZONTAL_LINE_CHAR;
        }

        return self::VERTICAL_LINE_CHAR;
    }
}
