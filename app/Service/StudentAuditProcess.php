<?php

namespace App\Services;

use App\Models\AuditProcess;
use App\Models\ItemAuditProcess;

class StudentAuditProcess
{
    private $request;
    private $students;

    public function __construct($request, $students)
    {
        $this->request = $request;
        $this->students = $students;
    }

    // this check which field is being changed, returns to be saved
    private function checkFieldName()
    {
        foreach ($this->request as $key => $r) {
            foreach ($this->students->getTableColumns() as $student) {
                if ($student === $key) {
                    return $student;
                }
            }
        }
    }

    // this field and current value to be saved
    public function checkBefore()
    {
        foreach ($this->request as $key => $r) {
            foreach ($this->students->toArray() as $keyStudent => $student) {
                if ($keyStudent === $key) {
                    foreach ([$keyStudent => $student] as $value) {
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
