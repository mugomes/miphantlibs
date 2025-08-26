<?php
// Copyright (C) 2025 Murilo Gomes Julio
// SPDX-License-Identifier: MIT

// Support: https://www.mugomes.com.br/p/apoie.html

namespace MiPhantLibs\app;

use MiPhantLibs\langs\translate;
use MiPhantLibs\layout\html;
use MiPhantLibs\system\server;

class about
{
    private mixed $traduzir;

    public function __construct()
    {
        $this->traduzir = new translate();
    }

    public function setLicense(string $name, string $text): string
    {
        $html = new html();

        $styleButton = 'background-color: #79b7c8;
        color: #003470;
        cursor: pointer;
        padding: 18px;
        width: 97%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        font-weight: bold;
        margin-top: 7px;';

        $styleContent = 'padding: 7px 18px;
        display: none;
        overflow: hidden;
        background-color: #f1f1f1;';

        $txt = $html->button(
            [
                'class' => 'collapsible',
                'type' => 'button',
                'style' => $styleButton
            ],
            $name . ' (' . $this->traduzir->get('see license') . ')'
        );

        $txt .= $html->div(
            [
                'class' => 'content',
                'style' => $styleContent
            ],
            nl2br(str_replace(['<', '>', ' '], ['&lt;', '&gt;', '&nbsp;'], $text))
        );

        return $txt;
    }

    public function show($text = '')
    {
        $config = new config();
        $html = new html();
        $txt = $html->h1($this->traduzir->get('About %s', $config->get('app', 'name')));
        $txt .= $html->p($config->get('app', 'name') . ' ' . $config->get('app', 'version'));
        $txt .= $html->p($this->traduzir->get('Developed by: %s', $config->get('app', 'author', 'name')));
        if (!empty($config->get('app', 'author', 'organization'))) {
            $txt .= $html->p($this->traduzir->get('Organization: %s', $config->get('app', 'author', 'organization')));
        }
        $txt .= $html->p(
            'Site: ',
            $html->a(
                ['href' => sprintf("javascript:miphant.openURL('%s');", $config->get('app', 'homepage'))],
                $config->get('app', 'homepage')
            )
        );
        $txt .= $html->p($config->get('app', 'copyright'));
        $txt .= $html->p($this->traduzir->get('License: %s', $config->get('app', 'license')));
        $txt .= $html->hr(
            ['class' => 'border border-primary border-3 opacity-75']
        );
        $txt .= $html->h3($this->traduzir->get('Recursos de Terceiros Utilizados'));

        $file = new file();
        $path = new path();
        $server = new server();
        $miphantLicense = str_replace('/app', '', $server->documentroot());
        $electronLicense = str_replace('/resources/app', '', $server->documentroot());
        $phpLicense = str_replace('/app', '/php', $server->documentroot());

        $txt .= $this->setLicense('MiPhant', $file->open($path->join($miphantLicense) . '/LICENSE'));
        $txt .= $this->setLicense('MiPhantLibs', $file->open(dirname(__FILE__, 3) . '/LICENSE'));
        $txt .= $this->setLicense('Electron', $file->open($path->join($electronLicense) . '/LICENSE'));

        if (file_exists($path->join($phpLicense) . '/LICENSE')) {
            $txt .= $this->setLicense('PHP', $file->open($path->join($phpLicense) . '/LICENSE'));
        }

        $txt .= $text;

        $txt .= "<script>
        var col1 = document.getElementsByClassName('collapsible');
        var i;

        for (i = 0; i < col1.length; i++) {
            col1[i].addEventListener('click', function () {
                this.classList.toggle('active');
                var content = this.nextElementSibling;
                if (content.style.display === 'block') {
                    content.style.display = 'none';
                } else {
                    content.style.display = 'block';
                }
            });
        }
        </script>";

        echo $txt;
    }
}
