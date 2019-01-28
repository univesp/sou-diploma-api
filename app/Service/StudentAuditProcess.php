<?php

namespace App\Services;

use App\Models\ItemAuditProcess;

class StudentAuditProcess
{
    public function index()
    {
        $index = ItemAuditProcess::all();

        return $index->auditProcess();
    }

    public function store($request, $student)
    {
    }
}
