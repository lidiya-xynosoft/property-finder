<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Property;
use App\PropertyAgreement;
use App\PropertyCustomer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class AgreementManageController extends Controller
{
    public function index(Request $request)
    {
        $data = array();
        $premises = DB::table('premises')->get();
        $data['premises'] = $premises;
        if ($request->has('update_id')) {
            $update_id = $request->get('update_id');
            // $update_id = decript($encrypt_update_id);
            if (!$update_id) {
                $flash = array('type' => 'error', 'msg' => 'Invalid Request');
                $request->session()->flash('flash', $flash);
                return redirect()->back();
            } else {
                $update_data = DB::table('property_agreement')->where('id', '=', $update_id)->first();
                $data['update_data'] = $update_data;
                $data['update_id'] = $update_id;
            }
        }

        return view('admin.agreement.create-agreement')->with($data);
    }

    public function listAllAgreement(Request $request)
    {

        $data['agreement'] = DB::table('property_agreement')->get();

        return view('admin.agreement.list-all-agreement')->with($data);
    }

    public function saveUpdateAgreement(Request $request)
    {
        $request->validate([
            'agreement_number' => 'required',
            'property_id' => 'required',
            'tenant_name' => 'required',
            'tenant_no' => 'required',
            'po_box' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'unit_no' => 'required',
            'building_name_english' => 'required',
            'unit_type_english' => 'required',
            'electricity_no' => 'required',
            'water_no' => 'required',
            'location_english' => 'required',
            'lease_period' => 'required',
            'lease_commencement' => 'required',
            'lease_expiry' => 'required',
            'monthly_rent' => 'required',
            'utilities' => 'required',
            'payment_mode' => 'required',
            'security_deposit' => 'required',
            'payment_commencement' => 'required',
            'rent_free' => 'required',
        ]);

        $no_of_check = $request->input('no_of_dated_check');

        if ($request->input('payment_mode') == 'post_dated_check') {
            $no_of_check = trim($request->input('no_of_dated_check'));

            $mode_value = $no_of_check . ' Post dated check';
        } else {
            $mode_value = $request->input('payment_mode');
        }
        if (isset($request['update_id'])) {
            $property = PropertyAgreement::findOrFail($request['update_id']);
            $property_agreement_data = PropertyAgreement::find($request['update_id']);
            $customer_id = $property_agreement_data->customer_id;
        } else {
            $property = new PropertyAgreement();
            $user = User::create([
                'name'      => $request->input('tenant_name'),
                'email'     => $request->input('email'),
                'password'  => Hash::make($request->input('tenant_name')),
                'username'  => $request->input('tenant_name'),
                'role_id'   => '3',
                'country_id' => '98',
                'contact_no' => $request->input('phone'),
            ]);
            $customer = Customer::create([
                'user_id' => $user->id,
                'name' => trim($request->input('tenant_name')),
                'name_arabic' => trim($request->input('tenant_name_arabic')),
                'tenant_no' => trim($request->input('tenant_no')),
                'po_box' => $request->input('po_box'),
                'phone' => trim($request->input('phone')),
                'email' => trim($request->input('email')),
            ]);
            $customer_id = $customer->id;
        }


        // $ins_data = array(
        //     'agreement_id' => trim($request->input('agreement_number')),
        //     'property_id' => $request->input('property_id'),
        //     'customer_id' => $customer->id,
        //     'tenant_name' => trim($request->input('tenant_name')),
        //     'tenant_name_arabic' => trim($request->input('tenant_name_arabic')),
        //     'tenant_no' => trim($request->input('tenant_no')),
        //     'po_box' => trim($request->input('po_box')),
        //     'phone' => trim($request->input('phone')),
        //     'email' => trim($request->input('email')),
        //     'unit_no' => trim($request->input('unit_no')),
        //     'unit_no_arabic' => $request->input('unit_no_arabic'),
        //     'building_name_english' => trim($request->input('building_name_english')),
        //     'building_name_arabic' => trim($request->input('building_name_arabic')),
        //     'unit_type_english' => trim($request->input('unit_type_english')),
        //     'unit_type_arabic' => trim($request->input('unit_type_arabic')),
        //     'electricity_no' => trim($request->input('electricity_no')),
        //     'water_no' => trim($request->input('water_no')),
        //     'location_english' => trim($request->input('location_english')),
        //     'lease_period' => trim($request->input('lease_period')),
        //     'lease_commencement' => trim($request->input('lease_commencement')),
        //     'lease_expiry' => trim($request->input('lease_expiry')),
        //     'lease_period_arabic' => trim($request->input('lease_period_arabic')),
        //     'lease_commencement_arabic' => trim($request->input('lease_commencement_arabic')),
        //     'lease_expiry_arabic' => trim($request->input('lease_expiry_arabic')),
        //     'monthly_rent' => trim($request->input('monthly_rent')),
        //     'utilities' => trim($request->input('utilities')),
        //     'payment_mode' => $mode_value,
        //     'payment_mode_arabic' => $request->input('post_dated_check_value_arabic'),
        //     'security_deposit' => trim($request->input('security_deposit')),
        //     'rent_payment_commencement' => trim($request->input('payment_commencement')),
        //     'monthly_rent_arabic' => trim($request->input('monthly_rent_arabic')),
        //     'utilities_arabic' => trim($request->input('utilities_arabic')),
        //     'payment_mode_arabic' => $mode_value,
        //     'security_deposit_arabic' => trim($request->input('security_deposit_arabic')),
        //     'rent_payment_commencement_arabic' => trim($request->input('payment_commencement_arabic')),
        //     'rent_free' => trim($request->input('rent_free')),
        //     'is_draft' => '1',
        //     'is_published' => false,
        // );
        // $agreement = PropertyAgreement::create([$ins_data]);

        $property->agreement_id = trim($request->input('agreement_number'));
        $property->property_id = $request->input('property_id');
        $property->customer_id = $customer_id;
        $property->tenant_name = trim($request->input('tenant_name'));
        $property->tenant_name_arabic = trim($request->input('tenant_name_arabic'));
        $property->tenant_no = trim($request->input('tenant_no'));
        $property->po_box = trim($request->input('po_box'));
        $property->phone = trim($request->input('phone'));
        $property->email = trim($request->input('email'));
        $property->unit_no = trim($request->input('unit_no'));
        $property->unit_no_arabic = $request->input('unit_no_arabic');
        $property->building_name_english = trim($request->input('building_name_english'));
        $property->building_name_arabic = trim($request->input('building_name_arabic'));
        $property->unit_type_english = trim($request->input('unit_type_english'));
        $property->unit_type_arabic = trim($request->input('unit_type_arabic'));
        $property->electricity_no = trim($request->input('electricity_no'));
        $property->water_no = trim($request->input('water_no'));
        $property->location_english = trim($request->input('location_english'));
        $property->location_arabic = trim($request->input('location_arabic'));
        $property->zone = trim($request->input('zone'));
        $property->street = trim($request->input('street'));
        $property->building_no = trim($request->input('building_no'));
        $property->lease_period = trim($request->input('lease_period'));
        $property->lease_commencement = trim($request->input('lease_commencement'));
        $property->lease_expiry = trim($request->input('lease_expiry'));
        $property->lease_period_arabic = trim($request->input('lease_period_arabic'));
        $property->lease_commencement_arabic = trim($request->input('lease_commencement_arabic'));
        $property->lease_expiry_arabic = trim($request->input('lease_expiry_arabic'));
        $property->monthly_rent = trim($request->input('monthly_rent'));
        $property->utilities = trim($request->input('utilities'));
        $property->payment_mode = $mode_value;
        $property->payment_mode_arabic = $request->input('post_dated_check_value_arabic');
        $property->security_deposit = trim($request->input('security_deposit'));
        $property->rent_payment_commencement = trim($request->input('payment_commencement'));
        $property->monthly_rent_arabic = trim($request->input('monthly_rent_arabic'));
        $property->utilities_arabic = trim($request->input('utilities_arabic'));
        $property->payment_mode_arabic = $mode_value;
        $property->security_deposit_arabic = trim($request->input('security_deposit_arabic'));
        $property->rent_payment_commencement_arabic = trim($request->input('payment_commencement_arabic'));
        $property->rent_free = trim($request->input('rent_free'));
        $property->is_draft = '1';
        $property->is_published = false;
        $property->save();

        $flash = array('type' => 'success', 'msg' => 'Agreement created successfully.');
        $request->session()->flash('flash', $flash);
        $agreement = PropertyAgreement::where('id', $property->id)
            ->where('is_draft', true)
            ->where('is_published', false)
            ->first();
        $property = Property::find($request->input('property_id'));
        if (isset($request['update_id'])) {
            $flash = array('type' => 'success', 'msg' => 'agreement Updated successfully.');
        } else {
            $flash = array('type' => 'success', 'msg' => 'agreement created successfully.');
        }
        session()->flash('flash', $flash);
        return view('admin.agreement.preview-agreement', compact('agreement', 'property'));
    }

    public function getPremisesDetailsByID(Request $request)
    {
        $premise_id = $request->premise_id;
        if ($request->premise_id) {
            $premisesDetails = DB::table('premises')->where('unit_no', '=', $premise_id)->first();
            if ($premisesDetails) {
                return response([
                    'building_name_english' => $premisesDetails->building_name_english,
                    'building_name_arabic' => $premisesDetails->building_name_arabic,
                    'unit_type_english' => $premisesDetails->unit_type_english,
                    'unit_type_arabic' => $premisesDetails->unit_type_arabic,
                    'electricity_no' => $premisesDetails->electricity_no,
                    'water_no' => $premisesDetails->water_no,
                    'location_english' => $premisesDetails->location_english,
                    'location_arabic' => $premisesDetails->location_arabic,
                    'utilities' => $premisesDetails->utilities,
                    'unit_no_arabic' => $premisesDetails->unit_no_arabic,
                    'success' => 1,
                ]);
            } else {
                return response([
                    'success' => 0,
                ]);
            }
        }
    }

    public function generate_pdf(Request $request)
    {
        $agreement = PropertyAgreement::where('id', $request->agreement_id)->first();
        $mpdf = new \Mpdf\Mpdf();
        $invoice_pdf_footer = "AL JAZI REAL ESTATE";

        $header = '<table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: Nunito; font-size: 8pt; color: #000000;"><tr>
        <td  align="center" style="font-style: italic;"></td>
        </tr></table>';
        $footer = '<table width="100%" style="border-top: 1px solid; vertical-align: bottom; font-family: Nunito; font-size: 8pt; color: #000000;"><tr>
		<td  align="center" style="font-style: italic;">' . $invoice_pdf_footer . '</td>
		</tr></table>';
        //  $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLFooter($footer);

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->shrink_tables_to_fit = 1;

        $mpdf->SetJS('this.print();');

        $img = url('/img/pdf/header.jpg');
        // // $stylesheet = file_get_contents($css);
        // // $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

        $html = '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>';
        $html .= '<body style="font-family:Arial, Helvetica, sans-serif;font-size:16px"><main><div
            style="max-width: 1200px; width: 100%;padding-right: var(--bs-gutter-x,15px);padding-left: var(--bs-gutter-x,15px);margin-right: auto;margin-left: auto;">
            <div><h3 style="text-align: center;"><b>LEASE AGREEMENT عقد الإيجار</b></h3>
            </div>';
        $html .= ' <table style="border-collapse: collapse;width: 100%;padding-bottom: 10px;">
                <tr>
                    <td style="text-align: left;padding-bottom:5px;font-size: 12px;"><b>PART A</b></td>
                    <td style="text-align:center;text-align: left;padding-bottom:10px;">&nbsp;&nbsp;</td>
                    <td style="text-align: right;direction:rtl;padding-bottom:5px;font-size: 12px;font-weight:bold">الجزء أ</td>

                </tr>
                <tr>
                    <td style="text-align: left;padding-bottom:15px;font-size: 12px;"><b>PARTICULARS OF THE CONTRACT</b></td>
                    <td style="text-align:center;text-align: left;">&nbsp;&nbsp;</td>
                    <td style="text-align: right;direction:rtl;padding-bottom:15px;font-size: 12px;font-weight:bold">تفاصيل العقد</td>

                </tr>

                <tr>
                    <td style="text-align: left;padding-bottom:5px;font-size: 12px;"><U><b>1. THE PARTIES:</b></U></td>
                    <td style="text-align:center;text-align: left;">&nbsp;&nbsp;</td>
                    <td style="text-align: right;direction:rtl;padding-bottom:5px;font-size: 12px;font-weight:bold">1. الأطراف:</td>

                </tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td style="text-align: left;padding-bottom:5px;font-size: 12px;"><b>LANDLORD DETAILS</b></td>
                    <td style="text-align:center;text-align: left;">&nbsp;&nbsp;</td>
                    <td style="text-align: right;direction:rtl;padding-bottom:5px;font-size: 12px;font-weight:bold">تفاصيل المالك</td>

                </tr>
            </table>';
        $html .= ' <table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;padding-bottom: 10px;">
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Name:</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">Al Jazi Real Estate
                        Investment / الجازي للاستثمار
                        العقاري
                    </td>
                    <td style="direction:rtl;text-align:end;border: 1px solid;padding: 5px;font-size: 16px;font-weight:bold">اسم</td>

                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">P O Box No:</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">22880</td>
                    <td style="direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">صندوق بريد
                    </td>

                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Telephone:</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">+974 4483 3706/8786</td>
                    <td style="direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">هاتف</td>

                </tr>
            </table><br/>';
        $html .= '  <table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;padding-bottom: 10px;">
                <tr>
                    <td style="text-align: left;padding-bottom:5px;font-size: 12px;"><b>TENANT DETAILS</b></td>
                    <td style="text-align:center;text-align: left;padding-bottom:10px;">&nbsp;&nbsp;</td>
                    <td style="text-align:right;direction:rtl;padding-bottom:5px;font-size: 12px;font-weight:bold"><b>تفاصيل المستأج</b>
                    </td>
                </tr>
            </table>';
        $html .= ' <table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;padding-bottom: 10px;">
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Name</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">' . $agreement->tenant_name . '</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">' .
            $agreement->tenant_name_arabic . '</td>
                    <td style="direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">اسم</td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">QID/C.R. NO</td>
                    <td colspan="2" style="border: 1px solid;text-align: center;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->tenant_no . '
                    </td>
                    <td style="text-align:right;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">QID / C.R. رقم
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">P.O BOX </td>
                    <td colspan="2" style="border: 1px solid;text-align: center;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->po_box . '
                    </td>
                    <td style="text-align:right;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">صندوق بريد
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">TELEPHONE</td>
                    <td colspan="2" style="border: 1px solid;text-align: center;padding: 5px;font-size: 12px;font-weight:bold"> ' . $agreement->phone . '
                    </td>
                    <td style="direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">هاتف</td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Email Address</td>
                    <td colspan="2" style="border: 1px solid;text-align: center;padding: 5px;font-size: 12px;font-weight:bold"> ' . $agreement->email . '
                    </td>
                    <td style="direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">عنوان البريد
                        الالكترونى</td>
                </tr>
            </table><br/>';
        $html .= '  <table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;padding-bottom: 10px;">
                <tr>
                    <td style="text-align: left;padding-bottom:5px;font-size: 12px;"><b><u>2. PREMISES DETAILS:</u></b></td>
                    <td style="text-align:center;padding-bottom:10px;">&nbsp;&nbsp;</td>
                    <td style="text-align:right;direction:rtl;padding-bottom:5px;font-size: 12px;"><b><u>2. تفاصيل أماكن
                            الإقامة:</u></b></td>
                </tr>
            </table>';
        $html .= '   <table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;padding-bottom: 10px;">
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Building Name</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->building_name_english . '</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->building_name_arabic . '</td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">اسم
                        المبنى
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Unit No</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->unit_no . '</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->unit_no . '</td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">رقم
                        الوحدة
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Unit Type</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->unit_type_english . '</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->unit_type_arabic . '</td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">نوع
                        الوحدة
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Electricity No</td>
                    <td colspan="2" style="border: 1px solid;text-align: center;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->electricity_no . '</td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">الكهرباء
                        لا
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Water No</td>
                    <td colspan="2" style="border: 1px solid;text-align: center;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->water_no . '
                    </td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">ماء لا
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Location</td>
                    <td colspan="2" style="border: 1px solid;text-align: center;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->location_english . '
                    </td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">موقع</td>
                </tr>

            </table><br/>';
        $html .= '    <table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;padding-bottom: 10px;">
                <tr>
                    <td style="text-align: left;padding-bottom:5px;font-size: 12px;"><b><u>3. LEASE TERMS:</u></b></td>
                    <td style="text-align:center;text-align: left;padding-bottom:10px;">&nbsp;&nbsp;</td>
                    <td style="text-align:right;direction:rtl;padding-bottom:5px;font-size: 12px;"><b><u>3. شروط
                            الإيجار:</u></b></td>
                </tr>
            </table>';
        $html .= '   <table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;padding-bottom: 10px;">
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Lease Period:</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->lease_period . '</td>
                    <td style="text-align:center;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->lease_period_arabic . '</td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">فترة
                        الإيجار
                    </td>

                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Lease Commencement:</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->lease_commencement . '</td>
                    <td style="text-align:center;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->lease_commencement_arabic . '</td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">بدء عقد
                        الإيجار</td>

                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Lease Expiry:</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->lease_expiry . '</td>
                    <td style="text-align:center;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->lease_expiry_arabic . '</td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">انتهاء
                        عقد
                        الإيجار</td>

                </tr>
            </table><br />';
        $html .= '  <table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;padding-bottom: 10px;">
                <tr>
                    <td style="text-align: left;padding-bottom:5px;font-size: 12px;"><b><u>4. FINANCIAL TERMS: </u></b></td>
                    <td style="text-align:center;text-align: left;padding-bottom:10px;">&nbsp;&nbsp;</td>
                    <td style="text-align:right;direction:rtl;padding-bottom:5px;font-size: 12px;"><b><u>4. الشروط
                            المالية:</u></b></td>
                </tr>
            </table>';
        $html .= '   <table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;padding-bottom: 10px;">
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Monthly Rent</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->monthly_rent . '</td>
                    <td style="text-align:center;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->monthly_rent_arabic . '</td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">الإيجار
                        الشهري</td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Utilities</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->utilities . '</td>
                    <td style="text-align:center;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->utilities_arabic . '</td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">خدمات
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Mode of Payment</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->payment_mode . '</td>
                    <td style="text-align:center;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->payment_mode_arabic . '</td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">طريقة
                        الدفع
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Security Deposit</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->security_deposit . '</td>
                    <td style="text-align:center;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->security_deposit_arabic . '</td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">مبلغ
                        التأمين
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Rent Payment Commencement</td>
                    <td style="text-align:center;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->rent_payment_commencement . '</td>
                    <td style="text-align:center;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->rent_payment_commencement_arabic . '
                    </td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">بدء سداد
                        الإيجار</td>
                </tr>
                <tr>
                    <td style="border: 1px solid;padding: 5px;font-size: 12px;">Rent Free</td>
                    <td colspan="2" style="border: 1px solid;text-align: center;padding: 5px;font-size: 12px;font-weight:bold">
                        ' . $agreement->rent_free . '</td>
                    <td style="text-align:end;direction: rtl;border: 1px solid;padding: 5px;font-size: 12px;font-weight:bold">إيجار
                        مجاني
                    </td>
                </tr>

            </table>';
        $html .= '</div></main></body></html>';
        // $mpdf->imageVars['myvariable'] = file_get_contents($img);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
        // $mpdf->Image('var:myvariable', 0, 0);

        $mpdf->showImageErrors = true;
        $mpdf->debug = true;
        $mpdf->Output();

        // $pdf = PDF::loadView('dynamic-pdf', $data);

        // return $pdf->stream($data['agreement']->tenant_name . ' - Lease Agreement');

    }

    public function deleteAgreementById(request $request)
    {

        if ($request->has('id')) {

            $where = array(
                'id' => $request->input('id'),
            );
            $getCurrentdataQry = DB::table('property_agreement')->where($where);
            if ($getCurrentdataQry->count() > 0) {

                $action = DB::table('property_agreement')->where($where)->delete();
                if ($action) {
                    $flash = array('type' => 'success', 'msg' => 'Deleted Successfully!');
                    $request->session()->flash('flash', $flash);
                    return redirect()->back();
                } else {
                    $flash = array('type' => 'success', 'msg' => 'Something went wrong!');
                    $request->session()->flash('flash', $flash);
                    return redirect()->back();
                }
            } else {
                $flash = array('type' => 'success', 'msg' => 'Something went wrong!');
                $request->session()->flash('flash', $flash);
                return redirect()->back();
            }
        }
    }

    public function publishPreviewedAgreement(Request $request)
    {
        if ($request->has('list_id')) {
            $id = $request->input('list_id');
        } else {
            $id = $request->input('agreement_row_id');
            $ins_data = array(
                // 'tenant_name_arabic' => $request->input('tenant_name_arabic'),
                'is_draft' => false,
                'is_published' => true,
            );
            // $PropertyCustomer = PropertyCustomer::create([
            //     'property_id' => PropertyAgreement::find($id)->property_id,
            //     'property_agreement_id' => $id,
            //     'customer_id' => PropertyAgreement::find($id)->customer_id,
            // ]);
            PropertyAgreement::where('id', $id)->update($ins_data);
        }

        $data['agreement'] =
            PropertyAgreement::where('id', $id)->first();
        if ($request->has('list_id')) {
            return view('admin.agreement.preview-agreement')->with($data);
        } else {
            return response([
                'success' => 1,
            ]);
        }
    }
    public function signAgreement(Request $request)
    {
        $agreement_id = $request['agreement_id'];
        $property_id = $request['property_id'];

        PropertyAgreement::whereId($agreement_id)->update(['is_signed' => 1]);
        $PropertyCustomer = PropertyCustomer::create([
            'property_id' => $property_id,
            'property_agreement_id' => $agreement_id,
            'customer_id' => PropertyAgreement::find($agreement_id)->customer_id,
            'start_date' => Carbon::parse(PropertyAgreement::find($agreement_id)->lease_commencement)->format('Y-m-d'),
            'end_date' => Carbon::parse(PropertyAgreement::find($agreement_id)->lease_expiry)->format('Y-m-d'),
            'date' => Carbon::now()->toDateString(),
            'time' => Carbon::now()->format('H:i:s'),
            'rent_date'  => PropertyAgreement::find($agreement_id)->rent_payment_commencement,
            'status' => '1'
        ]);
        if ($PropertyCustomer) {
            return response([
                'success' => 1,
                'customer' => Customer::find(PropertyAgreement::find($agreement_id)->customer_id)->name,
                'duration' => PropertyAgreement::find($agreement_id)->lease_period,
                'expiry' => PropertyAgreement::find($agreement_id)->lease_expiry,
                'rent_date'  => PropertyAgreement::find($agreement_id)->rent_payment_commencement,
            ]);
        } else {
            return response([
                'success' => 0,
            ]);
        }
    }
}