<?php
// Copyright (C) 2025 Murilo Gomes Julio
// SPDX-License-Identifier: MIT

// Site: https://github.com/mugomes

namespace MiPhantLibs\database;

class update extends database
{
    public function update()
    {
        try {
            $sql = 'UPDATE ' . $this->sTable[0] . ' SET ';
            if ($this->sPrepare) {
                foreach ($this->sValores as $row) {
                    $sql .= $row['nome'] . '=:' . $row['nome'] . ',';
                }
            } else {
                foreach ($this->sValores as $row) {
                    $sql .= "{$row['nome']}='{$row['valor']}',";
                }
            }

            $sql = rtrim($sql, ',');
            $sql .= $this->getWhere();
            
            if ($this->sPrepare) {
                if ($this->sResult = $this->sConecta->prepare($sql)) {
                    foreach ($this->sValores as $row) {
                        $this->sResult->bindParam(':' . $row['nome'], $row['valor']);
                    }

                    foreach ($this->sWhere as $row) {
                        $this->sResult->bindParam(':' . $row['nome'], $row['valor']);
                    }

                    $this->sResult->execute();
                    $this->sFechaResult = true;
                } else {
                    $this->sFechaResult = false;
                }
            } else {
                $this->sConecta->query($sql);
                $this->sFechaResult = false;
            }
        } catch (\SQLite3Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
