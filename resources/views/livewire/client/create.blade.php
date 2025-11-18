<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="container p-4 rounded-4 shadow-lg bg-white"
         style="max-width: 600px;">
        <h3 class="text-center mb-4 fw-bold text-primary">
            Let's Get Started
        </h3>


        <nav>
            <div class="progress mb-3">
                <div class="progress-bar" role="progressbar"
                     @if($step === 1)
                     style="width: 12%"
                     @elseif($step === 2)
                     style="width: 37%"
                     @elseif($step === 3)
                     style="width: 62%"
                     @elseif($step === 4)
                     style="width: 87%"
                    @endif

                ></div>
            </div>
            <div class="nav nav-tabs justify-content-between border-0" id="nav-tab" role="tablist">

                <button class="nav-link px-4 py-2
                {{ $step === 1 ? 'active fw-bold bg-primary text-white' : 'bg-white text-secondary' }}"
                        style="border-radius: 10px;"
                        type="button">
                    About You
                </button>

                <button class="nav-link px-4 py-2
                {{ $step === 2 ? 'active fw-bold bg-primary text-white' : 'bg-white text-secondary' }}"
                        style="border-radius: 10px;"
                        type="button">
                    Your Goals
                </button>

                <button class="nav-link px-4 py-2
                {{ $step === 3 ? 'active fw-bold bg-primary text-white' : 'bg-white text-secondary' }}"
                        style="border-radius: 10px;"
                        type="button">
                    Preferences
                </button>

                <button class="nav-link px-4 py-2
                {{ $step === 4 ? 'active fw-bold bg-primary text-white' : 'bg-white text-secondary' }}"
                        style="border-radius: 10px;"
                        type="button">
                    Final Details
                </button>
            </div>
        </nav>

        <div class="tab-content mt-4" id="nav-tabContent">

            @if($step === 1)
                <div class="about-you" style="min-height: 100%;">
                    <div class="mt-3">
                        <x-input name="name" label="Full Name" type="text" model="name" placeholder="John Smith" />
                    </div>
                    <div class="mt-3">
                        <x-input name="email" label="Email Address" type="text" model="email" placeholder="john@example.com" />
                    </div>
                    <div class="mt-3">
                        <x-input name="phone_no" label="Phone Number" type="number" model="phone_no" placeholder="9988776655" />
                    </div>

                    <div class="mt-5">
                        <button class="w-100 py-2 btn btn-primary rounded-pill shadow-sm" type="button" wire:click="nextStep">
                            Continue
                        </button>
                    </div>
                </div>

            @endif

            @if($step === 2)
                <div class="your-goals">
                    <div class="mt-3">
                        <label class="fw-semibold">What is your primary goal?</label>
                        <div class="p-3 rounded bg-light border">
                            <x-radio id="1" name="primary_goal" model="primary_goal" value="business_growth" label="Business Growth" /><br>
                            <x-radio id="2" name="primary_goal" model="primary_goal" value="process_optimization" label="Process Optimization" /><br>
                            <x-radio id="3" name="primary_goal" model="primary_goal" value="innovation_n_technology" label="Innovation & Technology" /><br>
                            <x-radio id="4" name="primary_goal" model="primary_goal" value="something_else" label="Something Else" /><br>
                        </div>
                        @error('primary_goal')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <button class="w-100 py-2 btn btn-outline-secondary rounded-pill" type="button" wire:click="previousStep">
                                Back
                            </button>
                        </div>
                        <div class="col-sm-6">
                            <button class="w-100 py-2 btn btn-primary rounded-pill shadow-sm" type="button" wire:click="nextStep">
                                Continue
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            @if($step === 3)
                <div class="preferences">
                    <div class="mt-3">
                        <x-input name="company_name" label="Company Name" type="text" model="company_name" placeholder="3Sea corp." />
                    </div>

                    <div class="mt-3">
                        <label>Industry</label>
                        <div wire:ignore>
                            <select class="form-control rounded" wire:model="industry">
                                <option value=''>--Select Your Industry</option>
                                <option value="technology">Technology</option>
                                <option value="healthcare">Healthcare</option>
                                <option value="finance">Finance</option>
                                <option value="retail">Retail & E-commerce</option>
                                <option value="manufacturing">Manufacturing</option>
                                <option value="education">Education</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        @error('industry')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label>Team Size</label>
                        <div wire:ignore>
                            <select class="form-control rounded" wire:model="team_size">
                                <option value=''>--Select Team Size</option>
                                <option value="1-10">1–10 employees</option>
                                <option value="11-50">11–50 employees</option>
                                <option value="51-200">51–200 employees</option>
                                <option value="201-500">201–500 employees</option>
                                <option value="500+">500+ employees</option>
                            </select>
                        </div>
                        @error('team_size')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <button class="w-100 py-2 btn btn-outline-secondary rounded-pill" type="button" wire:click="previousStep">
                                Back
                            </button>
                        </div>
                        <div class="col-sm-6">
                            <button class="w-100 py-2 btn btn-primary rounded-pill shadow-sm" type="button" wire:click="nextStep">
                                Continue
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            @if($step === 4)
                <div class="final-details">
                    <div class="mt-3">
                        <label>Tell us more about your needs</label>
                        <textarea class="form-control rounded" name="feedback" wire:model="feedback"
                                  placeholder="Share any additional details..."></textarea>
                        @error('feedback')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label>How did you hear about us?</label>
                        <div wire:ignore>
                            <select class="form-control rounded" wire:model="discovery_method">
                                <option value=''>--Select an Option--</option>
                                <option value="search_engine">Search Engine</option>
                                <option value="social_media">Social Media</option>
                                <option value="friend_or_colleague">Friend or Colleague</option>
                                <option value="advertisement">Advertisement</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        @error('discovery_method')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <button class="w-100 py-2 btn btn-outline-secondary rounded-pill" type="button" wire:click="previousStep">
                                Back
                            </button>
                        </div>
                        <div class="col-sm-6">
                            <button class="w-100 py-2 btn btn-success rounded-pill shadow-sm" type="button" wire:click="submit">
                                Submit
                            </button>
                        </div>
                    </div>

                </div>
            @endif

        </div>
    </div>
</div>
