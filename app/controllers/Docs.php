<?php 

class Docs extends Controller {
    private $data = [];

    public function __construct() {
        // You can initialize any models or libraries here if needed
    }

    public function index() {
        $this->data = [
            'title' => 'Documentation',
            'description' => 'Documentation for the PHP-MVC-Framework',
        ];

        $this->view('pages/docs', $this->data);
    }
}