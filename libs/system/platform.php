<?php
// Copyright (C) 2025 Murilo Gomes Julio
// SPDX-License-Identifier: MIT

// Support: https://www.mugomes.com.br/p/apoie.html

namespace MiPhantLibs\system;

class platform {
    public function osLinux():bool{
        $env = new env();
        return ($env->platform() == 'linux') ? true : false;
    }
}