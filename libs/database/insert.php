<?php
// Copyright (C) 2025 Murilo Gomes Julio
// SPDX-License-Identifier: LGPL-2.1-only

// Site: https://www.mugomes.com.br

namespace MiPhantLibs\database;

class insert extends database
{
    public function insert()
    {
        try {
            $sql = 'INSERT INTO ' . $this->sTable[0] . ' (';

            foreach ($this->sValores as $row) {
                $sql .= $row['nome'] . ',';
            }
            $sql = rtrim($sql, ',');
            $sql .= ') VALUES (';
            if ($this->sPrepare) {
                foreach ($this->sValores as $row) {
                    $sql .= ':' . $row['nome'] . ',';
                }
            } else {
                foreach ($this->sValores as $row) {
                    $sql .= "'{$row['valor']}',";
                }
            }

            $sql = rtrim($sql, ',');
            $sql .= ')';

            if ($this->sPrepare) {
                if ($this->sResult = $this->sConecta->prepare($sql)) {
                    foreach ($this->sValores as $row) {
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

    public function execute() {
        $this->sResult->execute();
    }

    public function idInsert(): int {
        return $this->sConecta->lastInsertRowID();
    }
}
