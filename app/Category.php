<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const PAGINATE_LIMIT = 5;
    protected $fillable = [
        'name',
        'description',
        'slug',
    ];
    /**
     * Return categories view
     *
     * @param obj $categories
     * @return string
     */
    public static function showCategories($categories, $cateSelected = null)
    {
        if ($categories) {
            $html = '';
            foreach ($categories as $category) {
                $html .= "<option";
                if ($category->id == $cateSelected) {
                    $html .= ' selected';
                };
                $html .= " value='" . $category->id . "' >$category->name</option>";
            }
            return $html;
        }
    }
}