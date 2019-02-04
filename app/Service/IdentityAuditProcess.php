<?php

namespace App\Services;

use App\Models\AuditProcess;
use App\Models\ItemAuditProcess;

class IdentityAuditProcess
{
    private $request;
    private $students;
    private $identity;

    public function __construct($request, $students, $identity)
    {
        $this->identity = $identity;
        $this->request = $request;
        $this->students = $students;
    }

    // this check which field is being changed, returns to be saved
    public function checkFieldName()
    {
        foreach ($this->request as $key => $r) {
            foreach ($this->identity->getTableColumns() as $i) {
                if ($i === $key) {
                    return $i;
                }
            }
        }
    }

    // this field and current value to be saved
    public function checkBefore()
    {
        foreach ($this->request as $key => $r) {
            foreach ($this->identity->toArray() as $keyIdentity => $i) {
                if ($keyIdentity === $key) {
                    foreach ([$keyIdentity => $i] as $value) {
                        return $value;
                    }
                }
            }
        }
    }

    // get the value being updated.
    private function checkAfter()
    {
        foreach ($this->request as $fieldName) {
            return $fieldName;
        }
    }

    // process is getting the id of the audit processes table
    public function storeSouAudit()
    {
        $process = AuditProcess::where('academic_register', $this->students['academic_register'])->get(['id']);

        $processAudit = ItemAuditProcess::create([
                'audit_process_id' => $process[0]->id,
                'user_id' => $this->students->id,
                'field_name' => $this->checkFieldName(),
                'before' => $this->checkBefore(),
                'after' => $this->checkAfter(),
            ]);
    }
}
