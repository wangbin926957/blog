<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

class TestController extends Controller {
    public function index() {
        echo 'test_index';
    }
}