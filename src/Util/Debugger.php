<?php

declare(strict_types=1);

namespace App\Util;

class Debugger
{
    /**
     * Dump the variables values, then return the first one.
     *
     * @example Debugger->dump($var1, $var2, ...);
     *
     * @param mixed ...$vars
     *
     * @return mixed
     */
    public function dump($var, ...$vars)
    {
        echo '<pre>';
        var_dump($var);

        foreach ($vars as $v) {
            var_dump($v);
        }
        echo '</pre>';

        return $var;
    }

    /**
     * dump then die;.
     *
     * @example Debugger->dd($var1, $var2, ...);
     *
     * @param mixed ...$vars
     */
    public function dd(...$vars)
    {
        $this->dump(...$vars);

        die(1);
    }
}
