<?php


namespace App\Helpers;


class ArrayHelper
{

    /**
     * @param array $data
     * @return array
     */
    public static function sortEntity(array $data): array
    {
        $result = [];

        foreach ($data as $keyName => $item){
            foreach ($item as $key => $value){
                $result[$key][$keyName] = $value;
            }
        }

        return $result;
    }
}