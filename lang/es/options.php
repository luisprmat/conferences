<?php

declare(strict_types=1);

return [
    'actions' => [
        'export' => [
            'tooltip' => 'Esto exportará todos los registros visibles en la tabla. Ajuste los filtros para exportar un subconjunto de registros.',
            'count' => 'Exportando :count registros.',
        ],
    ],
    'conference' => [
        'status' => [
            'draft' => 'Borrador',
            'published' => 'Publicado',
            'archived' => 'Archivado',
        ],
    ],
    'talk' => [
        'length' => [
            'lightning' => 'Relámpago - 15 Minutos',
            'normal' => 'Normal - 30 Minutos',
            'keynote' => 'Conferencia de Presentación',
        ],
        'filter' => [
            'all' => 'Todas las charlas',
            'approved' => 'Aprobadas',
            'rejected' => 'Rechazadas',
            'submitted' => 'Enviadas',
        ],
        'notification' => [
            'approved' => [
                'title' => 'Esta charla fue aprobada.',
                'body' => 'Se notificó al conferencista y la charla se agregó al programa de la conferencia.',
            ],
            'rejected' => [
                'title' => 'Esta charla fue rechazada.',
                'body' => 'El conferencista ha sido notificado.',
            ],
        ],
        'status' => [
            'submitted' => 'Enviada',
            'approved' => 'Aprobada',
            'rejected' => 'Rechazada',
        ],
    ],
    'speaker' => [
        'qualifications' => [
            'business_leader' => 'Líder Empresarial',
            'charisma' => 'Orador Carismático',
            'first_time' => 'Primera vez como Orador',
            'hometown_hero' => 'Héroe Local',
            'humanitarian' => 'Trabaja en el Campo Humanitario',
            'laracasts_contributor' => 'Colaborador en Laracasts',
            'twitter_influencer' => 'Gran Seguimiento en Twitter',
            'youtube_influencer' => 'Gran Seguimiento en YouTube',
            'open_source' => 'Creador / Mantenedor de Código Abierto',
            'unique_perspective' => 'Perspectiva Única',
        ],
    ],
];
