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
            'property_agreement_id' => 'required',
        ]);

        if (isset($request['update_id'])) {
            $property = PropertyAgreement::findOrFail($request['update_id']);
            $property_agreement_data = PropertyAgreement::find($request['update_id']);
            $customer_id = $property_agreement_data->customer_id;
        } else {
            // $property_expense = new PropertyExpense();
            // if ($request['documents']) {
            $file_name = null;
            // foreach ($request['documents'] as $key => $document) {
            if ($request->hasFile('document_file')) {
                $rules['document_file'] = 'required|mimes:jpg,jpeg,pdf,doc,docx|max:5009';
                $request->validate($rules);
                $file = $request->file('document_file');
                $destinationPath = 'property/documents';
                $extension = $file->getClientOriginalExtension();;
                $fileName = time() . '.' . $extension;
                $uploadSuccess = $file->storeAs($destinationPath, $fileName, 'public');
                $file_name = $destinationPath . '/' . $fileName;
                $data =   PropertyDocument::create([
                    'property_id' => $request['property_id'],
                    'document_type_id' => $request['document_type_id'],
                    'property_agreement_id' => $request['property_agreement_id'],
                    'file' => $file_name,
                ]);
                // } else {
                //     $data = null;
                // }
            }
            // }

            $flash = array('type' => 'success', 'msg' => 'Document created successfully.');
            session()->flash('flash', $flash);
            return back();
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