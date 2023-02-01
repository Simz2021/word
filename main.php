<?php

/**
 * write a function called 'wrap' that takes two arguments, $string and $length. 
 * 
 * The function should return the string, but with new lines ("\n") added to ensure that no line is longer than $length characters. 
 * Always wrap at word boundaries if possible, only break a word if it is longer than $length characters. 
 * When breaking at word boundaries, replace all the whitespace between the two words with a single newline character. 
 * Any unbroken whitespace should be left unchanged.
 * 
 * Please implement the function directly, rather than using any built-in function (for example the wordwrap() function in PHP). 
 * Please use PHP or any other programming language you are familiar with, e.g. JAVA, C#, JavaScript etc..
 */

function wrap($string, $length)
{
    $n = strlen($string);

    # if string is blank
    if (!$string) return $string;

    # if string is smaller to wrap
    if ($length >= $n) return $string;

    # Wrapping
    $output = '';
    while ($string) {
        # if remaining string is less than or equals to length
        if ($length >= strlen($string)) {
            $output .= $string . '\n';
            // echo '1: ' . $string . '\n' . PHP_EOL;
            $string = null;
            break;
        }

        # if remaining string is greater than length
        $substring = substr($string, 0, $length);
        if ($string[$length] == ' ') {
            $output .= $substring . '\n';
            // echo '2: ' . $substring . '\n' . PHP_EOL;
            $string = substr($string, $length + 1);
            continue;
        }

        # find whitespace
        $wsindex = getLastWhitespace($substring);

        # if it is a single word
        if (!$wsindex) {
            $output .= $substring . '\n';
            // echo '3: ' . $substring . '\n' . PHP_EOL;
            $string = substr($string, $length);
            continue;
        }

        # if whitespace found
        $substring = substr($string, 0, $wsindex);
        $output .= $substring . '\n';
        // echo '4: ' . $substring . '\n' . PHP_EOL;
        $string = substr($string, $wsindex + 1);
    }
    return $output;
}

function getLastWhitespace($string)
{
    for ($i = strlen($string) - 1; $i >= 0; $i--) {
        if ($string[$i] == ' ') return $i;
    }
    return false;
}

$example1 = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.";
echo wrap($example1, 5);
echo PHP_EOL;
