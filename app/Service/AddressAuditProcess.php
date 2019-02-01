<?php

namespace App\Services;

use App\Models\AuditProcess;
use App\Models\ItemAuditProcess;

class AddressAuditProcess
{
    private $request;
    private $students;
    private $identities;

    public function __construct($request, $students, $address)
    {
        $this->request = $request;
        $this->students = $students;
        $this->identities = $address;
    }

    public function storeSouAudit()
    {
        // process is getting the id of the audit processes table
        $process = AuditProcess::where('academic_register', $this->students['academic_register'])->get(['id']);

        $processAudit = ItemAuditProcess::create([
                        'audit_process_id' => $process[0]->id,
                        'user_id' => $this->students->id,
                        'field_name' => $this->checkFieldName(),
                        'before' => $this->checkBefore(),
                        'after' => $this->checkAfter(),
                    ]);
    }

    public function checkFieldName()
    {
        foreach ($this->request as $key => $r) {
            foreach ($this->identities->getTableColumns() as $address) {
                if ($address === $key) {
                    return $address;
                }
            }
        }
    }

    public function checkBefore()
    {
        foreach ($this->request as $key => $r) {
            foreach ($this->identities->toArray() as $keyAddress => $address) {
                if ($keyAddress === $key) {
                    foreach ([$keyAddress => $address] as $value) {
                        return $value;
                    }
                }
            }
        }
    }

    public function checkAfter()
    {
        foreach ($this->request as $fieldName) {
            return $fieldName;
        }
    }
}
