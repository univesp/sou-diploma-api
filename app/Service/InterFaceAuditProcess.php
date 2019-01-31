<?php

namespace App\Services;

interface InterFaceAuditProcess
{
    public function checkFieldName();

    public function checkBefore();

    public function checkAfter();

    public function storeSouAudit();
}
