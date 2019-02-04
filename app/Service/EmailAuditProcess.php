<?php

namespace App\Services;

use App\Models\AuditProcess;
use App\Models\ItemAuditProcess;

class EmailAuditProcess
{
    private $request;
    private $emails;
    private $students;

    public function __construct($request, $students, $emails)
    {
        $this->request = $request;
        $this->emails = $emails;
        $this->students = $students;
    }

    // this check which field is being changed, returns to be saved
    private function checkFieldName()
    {
        foreach ($this->request as $key => $r) {
            foreach ($this->emails->getTableColumns() as $e) {
                if ($e === $key) {
                    return $e;
                }
            }
        }
    }

    // this field and current value to be saved
    public function checkBefore()
    {
        foreach ($this->request as $key => $r) {
            foreach ($this->emails->toArray() as $keyEmails => $e) {
                if ($keyEmails === $key) {
                    foreach ([$keyEmails => $e] as $value) {
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
        $process = AuditProcess::where('student_id', $this->students['id'])->get(['id']);

        $processAudit = ItemAuditProcess::create([
                'audit_process_id' => $process[0]->id,
                'user_id' => $this->students->id,
                'field_name' => $this->checkFieldName(),
                'before' => $this->checkBefore(),
                'after' => $this->checkAfter(),
            ]);
    }
}
