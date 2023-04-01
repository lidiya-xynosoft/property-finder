@extends('backend.layouts.app')
@section('title', 'Preview Agreement')
@push('head')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/dist/css/select2.min.css') }}">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: end;
        }

        @media (min-width: 768px) {
            .container {
                width: 100%;
            }
        }

        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        h5 {
            margin: 5px;
            font-size: 15px;
            font-weight: normal;
            color: #212121;
            padding-top: 10px;
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="container">
                        <div class="textarea">
                            <div class="sdmn" style="display: flex;justify-content: space-between;">

                                <h5>PART A</h5>
                                <h5>الجزء أ</h5>

                            </div>
                            <div class="sdmn" style="display: flex;justify-content: space-between;">

                                <h5>PARTICULARS OF THE CONTRACT</h5>
                                <h5>تفاصيل العقد</h5>

                            </div>
                            <br>
                            <div class="sdmn" style="display: flex;justify-content: space-between;">
                                <h5><U>1. THE PARTIES</U></h5>
                                <h5><U>1. الأطراف</U></h5>

                            </div>
                            <h5>LANDLORD DETAILS</h5>
                        </div>

                        <table style="width:100%">
                            <tr>
                                <td>Name:</td>
                                <td class="text-center">{{ $settings->name }}ي</td>
                                <td class="text-right">اسم</td>

                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td class="text-center">{{ $settings->address }}</td>
                                <td class="text-right">صندوق بريد</td>

                            </tr>
                            <tr>
                                <td>Telephone:</td>
                                <td class="text-center">{{ $settings->phone }}</td>
                                <td class="text-right">هاتف</td>

                            </tr>
                        </table>

                        <div class="sdmn" style="display: flex;justify-content: space-between;">
                            <h5> TENANT DETAILS</h5>
                            <h5 class="text-right">تفاصيل المستأجر</h5>

                        </div>
                        <table style="width:100%">
                            <tr>
                                <td>Name</td>
                                <td class="text-center">{{ $agreement->tenant_name }}</td>
                                <td class="text-center" id="tenant_name_arabic" contenteditable="true">
                                    {{ $agreement->tenant_name }}</td>
                                <td class="text-right">اسم</td>
                            </tr>
                            <tr>
                                <td>QID/C.R. NO</td>
                                <td colspan="2" class="text-center">{{ $agreement->tenant_no }}</td>
                                <td class="text-right">QID/C.R. NO</td>
                            </tr>
                            <tr>
                                <td>P.O BOX </td>
                                <td colspan="2" class="text-center">{{ $agreement->po_box }}</td>
                                <td class="text-right">صندوق بريد</td>
                            </tr>
                            <tr>
                                <td>TELEPHONE</td>
                                <td colspan="2" class="text-center">{{ $agreement->phone }}</td>
                                <td class="text-right">هاتف</td>
                            </tr>
                            <tr>
                                <td>Email Address</td>
                                <td colspan="2" class="text-center">{{ $agreement->email }}</td>
                                <td class="text-right">عنوان البريد الالكترونى</td>
                            </tr>
                        </table>

                        <div class="sdmn" style="display: flex;     justify-content: space-between;">
                            <h5><U>2. PREMISES DETAILS</U></h5>
                            <h5 class="text-right"><U>2 تفاصيل أماكن الإقامة</U></h5>

                        </div>
                        <table style="width:100%">
                            <tr>
                                <td>Building Name</td>
                                <td class="text-center">{{ $agreement->building_name_english }}</td>
                                <td class="text-center">{{ $agreement->building_name_arabic }}</td>
                                <td class="text-right">اسم المبنى</td>
                            </tr>
                            <tr>
                                <td>Unit No</td>
                                <td class="text-center">{{ $agreement->unit_no }}</td>
                                <td class="text-center">{{ $agreement->unit_no }}</td>
                                <td class="text-right">رقم الوحدة</td>
                            </tr>
                            <tr>
                                <td>Unit Type</td>
                                <td class="text-center">{{ $agreement->unit_type_english }}</td>
                                <td class="text-center">{{ $agreement->unit_type_arabic }}</td>
                                <td class="text-right">نوع الوحدة</td>
                            </tr>
                            <tr>
                                <td>Electricity No</td>
                                <td colspan="2" class="text-center">{{ $agreement->electricity_no }}</td>
                                <td class="text-right">الكهرباء لا</td>
                            </tr>
                            <tr>
                                <td>Water No</td>
                                <td colspan="2" class="text-center">{{ $agreement->water_no }}</td>
                                <td class="text-right">ماء لا</td>
                            </tr>
                            <tr>
                                <td>Location</td>
                                <td colspan="2" class="text-center">{{ $agreement->location_english }}</td>
                                <td class="text-right">موقع</td>
                            </tr>

                        </table>

                        <div class="sdmn" style="display: flex;     justify-content: space-between;">
                            <h5><U>3. LEASE TERMS</U></h5>
                            <h5 class="text-right"><U>3. شروط الإيجار</U></h5>

                        </div>
                        <table style="width:100%">
                            <tr>
                                <td>Lease Period:</td>
                                <td class="text-center">{{ $agreement->lease_period }}</td>
                                <td class="text-center">{{ $agreement->lease_period_arabic }}</td>
                                <td class="text-right">فترة الإيجار</td>

                            </tr>
                            <tr>
                                <td>Lease Commencement:</td>
                                <td class="text-center">{{ $agreement->lease_commencement }}</td>
                                <td class="text-center">{{ $agreement->lease_commencement_arabic }}</td>
                                <td class="text-right">بدء عقد الإيجار</td>

                            </tr>
                            <tr>
                                <td>Lease Expiry:</td>
                                <td class="text-center">{{ $agreement->lease_expiry }}</td>
                                <td class="text-center">{{ $agreement->lease_expiry_arabic }}</td>
                                <td class="text-right">انتهاء عقد الإيجار</td>

                            </tr>
                        </table>
                        <div class="sdmn" style="display: flex;     justify-content: space-between;">
                            <h5><U>4. FINANCIAL TERMS</U></h5>
                            <h5 class="text-right"><U>4. الشروط المالية</U></h5>

                        </div>

                        <table style="width:100%">
                            <tr>
                                <td>Monthly Rent</td>
                                <td class="text-center">{{ $agreement->monthly_rent }}</td>
                                <td class="text-center">{{ $agreement->monthly_rent_arabic }}</td>
                                <td class="text-right">الإيجار الشهري</td>
                            </tr>
                            <tr>
                                <td>Utilities</td>
                                <td class="text-center">{{ $agreement->utilities }}</td>
                                <td class="text-center">{{ $agreement->utilities_arabic }}</td>
                                <td class="text-right">خدمات</td>
                            </tr>
                            <tr>
                                <td>Mode of Payment</td>
                                <td class="text-center">{{ $agreement->payment_mode }}</td>
                                <td class="text-center">{{ $agreement->payment_mode_arabic }}</td>
                                <td class="text-right">طريقة الدفع</td>
                            </tr>
                            <tr>
                                <td>Security Deposit</td>
                                <td class="text-center">{{ $agreement->security_deposit }}</td>
                                <td class="text-center">{{ $agreement->security_deposit_arabic }}</td>
                                <td class="text-right">مبلغ التأمين</td>
                            </tr>
                            <tr>
                                <td>Rent Payment Commencement</td>
                                <td class="text-center">{{ $agreement->rent_payment_commencement }}</td>
                                <td class="text-center">{{ $agreement->rent_payment_commencement_arabic }}</td>
                                <td class="text-right">بدء سداد الإيجار</td>
                            </tr>
                            <tr>
                                <td>Rent Free</td>
                                <td colspan="2" class="text-center">{{ $agreement->rent_free }}</td>
                                <td class="text-right">إيجار مجاني</td>
                            </tr>

                        </table>
                        <input type="hidden" id="agreement_row_id" value="{{ $agreement->id }}">
                        <div class="card-footer" align="right" id="save_content">
                            <a href="{{ url('admin/property/manage?property_id=' . $agreement->property_id) }}">
                                <button class="btn btn-dark">{{ __('Back to Edit') }}</button>
                            </a>
                            <button id="save_publish" class="btn btn-primary mr-2">{{ __('Save & Publish') }}</button>

                            <button type="button" id="pdf_view" class="btn btn-primary" data-toggle="modal"
                                data-target="#demoModal">{{ __('VIEW PDF') }}</button>
                        </div>
                        <div class="card-footer" align="right" id="view_pdf">
                            <a href="{{ url('admin/property/manage?property_id=' . $agreement->property_id) }}">
                                <button class="btn btn-dark">{{ __('Back') }}</button>
                            </a>
                            <a target="_blank" href="{{ url('agreement/generate-pdf?agreement_id=') . $agreement->id }}">
                                <button class="btn btn-primary mr-2">{{ __('View PDf') }}</button>
                            </a>
                        </div>

                    </div>

                    <div class="modal fade" id="demoModal" tabindex="-1" role="dialog"
                        aria-labelledby="demoModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="demoModalLabel">{{ __('Lease Agreement ') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    {{ __('Published Successfully!') }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ __('Close') }}</button>
                                    <a target="_blank"
                                        href="{{ url('agreement/generate-pdf?agreement_id=') . $agreement->id }}">
                                        <button type="button" class="btn btn-primary">{{ __('View PDF') }}</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    @endsection
    @push('script')
        <script>
            $('#pdf_view').hide();
            $('#view_pdf').hide();
            $("#save_publish").click(function() {
                $.ajax({
                    url: "/publish-previewed-agreement",
                    type: 'get',
                    data: {
                        // tenant_name_arabic: document.getElementById("tenant_name_arabic").innerHTML,
                        agreement_row_id: $('#agreement_row_id').val(),
                    },
                    success: function(res) {
                        console.log(res);
                        if (res['success'] == 1) {
                            $('#view_pdf').show();
                            // document.getElementById('view_pdf').classList.remove('d-none');
                            $('#pdf_view').click();
                            $('#save_content').hide();
                        }
                    },
                    error: function() {
                        alert('failed...');
                        return;

                    }
                });
            });
        </script>
    @endpush
