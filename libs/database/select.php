<?php
// Copyright (C) 2025 Murilo Gomes Julio
// SPDX-License-Identifier: MIT

// Support: https://www.mugomes.com.br/p/apoie.html

namespace MiPhantLibs\database;

use SQLite3;

class select extends database {
    public function select() {
        try {
            $sql = 'SELECT ';
            $sql .= (empty($this->sColumns)) ? '*' : implode(', ', $this->sColumns);
            $sql .= ' FROM ' . implode(' INNER JOIN ', $this->sTable);
            $sql .= $this->getWhere() . $this->getOrder() . $this->getLimit();

            if ($this->sPrepare) {
                if ($this->sResult = $this->sConecta->prepare($sql)) {
                    $sIn = 1;
                    foreach ($this->sWhere as $row) {
                        if ($row['like']) {
                            $sLike = '%' . $row['valor'] . '%';
                            $this->sResult->bindParam(':' . $row['nome'], $sLike);
                        } else {
                            if ($row['in']) {
                                $this->sResult->bindParam(':' . $row['nome'] . $sIn, $row['valor']);
                                $sIn += 1;
                            } else {
                                $this->sResult->bindParam(':' . $row['nome'], $row['valor']);
                            }
                        }
                    }

                    $this->sData = $this->sResult->execute();
                    $this->sFechaResult = true;
                } else {
                    $this->sFechaResult = false;
                }
            } else {
                $this->sResult = $this->sConecta->query($sql);
                $this->sFechaResult = true;
            }
        } catch (\SQLite3Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function fetch() {
        return ($this->sPrepare) ? $this->sData->fetchArray() : $this->sResult->fetchArray();
    }
}