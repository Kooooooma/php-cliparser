<?php

/*
 * This file is part of the php-cliparser package.
 *
 * (c) Koma <komazhang@foxmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CliParser;

class CliParser
{
    private $idx    = 0;
    private $args   = array();
    private $script = '';

    public function __construct()
    {
    }

    public function parse()
    {
        if (!isset($_SERVER['argv'])) return;

        $this->script = $_SERVER['argv'][0];
        unset($_SERVER['argv'][0]);

        if (!array_walk($_SERVER['argv'], array($this, 'doParse'))) return;

        $args = array();
        foreach ($this->args as $val) {
            if (is_string($val)) {
                $args[$val] = true;
            } else if (is_array($val)) {
                foreach ($val as $k => $v) {
                    if (is_string($k) && is_string($v)) $args[$k] = $v;
                }
            }
        }
        $this->args = $args;
        unset($args);
    }

    public function getArgs($key)
    {
        if ( $this->hasArgs($key) ) {
            return $this->args[$key];
        }

        return false;
    }

    public function hasArgs($key)
    {
        return array_key_exists($key, $this->args);
    }

    public function getAllArgs()
    {
        return $this->args;
    }

    public function getScript()
    {
        return $this->script;
    }

    private function doParse($item)
    {
        $key = '';
        $val = '';

        if ( $item[0] == '-' && $item[1] == '-' && $item[2] != '-' ) { //--item
            $key = substr($item, 2);
        } else if ( $item[0] == '-' && $item[1] != '-' ) { //-item
            $key = substr($item, 1, 1);
        } else if( $item[0] != '-' ) {
            $val = $item;
        }

        if ( $key != '' ) {
            $this->args[++$this->idx] = $key;
        } else if ( $val != '' && $this->idx > 0 ) {
            $_key = $this->args[$this->idx];
            if ( is_string($_key) ) {
                $this->args[$this->idx] = array($_key => $val);
            }
        }
    }
}