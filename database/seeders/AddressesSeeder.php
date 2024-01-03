<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("addressesの作成を開始します...");

        $memberSplFileObject = new \SplFileObject(__DIR__ . '/KEN_ALL.CSV');
        $memberSplFileObject->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        foreach ($memberSplFileObject as $key => $row) {
            //excelでcsvを保存するとBOM付きになるので削除する
            if ($key === 0) {
                $row[0] = preg_replace('/^\xEF\xBB\xBF/', '', $row[0]);
            }

            DB::table('addresses')->insert([
                'zip' => (int) trim($row[0]),
                'pref' => trim($row[1]),
                'city' => trim($row[2]),
                'town' => trim($row[3]),
            ]);
        }
        $this->command->info("addressesを作成しました。");
    }
}
