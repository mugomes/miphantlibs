<?php
// Copyright (C) 2025 Murilo Gomes Julio
// SPDX-License-Identifier: MIT

// Site: https://github.com/mugomes

namespace MiPhantLibs\security;

class items {
    public function clean(?string $valor) : string|int|null {
        if (is_null($valor)) {
            $txt = '';
        } else {
            $txt = trim($valor);
            $txt = strip_tags($txt);
            $txt = addslashes($txt);
        }

        return $txt;
    }
}