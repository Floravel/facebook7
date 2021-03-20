<?php

namespace App\Http\Controllers;

use App\Models\FacebookRegistration;
use Illuminate\Http\Request;

class FacebookRegistrationController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'email' => 'required|email'
        ]);

        FacebookRegistration::create($data);
    }
}
