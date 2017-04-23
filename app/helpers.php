<?php

use Parsedown as Parser;
use Illuminate\Support\HtmlString;

if (! function_exists('markdown')) {
    /**
     * Parse a Markdown formatted string into HTML.
     *
     * @param  null|string  $input
     * @return \Parsedown|\Illuminate\Support\HtmlString
     */
    function markdown($input = null)
    {
        $parsedown = app(Parser::class);
        if (func_num_args() == 0) {
            return $parsedown;
        }

        return new HtmlString($parsedown->text($input));
    }
}
