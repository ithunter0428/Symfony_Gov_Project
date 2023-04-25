<?php

namespace App\Service;

class TechnologyPhase
{
    public function getOption(): array
    {
        $option = [
            1 => 
            [
                'name' => '基礎研究段階',
                'name_en' => 'basic research',
            ],
            2 => 
            [
                'name' => '応用研究段階',
                'name_en' => 'application research',
            ],
            3 => 
            [
                'name' => '実用化段階',
                'name_en' => 'practical application',
            ],
            4 => 
            [
                'name' => '事業化段階',
                'name_en' => 'commercialization',
            ],
        ];

        return $option;
    }
}