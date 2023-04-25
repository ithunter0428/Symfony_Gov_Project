<?php

namespace App\Service;

class BusinessCategory
{
    public function getOption(): array
    {
        $option = [
          '農業、林業、漁業' => 1,
          '鉱業、採石業、砂利採取業' => 2,
          '建設業' => 3,
          '製造業' => 4,
          '電気・ガス・熱供給・水道業' => 5,
          '情報通信業' => 6,
          '運輸業' => 7,
          '卸売業、小売業' => 8,
          '金融業、保険業' => 9,
          '不動産業' => 10,
          '医療、福祉' => 11,
          'サービス' => 12,
          'その他' => 12,
        ];

        return $option;
    }
}