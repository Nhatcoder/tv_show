<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('movie')->insert([
                'name' => 'Mất Tích ' . $i,
                'slug' => 'Mất Tích-' . $i,
                'original_name' => 'Original Movie ' . $i,
                'total_episodes' => 13,
                'description' => 'Thợ săn hạng E Jinwoo Sung là người yếu nhất trong số họ. Bị mọi người coi thường, anh ta không có tiền, không có khả năng nói và không có triển vọng công việc nào khác. Vì Vì vậy, khi nhóm của anh ấy tìm thấy một nơi ẩn náu sâu thẳm, anh ấy quyết định sử dụng cơ hội này để thay đổi cuộc sống của mình tốt hơn... Nhưng cơ hội mà anh ấy tìm thấy hơi thở khác so với những gì anh ấy nghĩ trong đầu! Nguồn: VuiGhe',
                'time' => 'thời lượng ngắn',
                'thumb_url' => 'https://img.ophim14.cc/uploads/movies/hide-2024-thumb.jpg',
                'poster_url' => 'https://img.ophim14.cc/uploads/movies/hide-2024-thumb.jpg',
                'id_category' => 73,
                'id_genre' => '1',
                'quality' => 'quality',
                'language' => 'language',
                'director' => 'director',
                'casts' => 'casts',
                'hot' => 1,
                'status' => 1,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('movie');
    }
};
