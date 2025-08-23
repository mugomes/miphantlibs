<?php
// Copyright (C) 2025 Murilo Gomes Julio
// SPDX-License-Identifier: MIT

// Support: https://www.mugomes.com.br/p/apoie.html

namespace MiPhantLibs\app;

class numbers {
    public function currencyReal(string $valor):string {
        return number_format($valor, 2, ',', '.');
    }

    public function format(string $value): string {
        return (empty($value) ? 0 : str_pad($value, 2, '0', STR_PAD_LEFT));
    }
}