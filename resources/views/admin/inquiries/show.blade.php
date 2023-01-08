@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        inquiry Details
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>
                        {{ $inquiry->name }}
                        <span class="badge badge-info">
                            {{ $inquiry->getTable() == 'company_inquiries' ? "Company" : "Private" }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Company Name</th>
                    <td>
                        {{ $inquiry->company_name }}
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        {{ $inquiry->email }}
                    </td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>
                        {{ $inquiry->phone }}
                    </td>
                </tr>
                <tr>
                    <th>Product & quantity (for private)</th>
                    <td>
                        {{ $inquiry->product_quantity }}
                    </td>
                </tr>
                <tr>
                    <th>Product (for company)</th>
                    <td>
                        {{ $inquiry->product }}
                    </td>
                </tr>
                <tr>
                    <th>Message/ Question</th>
                    <td>
                        @if ($inquiry->getTable() == 'company_inquiries')
                            {{ $inquiry->message }}
                        @else
                            {{ $inquiry->question }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Social media</th>
                    <td>
                        {{ $inquiry->social_media }}
                    </td>
                </tr>
                <tr>
                    <th>Submited date</th>
                    <td>
                        {{ $inquiry->created_at->diffForHumans() }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection