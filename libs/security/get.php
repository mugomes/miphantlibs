<?php
// Copyright (C) 2025 Murilo Gomes Julio
// SPDX-License-Identifier: MIT

// Support: https://www.mugomes.com.br/p/apoie.html

namespace MiPhantLibs\security;

class get
{
    public function get(string $name, int $filter = FILTER_DEFAULT): string|int|null
    {
        return filter_input(INPUT_GET, $name, $filter);
    }

    public function exists(string $name, array|int $options = 0): bool
    {
        return (empty(filter_input(INPUT_GET, $name, FILTER_DEFAULT, $options))) ? false : true;
    }

    public function request(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] == 'GET') ? true : false;
    }
}
