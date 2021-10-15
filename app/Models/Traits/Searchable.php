<?php

namespace App\Models\Traits;


trait Searchable {

     public static function search($queryStr) {

        $query = self::where(self::$searchable[0], 'like' ,'%'.$queryStr.'%');

        $orWheres = collect(array_slice(self::$searchable, 1));

        $query = $orWheres->reduce(function($carry, $item) use ($queryStr) {
            return $carry->orWhere($item, 'like','%'.$queryStr.'%');
        }, $query);

        return self::$resourceClass::collection(
            $query->get()
        );
    }

}
