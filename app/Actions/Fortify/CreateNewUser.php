<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        Validator::make($input, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'no_hp' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string'],
            'password' => $this->passwordRules(),
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'no_hp.required' => 'Nomor WhatsApp / HP wajib diisi.',
            'alamat.required' => 'Alamat lengkap wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ])->validate();

        return User::create([
            'nama' => $input['nama'],
            'email' => $input['email'],
            'no_hp' => $input['no_hp'],
            'alamat' => $input['alamat'],
            'password' => Hash::make($input['password']),
            'role' => 'pelanggan',
        ]);
    }
}