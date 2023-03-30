@extends('backend.layouts.app')

@section('title', 'Read data')

@push('styles')
@endpush


@section('content')

    <div class="block-header">
        <a href="{{ route('admin.complaint') }}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>{{ $data->complaint_number }} - COMPLAINT</h2>
                    <div class="text-right">
                        @if ($data->status == 0)
                            <span class="btn-cyan btn-sm"> New </span>
                        @elseif($data->status == 1)
                            <span class="btn-success btn-sm"> Approved </span>
                        @elseif($data->status == 2)
                            <span class="btn-danger btn-sm"> Rejected </span>
                        @elseif($data->status == 3)
                            <span class="btn-warning btn-sm"> Assigned to handyman </span>
                        @elseif($data->status == 4)
                            <span class="btn-warning btn-sm"> Ressolved </span>
                        @endif
                    </div>
                </div>
                <div class="header">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-group">

                                <li class="list-group-item">
                                    <strong>Lease period : </strong>
                                    <span class="right"
                                        id="lease_duration">{{ $agreement_data->lease_commencement }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Lease expiry : </strong>
                                    <span class="right" id="expiry_date">{{ $agreement_data->lease_expiry }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Property Type : </strong>
                                    <span class="right" id="rent_date">{{ $data->property->type }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Property code : </strong>
                                    <span class="right" id="rent_date">{{ $data->property->product_code }}</span>
                                </li>

                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Tenant Name : </strong>
                                    <span class="right"> {{ $data->customer->first_name }}
                                        {{ $data->customer->last_name }} </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Email : </strong>
                                    <span class="right">{{ $data->customer->email }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Contact number : </strong>
                                    <span class="right">{{ $data->customer->phone }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Complaint registered date : </strong>
                                    <span class="right">{{ $data->created_at->toFormattedDateString() }}</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="body">

                    <h5>Complaint</h5>
                    <p>{!! $data->complaint !!}</p>

                    <div class="card">
                        <div class="header bg-indigo">
                            <h2>Attachments</h2>
                        </div>
                        <div class="gallery-box" id="gallerybox">
                            @foreach ($complaint_image as $gallery)
                                <div class="gallery-image-edit" id="gallery-{{ $gallery->id }}">
                                    {{-- <button type="button" data-id="{{ $gallery->id }}"
                                            class="btn btn-danger btn-sm"><i
                                                class="material-icons">delete_forever</i></button> --}}
                                    <img class="img-responsive"
                                        src="{{ Storage::url('complaint/gallery/' . $gallery->name) }}"
                                        alt="{{ $gallery->name }}">
                                </div>
                            @endforeach
                        </div>
                        {{-- <div class="gallery-box">
                                <hr>
                                <input type="file" name="gallaryimage[]" value="UPLOAD" id="gallaryimageupload" multiple>
                                <button type="button" class="btn btn-info btn-lg right" id="galleryuploadbutton">UPLOAD
                                    GALLERY IMAGE</button>
                            </div> --}}
                    </div>
                    <hr>
                    {{-- <a href="{{ route('admin.complaint.reject', $data->id) }}" class="btn btn-danger btn-sm waves-effect">
                        <i class="material-icons">replay</i>
                        <span>Reject</span>
                    </a> --}}
                    @if ($data->status == 0)
                        <button class="btn btn-danger btn-sm waves-effect cancellation_model" data-toggle="modal"
                            data-target="#cancelModal" data-whatever="@mdo"> <i class="material-icons">replay</i>
                            <span>Reject </span>
                        </button>
                    @endif
                    <form class="right" action="{{ route('admin.complaint.action') }}" method="POST">
                        @csrf
                        <input type="hidden" name="complaint_id" id="complaint_id" value="{{ $data->id }}">
                        @if ($data->status != 2 && $data->status != 4)
                            <button type="submit" class="btn btn-success btn-sm waves-effect">
                                <i class="material-icons">local_library</i>
                                @if ($data->status == 0)
                                    <input type="hidden" name="status" value="1">
                                    <span>Accept</span>
                                @elseif($data->status == 1)
                                    <input type="hidden" name="status" value="3">
                                    <span>Assign</span>
                                @elseif($data->status == 3)
                                    <input type="hidden" name="status" value="4">
                                    <span>Ressolved</span>
                                @endif
                            </button>
                        @endif
                    </form>
                    <br />
                    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog"
                        aria-labelledby="cancelModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="POST" id="cancellationForm">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelModalLabel">Complaint cancellation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="complaint_id" id="complaint_id"
                                            value="{{ $data->id }}">

                                        <div class="form-line">
                                            <label for="cancellation_reason_id" class="form-label">Select reason
                                                <span class="text-red">*</span></label>

                                            <select name="cancellation_reason_id" class="form-control show-tick">
                                                <option value="">-- Please select --</option>

                                                @foreach ($cancellation_reason as $reason)
                                                    <option value="{{ $reason->id }}">
                                                        {{ $reason->reason }}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <input type="submit" id="cancellation_submit" value="Submit"
                                            class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('script')
    <script>
        (function($) {
            $("#cancellationForm").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var actionUrl = '/admin/complaint/reject'

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        console.log(data);
                        location.reload(); // show response from the php script.
                    }
                });

            });
        })(jQuery);
    </script>
@endpush