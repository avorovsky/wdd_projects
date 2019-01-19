<?php

/*
 * Excerpt for long text
 */

namespace Components;

class Excerpt
{

    /**
     * Excerpt itself
     * @var string
     */
    private $excerpt;

    /**
     * creates excerpt for text with defined number of words
     * @param string $text
     * @param integer $words
     */
    public function __construct($text, $words=20)
    {

        if (str_word_count($text, 0) > $words) {
            // array of words, keys are words positions
            $wordsArray = str_word_count($text, 2);
            // array of words positions
            $wordsPositions = array_keys($wordsArray);
            // cut first number of words
            $this->excerpt = substr($text, 0, $wordsPositions[$words]) . '...';
        }

    }

    /**
     * excerpt getter
     * @return string
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

}