<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\ComplaintResponse;
use App\Models\Upvote;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    public function run(): void
    {
        $complaints = [
            [
                'category' => 'jalan_rusak',
                'title' => 'Lubang besar di Jl. Melati',
                'description' => 'Terdapat lubang sedalam ±20cm di depan rumah no.14, berbahaya untuk pengendara motor saat malam hari. Lubang ini sudah ada sejak minggu lalu dan semakin membesar.',
                'latitude' => -6.9175,
                'longitude' => 107.6191,
                'address' => 'Jl. Melati No.14, Kel. Sukamaju',
                'priority' => 'tinggi',
                'whatsapp' => '081234567890',
                'reporter_name' => 'Riyan Aprianysah',
                'reporter_email' => 'riyan@example.com',
                'status' => 'diproses',
                'upvote_count' => 14,
            ],
            [
                'category' => 'sampah',
                'title' => 'Tumpukan sampah tidak terangkut',
                'description' => 'Sudah 3 hari sampah di TPS belum diangkut, mulai berbau dan mengundang lalat. Warga sekitar mengeluhkan bau yang sangat menyengat terutama di pagi hari.',
                'latitude' => -6.9210,
                'longitude' => 107.6150,
                'address' => 'TPS RW.04, Kel. Cemara',
                'priority' => 'sedang',
                'whatsapp' => '082198765432',
                'reporter_name' => 'Fajar Zaini Ilyas',
                'reporter_email' => 'fajar@example.com',
                'status' => 'selesai',
                'upvote_count' => 8,
            ],
            [
                'category' => 'penerangan',
                'title' => 'Lampu jalan mati',
                'description' => 'Lampu PJU di tikungan padam sejak minggu lalu, jalan sangat gelap dan rawan kecelakaan. Beberapa warga sudah pernah nyaris terperosok.',
                'latitude' => -6.9250,
                'longitude' => 107.6200,
                'address' => 'Persimpangan Jl. Anggrek',
                'priority' => 'tinggi',
                'whatsapp' => '085312345678',
                'reporter_name' => 'Muhammad Hasanuddin',
                'reporter_email' => 'hasan@example.com',
                'status' => 'pending',
                'upvote_count' => 22,
            ],
            [
                'category' => 'drainase',
                'title' => 'Saluran air tersumbat menyebabkan banjir',
                'description' => 'Gorong-gorong di bawah jalan tersumbat sampah dan sedimen. Setiap hujan deras, air meluap ke jalan dan masuk ke rumah warga di RT 03.',
                'latitude' => -6.9300,
                'longitude' => 107.6170,
                'address' => 'Jl. Kenanga RT.03/RW.02',
                'priority' => 'tinggi',
                'whatsapp' => '087812345678',
                'reporter_name' => null,
                'reporter_email' => 'warga.kenanga@example.com',
                'status' => 'diproses',
                'upvote_count' => 31,
            ],
            [
                'category' => 'fasilitas_umum',
                'title' => 'Bangku taman rusak dan berbahaya',
                'description' => 'Dua bangku di taman RW.05 sudah lapuk, papan duduknya patah dan ada paku yang menonjol. Berbahaya untuk anak-anak yang bermain.',
                'latitude' => -6.9155,
                'longitude' => 107.6220,
                'address' => 'Taman RW.05, Kel. Sukamaju',
                'priority' => 'sedang',
                'whatsapp' => '081298765432',
                'reporter_name' => 'Siti Nurhaliza',
                'reporter_email' => 'siti@example.com',
                'status' => 'selesai',
                'upvote_count' => 5,
            ],
            [
                'category' => 'jalan_rusak',
                'title' => 'Aspal terkelupas di depan SD Negeri 2',
                'description' => 'Aspal di depan gerbang sekolah terkelupas lebar sekitar 1 meter. Banyak siswa yang lewat setiap hari dan berisiko terjatuh, apalagi saat hujan.',
                'latitude' => -6.9185,
                'longitude' => 107.6240,
                'address' => 'Jl. Pendidikan No.5, Kel. Cemara',
                'priority' => 'tinggi',
                'whatsapp' => '089612345678',
                'reporter_name' => 'Budi Santoso',
                'reporter_email' => 'budi@example.com',
                'status' => 'pending',
                'upvote_count' => 18,
            ],
            [
                'category' => 'sampah',
                'title' => 'Pembuangan liar di lahan kosong',
                'description' => 'Ada oknum yang membuang sampah sembarangan di lahan kosong dekat kali. Sudah berkali-kali terjadi dan menimbulkan bau serta pencemaran air.',
                'latitude' => -6.9320,
                'longitude' => 107.6130,
                'address' => 'Lahan kosong dekat Kali Cipamokolan',
                'priority' => 'sedang',
                'whatsapp' => '081387654321',
                'reporter_name' => null,
                'reporter_email' => 'peduli.lingkungan@example.com',
                'status' => 'ditolak',
                'upvote_count' => 3,
            ],
            [
                'category' => 'penerangan',
                'title' => 'Lampu gang RT.07 mati total',
                'description' => 'Seluruh lampu penerangan di gang RT.07 padam bersamaan. Diduga kabel putus akibat pohon tumbang saat hujan angin minggu lalu.',
                'latitude' => -6.9195,
                'longitude' => 107.6180,
                'address' => 'Gang Mawar RT.07/RW.03',
                'priority' => 'tinggi',
                'whatsapp' => '082234567890',
                'reporter_name' => 'Ahmad Fauzi',
                'reporter_email' => 'ahmad@example.com',
                'status' => 'diproses',
                'upvote_count' => 12,
            ],
            [
                'category' => 'lainnya',
                'title' => 'Pohon besar rawan tumbang',
                'description' => 'Pohon beringin besar di pinggir jalan sudah miring dan akar-akarnya terangkat. Dikhawatirkan akan tumbang saat musim hujan dan menimpa rumah warga.',
                'latitude' => -6.9230,
                'longitude' => 107.6210,
                'address' => 'Jl. Dahlia No.20, Kel. Sukamaju',
                'priority' => 'tinggi',
                'whatsapp' => '085698765432',
                'reporter_name' => 'Dewi Lestari',
                'reporter_email' => 'dewi@example.com',
                'status' => 'pending',
                'upvote_count' => 27,
            ],
            [
                'category' => 'fasilitas_umum',
                'title' => 'Pagar makam umum jebol',
                'description' => 'Pagar makam umum Kel. Cemara jebol di sisi utara. Hewan ternak sering masuk dan merusak area pemakaman. Warga merasa tidak nyaman.',
                'latitude' => -6.9280,
                'longitude' => 107.6160,
                'address' => 'Makam Umum Kel. Cemara',
                'priority' => 'rendah',
                'whatsapp' => '081567890123',
                'reporter_name' => 'Haji Umar',
                'reporter_email' => 'umar@example.com',
                'status' => 'pending',
                'upvote_count' => 6,
            ],
            [
                'category' => 'drainase',
                'title' => 'Got meluap setiap hujan di Jl. Cempaka',
                'description' => 'Saluran drainase di Jl. Cempaka kapasitasnya sudah tidak memadai. Setiap hujan sedang-deras, air meluap ke badan jalan setinggi ±15cm.',
                'latitude' => -6.9160,
                'longitude' => 107.6190,
                'address' => 'Jl. Cempaka, Kel. Sukamaju',
                'priority' => 'sedang',
                'whatsapp' => '089898765432',
                'reporter_name' => 'Iwan Setiawan',
                'reporter_email' => 'iwan@example.com',
                'status' => 'selesai',
                'upvote_count' => 10,
            ],
            [
                'category' => 'jalan_rusak',
                'title' => 'Trotoar pecah dan berlubang',
                'description' => 'Trotoar di sepanjang Jl. Mawar sudah hancur dan banyak lubang. Pejalan kaki terpaksa berjalan di badan jalan yang berbahaya.',
                'latitude' => -6.9205,
                'longitude' => 107.6230,
                'address' => 'Jl. Mawar, Kel. Cemara',
                'priority' => 'sedang',
                'whatsapp' => '081234509876',
                'reporter_name' => 'Rina Marlina',
                'reporter_email' => 'rina@example.com',
                'status' => 'pending',
                'upvote_count' => 9,
            ],
        ];

        foreach ($complaints as $index => $data) {
            $complaint = Complaint::create(array_merge($data, [
                'ticket_code' => Complaint::generateTicketCode(),
                'photo_path' => 'dummy', // Placeholder, will be set below
                'created_at' => now()->subHours(rand(1, 72)),
            ]));

            // Set photo_path to picsum seeded image (consistent across loads)
            $complaint->update(['photo_path' => "https://picsum.photos/seed/sw{$complaint->id}/800/450"]);

            // Tambahkan tanggapan untuk laporan yang sudah diproses/selesai
            if (in_array($data['status'], ['diproses', 'selesai'])) {
                ComplaintResponse::create([
                    'complaint_id' => $complaint->id,
                    'status_at_response' => 'diproses',
                    'message' => 'Laporan telah diterima dan sedang dalam proses penanganan oleh tim kami. Terima kasih atas laporannya.',
                    'created_at' => $complaint->created_at->addHours(rand(1, 6)),
                ]);
            }

            if ($data['status'] === 'selesai') {
                ComplaintResponse::create([
                    'complaint_id' => $complaint->id,
                    'status_at_response' => 'selesai',
                    'message' => 'Perbaikan telah selesai dilakukan. Silakan periksa lokasi dan beri kami masukan jika masih ada kendala.',
                    'photo_path' => "https://picsum.photos/seed/fix{$complaint->id}/800/450",
                    'created_at' => $complaint->created_at->addHours(rand(12, 48)),
                ]);
            }

            if ($data['status'] === 'ditolak') {
                ComplaintResponse::create([
                    'complaint_id' => $complaint->id,
                    'status_at_response' => 'ditolak',
                    'message' => 'Laporan tidak dapat diproses karena informasi yang diberikan kurang lengkap atau tidak sesuai dengan area pelayanan kami.',
                    'created_at' => $complaint->created_at->addHours(rand(2, 8)),
                ]);
            }

            // Tambahkan dummy upvotes (sesuai upvote_count)
            for ($i = 0; $i < min($data['upvote_count'], 5); $i++) {
                Upvote::create([
                    'complaint_id' => $complaint->id,
                    'email' => "supporter{$i}_{$complaint->id}@example.com",
                ]);
            }
        }
    }
}
