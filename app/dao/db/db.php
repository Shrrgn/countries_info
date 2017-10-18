<?php
	interface ConnectionDB {
		public function __construct();
		public function destroy_connection($pdo); 
	}
?>