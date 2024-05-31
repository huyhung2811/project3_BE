<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Khoa Giáo dục Quốc phòng & An ninh',
                'office' => 'D3 - 504',
                'phone' => '024 3868 0473',
                'email' => '',
                'website' => '',
            ],
            [
                'name' => 'Khoa Giáo dục Thể chất',
                'office' => 'Tầng 2 - Nhà thi đấu Bách Khoa',
                'phone' => '024 3868 4922/ 3869 2811',
                'email' => '',
                'website' => ''
            ],
            [
                'name' => 'Khoa Lý luận Chính trị',
                'office' => 'D3 - 306',
                'phone' => '024 3869 2105 - 024 3868 4401',
                'email' => '',
                'website' => 'fpt.hust.edu.vn',
            ],
            [
                'name' => 'Trường Cơ Khí',
                'office' => '614M - C7',
                'phone' => '0868040770',
                'email' => 'sme@hust.edu.vn',
                'website' => 'sme.hust.edu.vn',
            ],
            [
                'name' => 'Trường Công nghệ Thông tin và Truyền thông',
                'office' => 'Nhà B1 - Phòng 505',
                'phone' => '024 38 692 463',
                'email' => 'vp@soict.hust.edu.vn',
                'website' => 'soict.hust.edu.vn',
            ],
            [
                'name' => 'Trường Điện - Điện tử',
                'office' => 'C7 - E605',
                'phone' => '024 3869 6211/024 3869 2242',
                'email' => 'seee@hust.edu.vn',
                'website' => 'seee.hust.edu.vn',
            ],
            [
                'name' => 'Trường Hóa và Khoa học sự sống',
                'phone' => '024 3868 2470/ 3869.2515',
                'fax' => '024 3868 2470',
                'email' => 'scls@hust.edu.vn',
                'website' => 'scls.hust.edu.vn',
            ],
            [
                'name' => 'Trường Vật liệu',
                'office' => 'D8 - 706',
                'phone' => '024 38680409',
                'email' => 'smse@hust.edu.vn',
                'website' => 'smse.hust.edu.vn',
            ],
            [
                'name' => 'Khoa Toán - Tin',
                'office' => 'D3 - 106',
                'phone' => '024 38692137',
                'email' => 'fami@hust.edu.vn',
                'website' => 'fami.hust.edu.vn',
            ],
            [
                'name' => 'Khoa Vật lý Kỹ thuật',
                'office' => 'C10-116',
                'phone' => '024 3869 3350',
                'email' => 'sep@hust.edu.vn',
                'website' => 'sep.hust.edu.vn',
            ],
            [
                'name' => 'Viện Kinh tế và Quản lý',
                'office' => 'C9 - 303,304',
                'phone' => '024 38 692 304/ 3868.0791',
                'email' => 'sem@hust.edu.vn',
                'website' => 'sem.hust.edu.vn',
            ],
            [
                'name' => 'Khoa Ngoại ngữ',
                'office' => 'M310 - C7',
                'phone' => '',
                'email' => 'sofl@hust.edu.vn',
                'website' => 'sofl.hust.edu.vn',
            ],
            [
                'name' => 'Khoa Khoa học và Công nghệ Giáo dục',
                'office' => 'M321 - C7',
                'phone' => '0902282489',
                'email' => 'sepd@hust.edu.vn',
                'website' => 'fed.hust.edu.vn',
            ],
        ];

        Unit::insert($data);
    }
}
