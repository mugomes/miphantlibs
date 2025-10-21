<?php
// Copyright (C) 2025 Murilo Gomes Julio
// SPDX-License-Identifier: MIT

// Site: https://github.com/mugomes

namespace MiPhantLibs\security;

class post
{
    public function get(string $name, int $filter = FILTER_DEFAULT): string|int|null
    {
        return filter_input(INPUT_POST, $name, $filter);
    }

    public function exists(string $name, array|int $options = 0): bool
    {
        return (empty(filter_input(INPUT_POST, $name, FILTER_DEFAULT, $options))) ? false : true;
    }

    public function request(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] == 'POST') ? true : false;
    }
}
