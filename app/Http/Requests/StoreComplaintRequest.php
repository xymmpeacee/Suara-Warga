<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Public form, semua orang boleh akses
    }

    public function rules(): array
    {
        return [
            'category' => 'required|in:jalan_rusak,sampah,penerangan,drainase,fasilitas_umum,lainnya',
            'title' => 'required|string|max:150',
            'description' => 'required|string|min:20',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'nullable|string|max:255',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'priority' => 'required|in:rendah,sedang,tinggi',
            'whatsapp' => ['required', 'regex:/^(\+62|62|08)[0-9]{8,13}$/'],
            'reporter_name' => 'nullable|string|max:100',
            'reporter_email' => 'required|email|max:255',
            'agreement' => 'required|accepted',
        ];
    }

    public function messages(): array
    {
        return [
            'category.required' => 'Pilih salah satu kategori aduan.',
            'title.required' => 'Judul aduan wajib diisi.',
            'title.max' => 'Judul aduan maksimal 150 karakter.',
            'description.required' => 'Deskripsi aduan wajib diisi.',
            'description.min' => 'Deskripsi minimal 20 karakter.',
            'latitude.required' => 'Lokasi wajib dipilih pada peta.',
            'longitude.required' => 'Lokasi wajib dipilih pada peta.',
            'photo.required' => 'Foto bukti wajib diunggah.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Format gambar harus JPG atau PNG.',
            'photo.max' => 'Ukuran gambar maksimal 5MB.',
            'priority.required' => 'Pilih tingkat prioritas.',
            'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'whatsapp.regex' => 'Format nomor WhatsApp tidak valid (gunakan 08xx atau +62).',
            'reporter_email.required' => 'Email wajib diisi untuk menerima notifikasi tiket.',
            'reporter_email.email' => 'Format email tidak valid.',
            'agreement.accepted' => 'Anda harus menyetujui pernyataan kebenaran data.',
        ];
    }
}
