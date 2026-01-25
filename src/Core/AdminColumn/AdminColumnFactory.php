<?php

namespace Diconais\Core\AdminColumn;

class AdminColumnFactory
{
    public function create(string $adminColumnName): AbstractAdminColumn
    {
        return new $adminColumnName();
    }
}
