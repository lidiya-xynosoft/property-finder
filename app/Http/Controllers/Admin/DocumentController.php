<?php

namespace App\Http\Controllers\Admin;

use App\PropertyDocument;
use App\Http\Controllers\Controller;
use App\PropertyAgreement;
use Illuminate\Http\Request;


class DocumentController extends Controller
{

    public function saveUpdateDocument(Request $request)
    {
        $request->validate([
            'document_file' => 'required',
            'property_id' => 'required',
            'document_type_id' => 'required'
        ]);

        if (isset($request['update_id'])) {
            $property = PropertyAgreement::findOrFail($request['update_id']);
            $property_agreement_data = PropertyAgreement::find($request['update_id']);
            $customer_id = $property_agreement_data->customer_id;
        } else {
            // $property_expense = new PropertyExpense();
            if ($request['documents']) {
                foreach ($request['documents'] as $document) {
                    $data =   PropertyDocument::create([
                        'property_id' => $request['property_id'],
                        'document_type_id' => $document['document_type_id'],
                        'file' => $document['document_file'],
                    ]);
                }
            }
            return $data;
        }
    }

    public function destroy($id)
    {   //For Deleting PropertyExpense
        $documents = PropertyDocument::findOrFail($id);
        if ($documents) {
            $documents->delete();
            return response()->json([
                'success' => '1'
            ]);
        } else {
            return response()->json([
                'success' => '0'
            ]);
        }
    }
}