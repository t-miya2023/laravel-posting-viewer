<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CountyProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('county', function () {
            $counties = [
                '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県',
        '東京都', '神奈川県', '千葉県', '埼玉県', '茨城県', '栃木県', '群馬県',
        '愛知県', '静岡県', '岐阜県', '三重県', '長野県', '山梨県', '新潟県',
        '大阪府', '兵庫県', '京都府', '滋賀県', '奈良県', '和歌山県',
        '広島県', '岡山県', '鳥取県', '島根県', '山口県', '香川県', '愛媛県', '徳島県', '高知県',
        '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県',
            ];
    
            return $counties[array_rand($counties)];
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
