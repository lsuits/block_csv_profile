<?php
$capabilities = array(
    'block/csv_profile:uploadcsv' => array(
        'riskbitmask'  => RISK_PERSONAL | RISK_MANAGETRUST,
        'captype'      => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes'   => array(
            'manager'          => CAP_ALLOW
        )
    ),
    'block/csv_profile:addinstance' => array(
        'riskbitmask'  => RISK_PERSONAL | RISK_MANAGETRUST,
        'captype'      => 'write',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes'   => array(
            'manager'          => CAP_ALLOW
        )
    ),
    'block/csv_profile:myaddinstance' => array(
        'riskbitmask'  => RISK_PERSONAL | RISK_MANAGETRUST,
        'captype'      => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes'   => array(
            'manager'          => CAP_ALLOW
        )
    )	
);
