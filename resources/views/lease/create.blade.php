@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a New Lease</div>
                    <fieldset class="panel-body">
                        <lease inline-template v-cloak>
                            <form method="POST" id="createLease" @submit.prevent="validate">
                                {{ csrf_field() }}
                                <fieldset class="row">
                                    <div class="col-sm-6">
                                        @if (!$preselected)
                                            <div class="form-group">
                                                <label for="property_id">Choose a Property:</label>
                                                <select name="property_id" id="property_id" class="form-control">
                                                    <option value="">Choose One...</option>
                                                    @foreach ($properties as $property)
                                                        <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
                                                            {{ $property->unit }} | {{ $property->address }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            @foreach ($properties as $property)
                                                <div class="well well-sm">
                                                    <input type="hidden" name="property_id" id="property_id" value="{{ $property->id }}">
                                                    <i class="fa fa-check"></i> {{ $property->unit }}
                                                    | {{ $property->address }} - ${{ $property->price }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </fieldset>
                                <fieldset id="tenant" class="row">
                                    <legend class="col-sm-12">Tenant Information</legend>
                                    <div id="pid-check" class="col-lg-6">
                                        <label for="pid">Check for pre-existing tenants first:</label>
                                        <div class="input-group">
                                            <input type="text" name="pid" id="pid" v-model="pid" class="form-control" placeholder="License or ID">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button" v-on:click="lookUpTenant">Search</button>
                                            </span>
                                        </div><!-- /input-group -->
                                        <p></p>
                                        <div class="alert alert-sm" v-bind:class="[response.status]" v-if="response.status">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <span v-text="response.msg"></span>
                                            <button type="button" class="btn btn-sm btn-link" v-text="response.action" v-on:click="enableTenantInputs"></button>
                                        </div>
                                    </div>
                                    <legend class="col-sm-12">&nbsp;</legend>

                                    <div class="tenant-entry-new">
                                        <input type="hidden" name="tenant_id" id="tenant_id" v-model="tenant.id">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="form-group" :class="{'input': true, 'has-error': errors.has('first_name') }">
                                                        <label for="first_name">Full Name:</label>
                                                        <input type="text" v-validate="'required|alpha'" class="form-control" id="first_name" name="first_name" v-model="tenant.first_name" placeholder="First">
                                                        <span class="error text-danger" v-show="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="form-group" :class="{'input': true, 'has-error': errors.has('last_name') }">
                                                        <label for="last_name">&nbsp;</label>
                                                        <input type="text" v-validate="'required|alpha'" class="form-control" id="last_name" name="last_name" v-model="tenant.last_name" placeholder="Last">
                                                        <span class="error text-danger" v-show="errors.has('last_name')">@{{ errors.first('last_name') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <div class="form-group" :class="{'input': true, 'has-error': errors.has('email') }">
                                                        <label for="email">Email:</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope-o"></i></span>
                                                            <input v-validate="'required|email'" type="text" class="form-control" id="email" name="email"  v-model="tenant.email" placeholder="john@example.com">
                                                        </div>
                                                        <span class="error text-danger" v-show="errors.has('email')">@{{ errors.first('email') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group" :class="{'input': true, 'has-error': errors.has('phone') }">
                                                        <label for="phone">Phone:</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-phone"></i></span>
                                                            <input type="text" v-validate="'required|numeric'" class="form-control" id="phone" name="phone"  v-model="tenant.phone" placeholder="809-123-3000">
                                                        </div>
                                                        <span class="error text-danger" v-show="errors.has('phone')">@{{ errors.first('phone') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <div class="form-group" :class="{'input': true, 'has-error': errors.has('personal_id') }">
                                                        <label for="personal_id">Identification:</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-id-badge"></i></span>
                                                            <input type="text" v-validate="'required'" class="form-control" id="personal_id" name="personal_id"  v-model="tenant.personal_id" placeholder="State Id">
                                                        </div>
                                                        <span class="error text-danger" v-show="errors.has('personal_id')">@{{ errors.first('personal_id') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group" :class="{'input': true, 'has-error': errors.has('dob') }">
                                                        <label for="dob">Birth Date:</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-birthday-cake"></i></span>
                                                            <input type="date" v-validate="'required|date_format:YYYY-MM-DD|before:' + today" class="form-control" id="dob" name="dob"  v-model="tenant.dob">
                                                        </div>
                                                        <span class="error text-danger" v-show="errors.has('dob')">@{{ errors.first('dob') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group" :class="{'input': true, 'has-error': errors.has('salary') }">
                                                <label for="salary">Salary:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-dollar"></i></span>
                                                    <input type="number" v-validate="'required|decimal'" class="form-control" id="salary" name="salary"  v-model="tenant.salary" placeholder="0.00">
                                                </div>
                                                <span class="error text-danger" v-show="errors.has('salary')">@{{ errors.first('salary') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="row ">
                                    <legend class="col-sm-12">Lease Detail</legend>
                                    <div class="col-sm-3">
                                        <div class="form-group" :class="{'input': true, 'has-error': errors.has('start_date') }">
                                            <label>Start Date:</label>
                                            <input type="date" v-validate="'required|date_format:YYYY-MM-DD'" class="form-control" id="start_date" name="start_date" v-model="lease.start_date">
                                            <span class="error text-danger" v-show="errors.has('start_date')">@{{ errors.first('start_date') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group" :class="{'input': true, 'has-error': errors.has('end_date') }">
                                            <label>Expiration Date:</label>
                                            <input type="date" v-validate="'required|date_format:YYYY-MM-DD'" class="form-control" id="end_date" name="end_date" v-model="lease.end_date">
                                            <span class="error text-danger" v-show="errors.has('end_date')">@{{ errors.first('end_date') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group" :class="{'input': true, 'has-error': errors.has('due_day') }">
                                            <label>Due Day:</label>
                                            <div class="input-group">
                                                <input type="number" v-validate="'required|numeric|min:1|max:31'" min="1" max="31" class="form-control" id="due_day" name="due_day" v-model="lease.due_day">
                                                <span class="input-group-addon">Day</span>
                                            </div>
                                            <span class="error text-danger" v-show="errors.has('due_day')">@{{ errors.first('due_day') }}</span>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group" :class="{'input': true, 'has-error': errors.has('monthly_rate') }">
                                            <label>Monthly Rate:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                <input type="number" v-validate="'required|decimal'" class="form-control" id="monthly_rate" name="monthly_rate" v-model="lease.monthly_rate" placeholder="0.00">
                                            </div>
                                            <span class="error text-danger" v-show="errors.has('monthly_rate')">@{{ errors.first('monthly_rate') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group" :class="{'input': true, 'has-error': errors.has('deposit') }">
                                            <label>Deposit:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                <input type="number" v-validate="'required|decimal'" class="form-control" id="deposit" name="deposit" v-model="lease.deposit" placeholder="0.00">
                                            </div>
                                            <span class="error text-danger" v-show="errors.has('deposit')">@{{ errors.first('deposit') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group" :class="{'input': true, 'has-error': errors.has('maintenance_fee') }">
                                            <label>Maintenance Fee:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                <input type="number" v-validate="'required|decimal'" class="form-control" id="maintenance_fee" name="maintenance_fee" v-model="lease.maintenance_fee" placeholder="0.00">
                                            </div>
                                            <span class="error text-danger" v-show="errors.has('maintenance_fee')">@{{ errors.first('maintenance_fee') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group" :class="{'input': true, 'has-error': errors.has('late_fee') }">
                                            <label>Late Fee:</label>
                                            <div class="input-group">
                                                <input type="number" v-validate="'required|decimal'" class="form-control" id="late_fee" name="late_fee" v-model="lease.late_fee" placeholder="0">
                                                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                            </div>
                                            <span class="error text-danger" v-show="errors.has('late_fee')">@{{ errors.first('late_fee') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group" :class="{'input': true, 'has-error': errors.has('amenities') }">
                                            <label for="amenities">Amenities:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-star"></i></span>
                                                <input type="text" class="form-control" id="amenities" name="amenities" v-model="lease.amenities" placeholder="ex. WiFi, Heat, Cable">
                                            </div>
                                            <span class="error text-danger" v-show="errors.has('amenities')">@{{ errors.first('amenities') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group" :class="{'input': true, 'has-error': errors.has('notes') }">
                                            <label for="notes">Notes:</label>
                                            <textarea class="form-control" v-validate="'required'" name="notes" id="notes" v-model="lease.notes"></textarea>
                                            <span class="error text-danger" v-show="errors.has('notes')">@{{ errors.first('notes') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Publish</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="alert" :class="{'alert': true, 'alert-danger': request.status == 'error' }">
                                            <h4 v-if="request.status == 'error'" class="">
                                                <i class="fa fa-exclamation-circle"></i> @{{ request.message }}
                                            </h4>
                                            <ul>
                                                <li v-for="error in request.errors">@{{ error[0] }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </lease>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection