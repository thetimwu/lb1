<label for="name">Name</label>
                <div class="form-group pb-2">
                    <input type="text" name="name" value="{{old('name') ?? $customer->name}}" class="form-control">
                    <div>{{ $errors->first('name')}}</div>
                </div>
                
                <label for="email">Email</label>
                <div class="form-group">
                        <input type="text" name="email" value="{{old('email') ?? $customer->email}}" class="form-control">
                        <div>{{ $errors->first('email')}}</div>
                </div>
                
                <label for="status">Status</label>
                <div class="form-group">
                    <select name="active" id="active" class="form-control">
                        <option value="" disabled>Select customer status</option>

                        @foreach($customer->activeOptions() as $activeOptionKey => $activeOptionValue)
                            <option value="{{$activeOptionKey}}" {{ $customer->active === $activeOptionValue ? 'selected' : '' }}>{{$activeOptionValue}}</option>
                        @endforeach

                    </select>
                </div>
                
                <label for="status">Company</label>
                <div class="form-group">
                        <select name="company_id" id="company_id" class="form-control">
                            @foreach ($companies as $company)
                                <option value="{{$company->id}}" {{ $company->id == $customer->company_id ? 'selected' : '' }}>{{$company->name}}</option> 
                            @endforeach
                        </select>
                </div>

                @csrf