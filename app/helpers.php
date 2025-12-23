<?php

if (!function_exists('hasAccess')) {
    /**
     * Check if user has access to a specific module based on department
     *
     * @param string $module
     * @param string|null $department
     * @return bool
     */
    function hasAccess(string $module, ?string $department): bool
    {
        if (!$department) {
            return false;
        }

        // Define access permissions per department
        $permissions = [
            'admin' => ['customer', 'part', 'petugas', 'kendaraan', 'po', 'suratjalan'],
            'sales' => ['customer', 'po', 'suratjalan'],
            'warehouse' => ['part', 'kendaraan', 'suratjalan'],
            'hr' => ['petugas'],
            'management' => ['customer', 'part', 'petugas', 'kendaraan', 'po', 'suratjalan'],
        ];

        $department = strtolower($department);

        return isset($permissions[$department]) && in_array($module, $permissions[$department]);
    }
}