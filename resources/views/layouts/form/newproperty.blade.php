<div class="row">
    <div class="col-md-6">
        <!-- Property Phase -->
        <div class="mb-3">
            <label for="property_phase" class="col-form-label">{{ __('Property Phase') }}<span class="isRequired"> * </span></label>

            <div class="form-group">
                <select name="property_phase" id="property_phase" class="form-control form-control-alternative{{ $errors->has('property_phase') ? ' is-invalid' : '' }}">
                    @if(request()->is('external'))
                        <option value="External Property">External Property</option>
                    @else
                        <option value="">Please Select</option>
                        <option value="Acquiring">Acquiring</option>
                        <option value="In Development">In Development</option>
                        <option value="Bric Property">Bric Property</option>
                        <option value="Tnherited Tenant">Inherited Tenant</option>
                    @endif
                    
                </select>
                @error('property_phase')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <!-- Entity -->
        <div class="mb-3">
            <label for="entity" class="col-form-label">{{ __('Entity') }}<span class="isRequired"> * </span></label>

            <div class="form-group">
                <select name="entity" id="entity" class="form-control form-control-alternative{{ $errors->has('entity') ? ' is-invalid' : '' }}">
                    <option value="">Please Select</option>
                    @foreach($data['entities'] as $entity)
                        <option value="{{$entity->id}}">{{$entity->entity}}</option>
                    @endforeach
                </select>
                @error('entity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <!-- City -->
        <div class="mb-3">
            <label for="city" class="col-form-label">{{ __('City') }}</label>

            <div class="form-group">
                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus disabled>
                @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <!-- Area -->
        <div class="mb-3">
            <label for="area" class="col-form-label">{{ __('Area') }}</label>

            <div class="form-group">
                <input id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ old('area') }}" required autocomplete="area" autofocus disabled>
                @error('area')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <!-- Postcode -->
        <div class="mb-3">
            <label for="postcode" class="col-form-label">{{ __('Postcode') }}<span class="isRequired"> * </span></label>

            <div class="form-group">
                <select name="postcode" id="postcode" class="form-control form-control-alternative{{ $errors->has('postcode') ? ' is-invalid' : '' }}">
                    <option value="">Please Select</option>
                    <option value="0">Add New</option>
                    @foreach($data['postcode'] as $lsKey => $lsVal)
                        <option value="{{ $lsVal->id }}">{{ $lsVal->postcode }}</option>
                    @endforeach
                </select>
                @error('postcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <!-- House No. / House Name -->
        <div class="mb-3">
            <label for="house_no" class="col-form-label">{{ __('House Number / House Name') }}<span class="isRequired"> * </span></label>

            <div class="form-group">
                <input id="house_no" type="text" class="form-control @error('house_no') is-invalid @enderror" name="house_no" value="{{ old('house_no') }}" required autocomplete="house_no" autofocus>

                @error('house_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <!-- Street -->
        <div class="mb-3">
            <label for="street" class="col-form-label">{{ __('Street') }}<span class="isRequired"> * </span></label>

            <div class="form-group">
                <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" required autocomplete="street" autofocus>

                @error('street')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <!-- No. of Bric Beds -->
        <div class="mb-3">
            <label for="no_of_bric_beds" class="col-form-label">{{ __('No. of Bric Beds') }}</label>

            <div class="form-group">
                <input id="no_of_bric_beds" type="number" min="1" max="99" placeholder="1-99" class="form-control @error('no_of_bric_beds') is-invalid @enderror" name="no_of_bric_beds" value="{{ old('no_of_bric_beds') }}" autocomplete="no_of_bric_beds">

                @error('no_of_bric_beds')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <!-- No. of Bric Bathrooms -->
        <div class="mb-3">
            <label for="no_of_bric_bathroom" class="col-form-label">{{ __('No. of Bric Bathrooms') }}</label>

            <div class="form-group">
                <input id="no_of_bric_bathroom" type="number" min="1" max="99" placeholder="1-99" class="form-control @error('no_of_bric_bathroom') is-invalid @enderror" name="no_of_bric_bathroom" value="{{ old('no_of_bric_bathroom') }}" autocomplete="no_of_bric_bathroom">

                @error('no_of_bric_bathroom')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="col-form-label">{{ __('Letting Status') }}<span class="isRequired"> * </span></label>

            <div class="form-group">
                <select name="status" id="status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}">
                    <option value="">Please Select</option>
                    <option value="0">Add new letting status</option>
                    @foreach($data['letting_statuses'] as $lsKey => $lsVal)
                        <option value="{{ $lsVal->id }}">{{ $lsVal->letting_status_name }}</option>
                    @endforeach
                </select>
                @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-end mt-3">
    @if(request()->is('external'))
        <button type="submit" class="d-none d-sm-inline-block btn btn-success shadow-sm">Save</button>
    @else
        <button class="next d-none d-sm-inline-block btn btn-primary shadow-sm">Next</button>
    @endif
</div>