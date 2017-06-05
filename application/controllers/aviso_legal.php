<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aviso_legal extends MY_Controller {
    
    public function index() {
        $this->go_to_view('aviso_legal', 'aside', [], []);
    }
}