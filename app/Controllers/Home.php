<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Inicio - ServiApp';
        return view('Home/index', $data);
    }
}
