<?php
// Copyright (C) 2025-2026 Murilo Gomes Julio
// SPDX-License-Identifier: LGPL-2.1-only

// Site: https://youtube.com/@mugomesoficial

namespace MiPhantLibs\app;

use MiPhantLibs\system\env;
use MiPhantLibs\system\server;

class config {
    private array $aConfig = [];

    public function __construct()
    {
        $server = new server();
        $env = new env();
        $this->aConfig = json_decode(file_get_contents($server->documentroot() . '/config/config.json'), true);
    }

    public function get(string ...$nomes):string|int|bool {
        $sValor = $this->aConfig;

        foreach ($nomes as $value) {
            $sValor = (empty($sValor[$value])) ? '' : $sValor[$value];
        }

        return $sValor;
    }
}