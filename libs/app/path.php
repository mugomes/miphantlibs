<?php
// Copyright (C) 2025 Murilo Gomes Julio
// SPDX-License-Identifier: MIT

// Site: https://github.com/mugomes

namespace MiPhantLibs\app;

use MiPhantLibs\system\platform;

class path {
    public function join(string ...$values):string {
        $platform = new platform();
        $arquivo = new file();
        
        $txt = '';
        $first = true;

        foreach ($values as $file) {
            if ($platform->osLinux()) {
                $sFile = str_replace('\\', '/', $file);
                $txt .= ($first) ? rtrim($sFile, '/') : rtrim(ltrim($sFile, '/'), '/');

                if (!$arquivo->checkExtension($txt) && substr($txt, -1) !== '/') {
                    $txt .= '/';
                }
            } else {
                $sFile = str_replace('/', '\\', $file);
                $txt .= ($first) ? rtrim($sFile, '/') : rtrim(ltrim($sFile, '\\'), '\\');

                if (!$arquivo->checkExtension($txt) && substr($txt, -1) !== '\\') {
                    $txt .= '/';
                }
            }

            $first = false;
        }

        return $txt;
    }
}