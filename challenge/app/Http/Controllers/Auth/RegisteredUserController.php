<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
    
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => ['nullable','image', 'mimes:jpg,jpeg,png,gif'],
            'localidad' => ['required', 'string', 'max:255'],
        ]);
    

        $sanitizedData = $request->only(['name', 'email', 'localidad']);
        $sanitizedData['name'] = strip_tags($sanitizedData['name']); 
        $sanitizedData['localidad'] = strip_tags($sanitizedData['localidad']); 
    
       
        $sanitizedData['email'] = strtolower($sanitizedData['email']);
        
 
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
        } else {
            $imagePath = null; 
        }

        $user = User::create([
            'name' => $sanitizedData['name'],
            'email' => $sanitizedData['email'],
            'password' => Hash::make($request->password),
            'rol' => 2,
            'image' => $imagePath,
            'localidad' => $sanitizedData['localidad'],
        ]);
    
     
        event(new Registered($user));
    
       
        Auth::login($user);
    
        return redirect(route('evento.inicio', absolute: false));
    }
}
