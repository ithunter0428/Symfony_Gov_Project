<?php

namespace App\Service;

class SecretQuestion
{
    public function getOption(): array
    {
        $option = [
            '生まれた町名は？'        => 1,
            '卒業した小学校名は？'     => 2,
            'ペットの名前は？'        => 3,
            '母親の旧姓は？'         => 4,
            '父方の祖父の下の名前は？'  => 5,
            '好きな映画の題名は？'     => 6,
            '子供の頃のヒーローは誰？'  => 7,
            '好きなスポーツチーム名は？' => 8
        ];

        return $option;
    }
}