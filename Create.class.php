<?php
    class Create extends Conn{
        private $Create;
        private $Connect;
        private $Places;
        private $Tabela;
        private $LastId;

        public function getCreate($Tabela, array $Places)
        {
            $this->Tabela = $Tabela;
            $this->Places = $Places;
            $this->ExeCreate();
        }
        
        public function getLastId()
        {
            return $this->Connect->lastInsertId();
        }
        
        private function getSyntax(){
            $Keys = implode(",", array_keys($this->Places));
            $Keys2 = ":".implode(",:", array_keys($this->Places));
            $this->Create = $this->Connect->prepare("INSERT INTO {$this->Tabela} ({$Keys}) VALUES ({$Keys2})");
           
        }
        
        private function ExeCreate()
        {
            $this->Connect = self::getConn();
            try {
                $this->getSyntax();
                $this->Create->execute($this->Places);
            } catch (PDOException $e) {
                die("<b>Line :</b> {$e->getLine()} <b>Error :</b> {$e->getMessage()}");
            }
        }
        
    }