<?php


if (!function_exists('is_seo')) {
    function is_seo()
    {

        return true;
    }
}


if (!function_exists('phpslug')) {
    function phpslug($string)
    {
        $slug = preg_replace('/[-\s]+/', '-', strtolower(trim($string)));
        return $slug;
    }
}

if (!function_exists('dynamicslug')) {
    function dynamicslug(array $options)
    {
        $default = [
            'slug' => null,
            'table' => null,
            'column' => 'slug',
            'id' => null,
        ];
        $search = array_merge($default, $options);
        $slug = phpslug($search['slug']);
        $data = DB::table($search['table'])->where($search['column'], 'like', $slug . '%');

        if ($search['id']) {
            $data = $data->where('id', '!=', $search['id']);
        }
        $data = $data->get();
        if (!$data->contains($search['column'], $slug)) {

            return $slug;
        }
        $count = count($data) + 1;

        for ($i = 1; $i <= $count; $i++) {
            $newSlug = $slug . '-' . $i;

            if (!$data->contains($search['column'], $newSlug)) {
                return $newSlug;
            }
        }
    }
}
