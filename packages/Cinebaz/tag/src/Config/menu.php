<?php

return [
    [
        'key' => 'widget',          // uniquely defined key for menu-icon
        'name' => 'Component',        //  name of menu-icon
        'route' => 'add_widget',  // the route for your menu-icon
        'sort' => 2,                    // Sort number on which your menu-icon should display
        'icon-class' => 'catalog-icon',   //class of menu-icon
    ], [
        'key' => 'widget.all',
        'name' => 'All Wedgets',
        'route' => 'all_wedget',
        'sort' => 1,
        'icon-class' => '',
    ], [
        'key' => 'widget.add',
        'name' => 'Add Wedgets',
        'route' => 'add_widget',
        'sort' => 2,
        'icon-class' => '',
    ]
];
