<?php

// routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Job;
use Diglactic\Breadcrumbs\Breadcrumbs;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', '/');
});

// Home > Jobs
Breadcrumbs::for('jobs', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Jobs', route('jobs.index'));
});

// Home > Jobs > [Job]
Breadcrumbs::for('job', function (BreadcrumbTrail $trail, Job $job) {
    $trail->parent('jobs');
    $trail->push($job->title, route('jobs.show', $job));
});

// Home > Jobs > [Job] > Apply
Breadcrumbs::for('apply', function (BreadcrumbTrail $trail, Job $job) {
    $trail->parent('job', $job);
    $trail->push('Apply');
});

// Home > Jobs > [Job] > Apply
Breadcrumbs::for('my-applications', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('My Job Applications');
});

// Home > Employer
Breadcrumbs::for('create-employer', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Create Employer');
});

// My Jobs > Create Job
Breadcrumbs::for('my-jobs', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('My Jobs', route('my-jobs.index'));
});

// My Jobs > Create Job
Breadcrumbs::for('create-job', function (BreadcrumbTrail $trail) {
    $trail->parent('my-jobs');
    $trail->push('Create');
});

Breadcrumbs::for('edit-job', function (BreadcrumbTrail $trail, Job $job) {
    $trail->parent('my-jobs');
    $trail->push($job->title);
    $trail->push('Edit');
});
