<?php

namespace App\Services;

class EmailAuditProcess
{
    private $request;
    private $emails;

    public function __construct($request, $emails)
    {
        $this->request = $request;
        $this->emails = $emails;
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
