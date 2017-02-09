<?php
    //Ler qualquer tabela de banco de dados
    class Read extends Conn{
        private $Connect;
        private $Read;
        private $Places;
        private $Results;
        
        public function getRead($Tabela, $Dados, $Places = false){
            $this->Read = "SELECT * FROM {$Tabela} {$Dados}";
            if($Places):
            	parse_str($Places, $this->Places);
            endif;
            $this->ExeRead();

        }
        
        public function getResults()
        {
            return $this->Results;
        }
        
        public function getRowCount(){
            return $this->Read->rowCount();
        }

        private function getSyntax(){
            $this->Read = $this->Connect->prepare("{$this->Read}");
            if(!is_null($this->Places)):
                foreach($this->Places as $Keys => $Values){
                    $this->Read->bindValue(":{$Keys}", $Values, (is_int($Values) ? PDO::PARAM_INT : PDO::PARAM_STR));
                }
            endif;
        }

        private function ExeRead()
        {
            $this->Connect = self::getConn();
            try {
                $this->getSyntax();
                $this->Read->execute();
            } catch (PDOException $e) {
                die("<b>Line :</b> {$e->getLine()} <b>Error :</b> {$e->getMessage()}");
            }
            
            $this->Results = $this->Read->fetchAll(PDO::FETCH_ASSOC);
        }
    }
