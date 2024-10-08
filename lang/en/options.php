<?php

declare(strict_types=1);

return [
    'actions' => [
        'export' => [
            'tooltip' => 'This will export all records visible in the table. Adjust filters to export a subset of records.',
            'count' => 'Exporting :count registers.',
        ],
    ],
    'conference' => [
        'status' => [
            'draft' => 'Draft',
            'published' => 'Published',
            'archived' => 'Archived',
        ],
    ],
    'notifications' => [
        'sign_up_successful' => [
            'title' => 'Success!',
            'body' => 'You have successfully signed up for the conference.',
        ],
    ],
    'talk' => [
        'length' => [
            'lightning' => 'Lightning - 15 Minutes',
            'normal' => 'Normal - 30 Minutes',
            'keynote' => 'Keynote',
        ],
        'filter' => [
            'all' => 'All Talks',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'submitted' => 'Submitted',
        ],
        'notification' => [
            'approved' => [
                'title' => 'This talk was approved',
                'body' => 'The speaker has been notified and the talk has been added to the conference schedule.',
            ],
            'rejected' => [
                'title' => 'This talk was rejected',
                'body' => 'The speaker has been notified.',
            ],
        ],
        'status' => [
            'submitted' => 'Submitted',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
        ],
    ],
    'speaker' => [
        'has_spoken' => [
            'label' => 'Has spoken',
            'yes' => 'Previous Speaker',
            'no' => 'Has Not Spoken',
        ],
        'qualifications' => [
            'business_leader' => 'Business Leader',
            'charisma' => 'Charismatic Speaker',
            'first_time' => 'First Time Speaker',
            'hometown_hero' => 'Hometown Hero',
            'humanitarian' => 'Works in Humanitarian Field',
            'laracasts_contributor' => 'Laracasts Contributor',
            'twitter_influencer' => 'Large Twitter Following',
            'youtube_influencer' => 'Large Youtube Following',
            'open_source' => 'Open Source Creator / Maintainer',
            'unique_perspective' => 'Unique Perspective',
        ],
    ],
    'widgets' => [
        'filters' => [
            'week' => 'Last Week',
            'month' => 'Last Month',
            'last_months' => 'Last :months Months',
        ],
    ],
];
