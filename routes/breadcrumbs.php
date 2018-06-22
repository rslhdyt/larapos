<?php

// Dashboard
Breadcrumbs::register('dashboard.index', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('dashboard.index'));
});

// Product
Breadcrumbs::register('products.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Products', route('products.index'));
});

Breadcrumbs::register('products.trash', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Trashed Products', route('products.trash'));
});

Breadcrumbs::register('products.create', function ($breadcrumbs) {
    $breadcrumbs->parent('products.index');
    $breadcrumbs->push('Create', route('products.create'));
});

Breadcrumbs::register('products.show', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('products.index');
    $breadcrumbs->push('Show', route('products.show', $product));
});

Breadcrumbs::register('products.edit', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('products.index');
    $breadcrumbs->push('Edit', route('products.edit', $product));
});
