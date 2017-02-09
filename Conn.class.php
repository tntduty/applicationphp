<?php
    class Conn{
        //Retorna um objeto PDO
		private static $Connect;

		//Seta a conexão
		private function setConn()
		{
			if(is_null(self::$Connect)){
				try {
					self::$Connect = new PDO('mysql:host='.HOSTNAME.';dbname='.DATABASE, USERNAME, PASSWORD);
					self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch (PDOException $e) {
					die("Erro : {$e->getMessage()}");
				}
			}
			return self::$Connect;
		}

		//Retorn metodo de conexão Singleton
		public function getConn()
		{
            return $this->setConn();
		}

	}
?>