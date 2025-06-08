<?php

class Index extends Controller
{
    private $data = [];
    private $userModel;

    public function __construct()
    {
        // You can initialize any models or libraries here if needed
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $currentTime = $this->userModel->select("SELECT NOW() AS now");
        if ($currentTime && isset($currentTime[0]->now)) {
            $currentTime = $currentTime[0]->now;
        } else {
            $currentTime = 'Unavailable';
        }

        $this->data = [
            'title' => 'Core PHP-MVC-Framework',
            'description' => 'A simple open source PHP-MVC-Framework',
            'time' => "Current server connection time: " . $currentTime . " at " . date('h:i A T, l, F j, Y'),
        ];

        $this->view('pages/index', $this->data);
    }
}
