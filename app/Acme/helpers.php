<?php

//generate slug for provided field on provided model
function getSlug($title, $model)
{
    $slug = Str::slug($title);
    $slugCount = count($model::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get());

    return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
}
