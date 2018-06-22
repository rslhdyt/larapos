<?php

// Dashboard
Breadcrumbs::register('dashboard.index', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('dashboard.index'));
});

// Supplier
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

// Supplier
Breadcrumbs::register('suppliers.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Suppliers', route('suppliers.index'));
});

Breadcrumbs::register('suppliers.trash', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Trashed Suppliers', route('suppliers.trash'));
});

Breadcrumbs::register('suppliers.create', function ($breadcrumbs) {
    $breadcrumbs->parent('suppliers.index');
    $breadcrumbs->push('Create', route('suppliers.create'));
});

Breadcrumbs::register('suppliers.show', function ($breadcrumbs, $supplier) {
    $breadcrumbs->parent('suppliers.index');
    $breadcrumbs->push('Show', route('suppliers.show', $supplier));
});

Breadcrumbs::register('suppliers.edit', function ($breadcrumbs, $supplier) {
    $breadcrumbs->parent('products.index');
    $breadcrumbs->push('Edit', route('products.edit', $supplier));
});
