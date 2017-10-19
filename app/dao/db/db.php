<?php
	interface ConnectionDB {
		public function __construct();
		public function getPDO();
		public function destroy_connection(); 
	}
?>