<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Dilindungi oleh middleware auth:admin di route
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'message' => 'nullable|string|max:2000',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Pilih status yang baru.',
            'status.in' => 'Status tidak valid.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Format gambar harus JPG atau PNG.',
            'photo.max' => 'Ukuran gambar maksimal 5MB.',
        ];
    }
}
