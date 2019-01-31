<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\ModelsAuthentication\Address;
use App\ModelsAuthentication\Student;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return address list with paginate
        return $address = Address::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find students by id
        $students = Student::find($id);

        // Validation if students exists
        if ($students) {
            // Return address by students
            return $address = Address::find($students->address_id);
        } else {
            // Return error messages
            return response()->json([
                'errors' => [
                'message' => 'Endereço não encontrado.',
                ],
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {
        // Find students by id
        $students = Student::find($id);

        // Find address id by students
        $address = Address::find($students->address_id);

        // Validation if address exists
        if ($address) {
            // Update al request of address
            $address->update($request->all());

            // Return success messages
            $return = ['data' => ['status' => true, 'msg' => 'Endereço atualizado com sucesso.'], 200];

            return response()->json($return);
        } else {
            // Return error messages
            $return = ['data' => ['status' => false, 'msg' => 'Houve um erro ao atualizar o Endereço.'], 404];

            return response()->json($return);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
