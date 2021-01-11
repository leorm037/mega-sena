<?php

namespace PaginaEmConstrucao\Controller;

use PaginaEmConstrucao\Core\Connect;
use PDO;

class Web extends AbstractController {

    public function __construct()
    {
        parent::__construct();
    }

    public function home(): void
    {
        echo $this->render("home", [
            "umNumero" => $this->umNumero(),
            "doisNumero" => $this->doisNumero(),
            "tresNumero" => $this->tresNumero(),
            "ano" => "todos"
        ]);
    }

    public function ano(array $data): void
    {
        $ano = $data['ano'];

        if ($ano >= 1996 && $ano <= date('Y')) {
            echo $this->render("home", [
                "umNumero" => $this->umNumero($ano),
                "doisNumero" => $this->doisNumero($ano),
                "tresNumero" => $this->tresNumero($ano),
                "ano" => $ano
            ]);
        } else {
            $this->error(["errorCode" => 404]);
        }
    }

    /**
     * 
     * @return array
     */
    private function umNumero(string $ano = null): array
    {
        $cacheUmNumero = $this->getCache("umNumero" . $ano);

        if ($cacheUmNumero) {
            return $cacheUmNumero;
        }

        $umNumero = [];

        if ($ano) {

            $sql = "SELECT COUNT(*) as total FROM results WHERE (mega like :i) AND YEAR(date) = :ano";
        } else {
            $sql = "SELECT COUNT(*) as total FROM results WHERE (mega like :i)";
        }

        for ($i = 1; $i <= 60; $i++) {
            $stmt = Connect::getInstance()->prepare($sql);

            if ($ano) {
                $stmt->bindValue(":ano", $ano, PDO::PARAM_INT);
            }

            $stmt->bindValue(":i", "%[" . str_pad($i, 2, "0", STR_PAD_LEFT) . "]%");
            $stmt->execute();

            $result = $stmt->fetchObject();

            $umNumero[str_pad($i, 2, "0", STR_PAD_LEFT)] = $result->total;
        }

        arsort($umNumero, SORT_NUMERIC);

        $this->setCache("umNumero" . $ano, $umNumero);

        return $umNumero;
    }

    private function doisNumero(string $ano = null): array
    {
        $cacheDoisNumero = $this->getCache("doisNumero" . $ano);

        if ($cacheDoisNumero) {
            return $cacheDoisNumero;
        }

        $doisNumero = [];

        if ($ano) {
            $sql = "SELECT COUNT(*) as total FROM results WHERE (mega like :i) AND (mega like :j) AND YEAR(date) = :ano";
        } else {
            $sql = "SELECT COUNT(*) as total FROM results WHERE (mega like :i) AND (mega like :j)";
        }

        for ($i = 1; $i <= 60; $i++) {
            $stmt = Connect::getInstance()->prepare($sql);

            if ($ano) {
                $stmt->bindValue(":ano", $ano, PDO::PARAM_INT);
            }

            $stmt->bindValue(":i", "%[" . str_pad($i, 2, "0", STR_PAD_LEFT) . "]%");

            for ($j = 1; $j <= 60; $j++) {
                if ($j > $i) {
                    $stmt->bindValue(":j", "%[" . str_pad($j, 2, "0", STR_PAD_LEFT) . "]%");

                    $stmt->execute();

                    $result = $stmt->fetchObject();

                    if ($result->total > 0) {
                        $doisNumero[str_pad($i, 2, "0", STR_PAD_LEFT) . " - " . str_pad($j, 2, "0", STR_PAD_LEFT)] = $result->total;
                    }
                }
            }
        }

        arsort($doisNumero, SORT_NUMERIC);

        $this->setCache("doisNumero" . $ano, $doisNumero);

        return $doisNumero;
    }

    private function tresNumero(string $ano = null): array
    {
        $cacheTresNumero = $this->getCache("tresNumero" . $ano);

        if ($cacheTresNumero) {
            return $cacheTresNumero;
        }

        ini_set('max_execution_time', 3600);

        $tresNumero = [];

        if ($ano) {
            $sql = "SELECT COUNT(*) as total FROM results WHERE (mega like :i) AND (mega like :j) AND (mega like :k) AND YEAR(date) = :ano";
        } else {
            $sql = "SELECT COUNT(*) as total FROM results WHERE (mega like :i) AND (mega like :j) AND (mega like :k)";
        }

        for ($i = 1; $i <= 60; $i++) {
            $stmt = Connect::getInstance()->prepare($sql);

            if ($ano) {
                $stmt->bindValue(":ano", $ano, PDO::PARAM_INT);
            }

            $stmt->bindValue(":i", "%[" . str_pad($i, 2, "0", STR_PAD_LEFT) . "]%");

            for ($j = 1; $j <= 60; $j++) {
                if ($j > $i) {
                    $stmt->bindValue(":j", "%[" . str_pad($j, 2, "0", STR_PAD_LEFT) . "]%");

                    for ($k = 1; $k <= 60; $k++) {
                        if ($k > $j) {

                            $stmt->bindValue(":k", "%[" . str_pad($k, 2, "0", STR_PAD_LEFT) . "]%");

                            $stmt->execute();

                            $result = $stmt->fetchObject();

                            if ($result->total > 0) {
                                $tresNumero[str_pad($i, 2, "0", STR_PAD_LEFT) . " - " . str_pad($j, 2, "0", STR_PAD_LEFT) . " - " . str_pad($k, 2, "0", STR_PAD_LEFT)] = $result->total;
                            }
                        }
                    }
                }
            }
        }

        arsort($tresNumero, SORT_NUMERIC);

        $this->setCache("tresNumero" . $ano, $tresNumero);

        return $tresNumero;
    }

    public function error(array $data): void
    {
        $error = new \stdClass();

        $error->code = $data['errorCode'];

        echo $this->render("error", ["error" => $error]);
    }

}
