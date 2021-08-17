<?php

return [

    /**
     * --------------------------------------------------------
     * Hooks
     * --------------------------------------------------------
     * 
     * System hooks configuration
     * 
     */
    'hooks' => [

        /**
         * ----------------------------------------------------
         * Paths
         * ----------------------------------------------------
         * 
         * Paths that should be scanned for hooks
         *
         */
        'paths' => [],

        /**
         * ----------------------------------------------------
         * Hooks
         * ----------------------------------------------------
         * 
         * Direct hooks classes configuration
         *
         */
        'hooks' => [],

        /**
         * ----------------------------------------------------
         * Resolvers
         * ----------------------------------------------------
         * 
         * Hooks resolvers. They are used to load hooks.
         * 
         */
        'resolvers' => [
            \Pipes\Stream\HookResolvers\LocalResolver::class,
            \Pipes\Stream\HookResolvers\ConfigResolver::class,
        ]
    ]
];
