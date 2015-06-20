<?php

namespace PronouncePHP;

use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Command extends SymfonyCommand
{
    /**
     * Get input and break into array
     *
     * @param string $string
     * @return array
    */
    public function inputToArray($string)
    {
        $string = strtoupper($string);

        return explode(',', $string);
    }

    /**
     * Build output string for all fields
     *
     * @param string $word, array $exploded_line, array $exclude
     * @return string
    */
    public function buildOutput($word, $exploded_line, array $exclude = null)
    {
        array_shift($exploded_line);

        $arpabet_array = array_filter($exploded_line);

        $arpabet_string = trim(implode(' ', $exploded_line));

        $ipa_string = $this->ipa->buildIpaString($arpabet_array);

        $spelling_string = $this->spelling->buildSpellingString($arpabet_array);

        return ('Word: ' . $word . "\n" . 'Arpabet: ' . $arpabet_string . ' IPA: ' . $ipa_string . ' Spelling: ' . $spelling_string);
    }
}