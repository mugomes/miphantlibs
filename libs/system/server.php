<?php
// Copyright (C) 2025-2026 Murilo Gomes Julio
// SPDX-License-Identifier: LGPL-2.1-only

// Site: https://youtube.com/@mugomesoficial

namespace MiPhantLibs\system;

use MiPhantLibs\security\items;

class server {
    private mixed $itens;

    public function __construct()
    {
        $this->itens = new items();
    }

    public function domain():string {
        return sprintf('http://%s:%s', $this->itens->clean($_SERVER['SERVER_NAME']), $this->itens->clean($_SERVER['SERVER_PORT']));
    }

    public function uri():string {
        $sRequestURI = $this->itens->clean($_SERVER['REQUEST_URI']);
        $txt = explode('?', $sRequestURI);
        return (empty($txt[0])) ? '' : ltrim($txt[0], '/');
    }

    public function documentroot(): string {
        return preg_replace('~^(.+?/resources/app/).*~', '$1', dirname(__FILE__));
    }
}