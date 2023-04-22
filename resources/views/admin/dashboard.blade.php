@extends('backend.layouts.app')

@section('title', 'Dashboard')

@push('styles')
@endpush


@section('content')

    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL PROPERTY</div>
                    <div class="number count-to" data-from="0" data-to="{{ $property_count }}" data-speed="15"
                        data-fresh-interval="20">{{ $property_count }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">help</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL COMPLAINTS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $new_complaints }}" data-speed="1000"
                        data-fresh-interval="20">{{ $new_complaints }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">forum</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL RENT</div>
                    <div class="number count-to" data-from="0" data-to="{{ $total_rent }}" data-speed="1000"
                        data-fresh-interval="20">{{ $currency }} {{ $total_rent }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL TENANTS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $customer_count }}" data-speed="1000"
                        data-fresh-interval="20">{{ $customer_count }}</div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->

    <div class="row clearfix">
        <!-- RECENT PROPERTIES -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>RECENT PROPERTIES</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>City</th>
                                    <th><i class="material-icons small">star</i></th>
                                    <th>Manager</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties as $key => $property)
                                    <tr>
                                        <td>{{ ++$key }}.</td>
                                        <td>
                                            <span title="{{ $property->title }}">
                                                {{ str_limit($property->title, 20) }}
                                            </span>
                                        </td>
                                        <td>{{ $currency }}{{ $property->price }}</td>
                                        <td>{{ $property->city }}</td>
                                        <td>
                                            @if ($property->featured == 1)
                                                <span class="label bg-green">F</span>
                                            @endif
                                        </td>
                                        <td>{{ strtok($property->user->name, ' ') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# RECENT PROPERTIES -->

        <!-- RECENT POSTS -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>NEW COMPLAINTS</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Title</th>
                                    <th>Tenant</th>
                                    <th>Service Request</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaints as $key => $post)
                                    <tr>
                                        <td>{{ ++$key }}.</td>
                                        <td>
                                            <span title="{{ $post['property']['title'] }}">
                                                {{ str_limit($post['property']['title'], 30) }}
                                            </span>
                                        </td>
                                        <td>{{ $post['customer']['first_name'] }}</td>

                                        <td>
                                            {{ str_limit($post['service_list']['name'], 20) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# RECENT POSTS -->
    </div>

    <div class="row clearfix">
        <!-- USER LIST -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>PENDING RENT</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Title</th>
                                    <th>Rent Month</th>
                                    <th>Rental Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pending_rent as $key => $rent)
                                    <tr>
                                        <td>{{ ++$key }}.</td>
                                        <td> <span title="{{ $rent->property->title }}">
                                               {{ $rent->property->product_code }} - {{ str_limit($rent->property->title, 30) }} 
                                            </span>
                                        </td>
                                        <td>{{ $rent->month }}</td>
                                        <td>{{ $rent->rental_date }}</td>
                                        <td>
                                            @if (date("Y-m-d") > $rent->month)
                                                 <span class="badge bg-red"> Rent Due </span>
                                            @else
                                                <span class="badge bg-blue"> Near Rent date </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# USER LIST -->

        <!-- RECENT COMMENTS -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>RECENT COMMENTS</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Comment</th>
                                    <th><i class="material-icons small">check</i></th>
                                    <th>Author</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $key => $comment)
                                    <tr>
                                        <td>{{ ++$key }}.</td>
                                        <td>
                                            <span title="{{ $comment->body }}">
                                                {{ str_limit($comment->body, 10) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($comment->approved == 1)
                                                <span class="label bg-green">A</span>
                                            @else
                                                <span class="label bg-red">N</span>
                                            @endif
                                        </td>
                                        <td>{{ strtok($comment->users->name, ' ') }}</td>
                                        <td>{{ $comment->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# RECENT COMMENTS -->
    </div>


@endsection

@push('script')
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('backend/js/pages/index.js') }}"></script>
@endpush
