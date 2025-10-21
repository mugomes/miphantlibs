<?php
// Copyright (C) 2025 Murilo Gomes Julio
// SPDX-License-Identifier: MIT

// Site: https://github.com/mugomes

namespace MiPhantLibs\security;

class password
{
    private int $sQuantidade = 7;
    private bool $sMinusculo = true;
    private bool $sMaiusculo = true;
    private bool $sNumeros = true;
    private bool $sCaracteresEspeciais = true;
    private string|int $sHash = PASSWORD_DEFAULT;

    public const MD5 = 'md5';
    public const SHA1 = 'sha1';
    public const SHA256 = 'sha256';
    public const SHA512 = 'sha512';

    public function amount(int $valor)
    {
        $this->sQuantidade = $valor;
    }

    public function strtolower()
    {
        $this->sMinusculo = true;
    }

    public function strtoupper()
    {
        $this->sMaiusculo = true;
    }

    public function numbers()
    {
        $this->sNumeros = true;
    }

    public function specialCharacters()
    {
        $this->sCaracteresEspeciais = true;
    }

    public function hash(string|int $value = PASSWORD_DEFAULT)
    {
        $this->sHash = $value;
    }

    public function generate(): array
    {
        $txt = '';

        $caracteres = ($this->sMinusculo) ? 'abcdefghijklmnopqrstuvwxyz' : '';
        $caracteres .= ($this->sMaiusculo) ? 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' : '';
        $caracteres .= ($this->sNumeros) ? '1234567890' : '';
        $caracteres .= ($this->sCaracteresEspeciais) ? '!@#$%*-' : '';

        $sTamanho = strlen($caracteres);

        for ($n = 1; $n <= $this->sQuantidade; $n++) {
            $valor = mt_rand(1, $sTamanho);
            $txt .= $caracteres[$valor - 1];
        }

        $a['password'] = $txt;

        if ($this->sHash == 'md5') {
            $a['hash'] = md5($txt);
        } else if ($this->sHash == 'sha1') {
            $a['hash'] = sha1($txt);
        } else if ($this->sHash == 'sha256') {
            $a['hash'] = hash('sha256', $txt);
        } else if ($this->sHash == 'sha512') {
            $a['hash'] = hash('sha512', $txt);
        } else if ($this->sHash == PASSWORD_DEFAULT) {
            $a['hash'] == password_hash($txt, PASSWORD_DEFAULT);
        } else {
            $a['hash'] = password_hash($txt, $this->sHash);
        }

        return $a;
    }
}
