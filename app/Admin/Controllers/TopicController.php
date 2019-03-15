<?php

namespace App\Admin\Controllers;

class TopicController extends Controller
{
    // 首页
    public function index()
    {
        return view('admin/topic/index');
    }

    public function create()
    {
        return view('admin/topic/create');
    }

    public function store()
    {
        
    }

    public function destroy()
    {
        
    }
}