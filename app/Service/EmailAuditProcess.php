<?php

namespace App\Services;

class EmailAuditProcess implements InterFaceAuditProcess
{
    public function __construct($request, $students)
    {
        dd($this->request = $request);
        $this->request = $request;
        $this->students = $students;
    }

    // process is getting the id of the audit processes table
    public function storeSouAudit()
    {
    }

    // this check which field is being changed, returns to be saved
    public function checkFieldName()
    {
    }

    // this field and current value to be saved
    public function checkBefore()
    {
    }

    // get the value being updated.
    private function checkAfter()
    {
    }
}
