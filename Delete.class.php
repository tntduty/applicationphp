<?php
	class Delete extends Conn{
		private $Delete;
		private $Places;
		private $Connect;
		private $Results;

		public function getDelete($Tabela, $Termos, $Places)
		{
			if($Places):
				parse_str($Places, $this->Places);
			endif;
			$this->Delete = "DELETE FROM {$Tabela} {$Termos}";
			$this->ExeDelete();
		}

		private function getSyntax()
		{
			$this->Delete = $this->Connect->prepare("{$this->Delete}");
			if(!is_null($this->Places)):
				foreach($this->Places as $Key => $Value):
					$this->Delete->bindValue(":{$Key}", $Value, (is_int($Value) ? PDO::PARAM_STR : PDO::PARAM_INT));
				endforeach;
			endif;
		}

		private function ExeDelete()
		{	
			$this->Connect = self::getConn();
			try {
				$this->getSyntax();
				$this->Delete->execute();
				$this->Results = true;
			} catch (PDOException $e) {
				die("<b>Line :</b> {$e->getLine()} <b>Error :</b> {$e->getMessage()}");
			}
			

		}
	}
?>