<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Application
Breadcrumbs::for('#', function (BreadcrumbTrail $trail) {
    $trail->push('Application', '/');
});

// Application > User
Breadcrumbs::for('admin.user', function (BreadcrumbTrail $trail) {
    $trail->parent('#');
    $trail->push('User', route('admin.user'));
});

// Application > Role
Breadcrumbs::for('admin.role', function (BreadcrumbTrail $trail) {
    $trail->parent('#');
    $trail->push('Role', route('admin.role'));
});

// Application > Topic
Breadcrumbs::for('admin.topic', function (BreadcrumbTrail $trail) {
    $trail->parent('#');
    $trail->push('Topic', route('admin.topic'));
});

// Application > Question
Breadcrumbs::for('admin.question', function (BreadcrumbTrail $trail) {
    $trail->parent('#');
    $trail->push('Question', route('admin.question'));
});

// Application > Quiz User
Breadcrumbs::for('admin.quiz_user', function (BreadcrumbTrail $trail) {
    $trail->parent('#');
    $trail->push('Quiz User', route('admin.quiz_user'));
});

// Application > Result
Breadcrumbs::for('admin.result', function (BreadcrumbTrail $trail) {
    $trail->parent('#');
    $trail->push('Result', route('admin.result'));
});
