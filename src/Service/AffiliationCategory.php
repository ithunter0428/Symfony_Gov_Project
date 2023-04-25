<?php

namespace App\Service;

class AffiliationCategory
{
    public function getOption(): array
    {
        $option = [
            '民間企業' => 1,
            '官庁' => 2,
            '地方自治体' => 3,
            '大学、研究機関等' => 4,
            '学校（小中高）' => 5,
            '上記以外の公的機関' => 6,
            'NGO、NPO' => 7,
            '財団法人・社団法人等' => 8,
            'その他' => 9,
        ];

        return $option;
    }
}