@extends('layouts.app')

@section ('head')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a New Lease</div>
                    <fieldset class="panel-body">
                        <form method="POST" action="/lease">
                            {{ csrf_field() }}
                            <fieldset class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="property_id">Choose a Property:</label>
                                        <select name="property_id" id="property_id" class="form-control" required>
                                            <option value="">Choose One...</option>
                                            @foreach ($properties as $property)
                                                <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
                                                    {{ $property->unit }} | {{ $property->address }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <lease :tenants="{{ $tenants }}" inline-template v-cloak>
                                <fieldset class="row">
                                    <legend class="col-sm-12">Tenant Information</legend>
                                    <div class="tenant-entry-new" v-if="newTenant">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="tenantEntryNew">Is this a new Tenant?</label>
                                                <div class="radio">
                                                    <label class="">
                                                        <input type="radio" name="tenantEntry" id="tenantEntryNew" value="0" v-on:change="newTenantCheck" checked> Yes
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label class="">
                                                        <input type="radio" name="tenantEntry" id="tenantEntryExisting" value="1" v-on:change="existingTenantCheck"> No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="first_name">Full Name:</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="First" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label for="last_name">&nbsp;</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Last" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label for="email">Email:</label>
                                                <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1"><i
                                                        class="fa fa-envelope-o"></i></span>
                                                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="phone">Phone:</label>
                                                <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1"><i
                                                        class="fa fa-phone"></i></span>
                                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="809-123-3000" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label for="ssn">Identification:</label>
                                                <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1"><i
                                                        class="fa fa-id-badge"></i></span>
                                                    <input type="text" class="form-control" id="ssn" name="ssn" value="{{ old('ssn') }}" placeholder="State Id" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="dob">Birth Date:</label>
                                                <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1"><i
                                                        class="fa fa-birthday-cake"></i></span>
                                                    <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="salary">Salary:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-dollar"></i></span>
                                                    <input type="number" class="form-control" id="salary" name="salary" value="{{ old('salary') }}" placeholder="0.00" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tenant-entry-existing" v-else>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="tenant_id">Choose a Tenant:</label>
                                                <select name="tenant_id" id="tenant_id" class="form-control" required>
                                                    <option value="">Choose One...</option>
                                                    @foreach ($tenants as $tenant)
                                                        <option value="{{ $tenant->id }}" {{ old('property_id') == $tenant->id ? 'selected' : '' }}>
                                                            {{ $tenant->first_name }} {{ $tenant->last_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                            </lease>
                            <fieldset class="row ">
                                <legend class="col-sm-12">Lease Detail</legend>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Start Date:</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                               value="{{ old('start_date') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Expiration Date:</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date"
                                               value="{{ old('end_date') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Due Day:</label>
                                        <div class="input-group">
                                            <input type="number" min="1" max="31" class="form-control" id="due_day" name="due_day" value="{{ old('due_day')? : 1 }}" required>
                                            <span class="input-group-addon">Day</span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Monthly Rate:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            <input type="number" class="form-control" id="monthly_rate" name="monthly_rate"
                                                   value="{{ old('monthly_rate') }}" placeholder="0.00" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Deposit:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            <input type="number" class="form-control" id="deposit" name="deposit"
                                                   value="{{ old('deposit') }}" placeholder="0.00" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Maintenance Fee:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            <input type="number" class="form-control" id="maintenance_fee"
                                                   name="maintenance_fee"
                                                   value="{{ old('maintenance_fee') }}" placeholder="0.00" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Late Fee:</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="late_fee" name="late_fee"
                                                   value="{{ old('late_fee') }}" placeholder="0" required>
                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="amenities">Amenities:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-star"></i></span>
                                            <input type="text" class="form-control" id="amenities" name="amenities" value="{{ old('amenities') }}" placeholder="ex. WiFi, Heat, Cable" required>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="notes">Notes:</label>
                                        <textarea class="form-control" name="notes" id="notes">{{ old('notes') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Publish</button>
                                    </div>
                                </div>
                            </fieldset>
                            @if (count($errors))
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection