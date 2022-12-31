<?php
	
	/*controller padrão.
	Por padrão, leva a página home
	também define a view da página 404 (de erro)
	*/

	class Paginas extends Controller {

		public function index() {
			$this->view('paginas/home');
		}

		public function erro() {
			$this->view('paginas/erro');
		}

	}
?>