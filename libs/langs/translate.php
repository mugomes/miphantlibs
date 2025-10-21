<?php
// Copyright (C) 2025 Murilo Gomes Julio
// SPDX-License-Identifier: MIT

// Site: https://github.com/mugomes

namespace MiPhantLibs\langs;

use MiPhantLibs\system\env;
use MiPhantLibs\system\server;

class translate
{
    private array $miLang = [];

    public function __construct()
    {
        $server = new server();
        $env = new env();

        $miLangPath = sprintf('%s/langs/%s.json', $server->documentroot(), $env->lang());

        if (file_exists($miLangPath)) {
            $this->miLang = json_decode(file_get_contents($miLangPath), true);
        } else {
            if (file_exists(dirname(__FILE__, 4) . '/lang/en.json')) {
                $this->miLang = json_decode(file_get_contents($server->documentroot() . '/lang/en.json'), true);
            }
        }
    }

    public function get(string $text, string ...$values): string
    {
        return (empty($this->miLang[$text])) ? sprintf($text, ...$values) : sprintf($this->miLang[$text], ...$values);
    }
}
