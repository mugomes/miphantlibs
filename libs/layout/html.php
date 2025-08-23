<?php
// Copyright (C) 2025 Murilo Gomes Julio
// SPDX-License-Identifier: MIT

// Support: https://www.mugomes.com.br/p/apoie.html

namespace MiPhantLibs\layout;

class html
{
    private array $naofecha = ['meta', 'input', 'br', 'link', 'hr'];
    private array $atributosemvalor = ['required'];

    public function __call(string $element, mixed $arguments): string
    {
        /* Armazena o Conteúdo */
        $sArgumento = '';
        $sAtributos = '';

        foreach ($arguments as $conteudo) {
            /* Verifica se é um atributo */
            if (is_array($conteudo)) {
                foreach ($conteudo as $atributo => $valor) {
                    /* Verifica se o atributo não tem valor */
                    if ($this->procurarValores($atributo, $this->atributosemvalor)) {
                        $sAtributos .= ' ' . $atributo;
                    } else {
                        $sAtributos .= ' ' . $atributo . '="' . $valor . '"';
                    }
                }
            } else {
                $sArgumento .= $conteudo;
            }
        }

        /* Procura se o elemento não fecha */
        if ($this->procurarValores($element, $this->naofecha) !== false) {
            /* Retorna esse código caso o elemento não possa ser fechado */
            return '<' . $element . $sAtributos . '>' . $sArgumento;
        } else {
            /* Retorna esse código caso o elemento possa ser fechado */
            return '<' . $element . $sAtributos . '>' . $sArgumento . '</' . $element . '>';
        }
    }

    public function if(mixed $condicao, mixed $callback) {
        if ($condicao) {
            return $callback($this);
        }
    }

    /* Retorna o DOCTYPE HTML5 */
    public function doctype():string {
        return '<!DOCTYPE html>' . "\n";
    }

    /* Procura os Valores do Array */
    private function procurarValores(string $palavra, mixed $itens): bool
    {
        $aItens = (is_array($itens)) ? $itens : [$itens];

        foreach ($aItens as $valor) {
            if (strpos($palavra, $valor, 0) !== false) {
                /* Retorna o primeiro resultado e encerra a procura */
                return true;
            }
        }

        return false;
    }
}
