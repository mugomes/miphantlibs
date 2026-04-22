<?php
// Copyright (C) 2025-2026 Murilo Gomes Julio
// SPDX-License-Identifier: LGPL-2.1-only

// Site: https://youtube.com/@mugomesoficial

namespace MiPhantLibs\system;

class platform {
    public function osLinux():bool{
        $env = new env();
        return ($env->platform() == 'linux') ? true : false;
    }
}