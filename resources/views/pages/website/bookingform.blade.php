@extends('layouts.website.website-default')


@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header">Quote your Travel Insurance</h5>
                    <div class="card-body">
                        <form id="addBooking" method="POST" action="{{ route('add.booking') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">State of Residence*</label>
                                    <select name="state_of_residence" id="single"
                                        class="js-states form-control form1-input" value="{{ old('state_of_residence') }}"
                                        required>
                                        <option value="" disabled selected>Select your state</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Destination Country*</label>
                                    <select name="destination_country" id="countries"
                                        class="countries js-states form-control form1-input" value="{{ old('destination_country') }}"
                                        required>
                                        <option value="" disabled selected>Select Destination Country</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Travel Date*</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label-sm">Departure Date</label>
                                            <input type="date" name="departure_date" class="form1-input"
                                                id="departure-date" value="{{ old('departure_date') }}" required>
                                            <small id="date-message" style="color: red; display: none;"></small>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-sm">Return Date</label>
                                            <input type="date" name="return_date" class="form1-input" id="return-date"
                                                value="{{ old('return_date') }}" required>
                                            <small id="return-date-message" style="color: red; display: none;">
                                                Return Date cannot be earlier than Departure Date.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Booking Date*</label>
                                    <input type="date" name="first_deposit_date" class="form1-input"
                                        value="{{ old('first_deposit_date') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Total Trip Cost*</label>
                                    <div class="d-flex position-relative">
                                        <img src="{{ asset('assets/images/dollar-currency-sign.png') }}" width="30px"
                                            height="30px" alt="" class="position-absolute"
                                            style="z-index: 12; top:15px;left: 10px;">
                                        <input type="number" name="total_trip_cost" class="form1-input ps-5"
                                            value="{{ old('total_trip_cost') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Number of Adults*</label>
                                    <input type="number" name="adults" class="form1-input" value="{{ old('adults') }}"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Number of Children</label>
                                    <input type="number" name="children" class="form1-input" value="{{ old('children') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Number of Infants</label>
                                    <input type="number" name="infants" class="form1-input" value="{{ old('infants') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Age of Travelers*</label>
                                    <select name="ages[]" id="age-select" class="form1-input" required multiple>
                                        <!-- Options will be populated via JavaScript -->
                                    </select>
                                </div>
                                <div id="error-message" style="color:red; display:none;">Total number of travelers should
                                    not be greater than 10.</div>
                                <div class="col-md-12">
                                    <button class="btn quote-now-btn mt-3" type="submit" id="submitBooking">GET A QUOTE
                                        NOW</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('insertjavascript')

    <script>
        $(document).ready(function() {
            // Populate ages
            const ageSelect = $('#age-select');
            for (let age = 1; age <= 100; age++) {
                ageSelect.append(new Option(age, age));
            }

            // Set Select2 for age-select
            ageSelect.select2({
                placeholder: "Select ages",
                allowClear: true
            });

            // Initial Validation on page load
            $('input').each(function() {
                if ($(this).val()) {
                    $(this).css('border', '');
                } else if (!$(this).is('[required]')) {
                    $(this).val(0);
                }
            });

            // Validate and handle input fields
            $('input').on('input', function() {
                if ($(this).val()) {
                    $(this).css('border', '');
                } else if ($(this).is('[required]')) {
                    $(this).css('border', '1px solid red');
                } else {
                    $(this).val(0);
                }
                validateTravelers();
            });

            // Validate travelers count
            function validateTravelers() {
                var adults = parseInt($('input[name="adults"]').val()) || 0;
                var children = parseInt($('input[name="children"]').val()) || 0;
                var infants = parseInt($('input[name="infants"]').val()) || 0;
                var total = adults + children + infants;

                if (total > 10) {
                    $('#error-message').show();
                    $('#submitBooking').prop('disabled', true);
                } else {
                    $('#error-message').hide();
                    $('#submitBooking').prop('disabled', false);
                }
            }

            validateTravelers();

            // Set min departure date
            var today = new Date();
            today.setDate(today.getDate() + 1);
            var formattedDate = today.toISOString().split('T')[0];
            $('#departure-date').attr('min', formattedDate);

            // Update min return date based on departure date
            $('#departure-date').on('change', function() {
                var departureDate = new Date($(this).val());
                if (departureDate) {
                    var nextDay = new Date(departureDate);
                    nextDay.setDate(departureDate.getDate() + 1);
                    var formattedDate = nextDay.toISOString().split('T')[0];
                    $('#return-date').attr('min', formattedDate);
                }
            });

            // Validate return date
            $('#return-date').on('change', function() {
                var departureDate = new Date($('#departure-date').val());
                var returnDate = new Date($(this).val());
                if (returnDate <= departureDate) {
                    $('#return-date-message').show();
                    $(this).val('');
                } else {
                    $('#return-date-message').hide();
                }
            });

            // Display success or error messages with SweetAlert
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                });
            @endif

            // Load States from the JSON file
            $.getJSON('{{ asset('json/states.json') }}', function(data) {
                $.each(data, function(key, entry) {
                    $('#single').append(new Option(entry.name, entry.abbreviation));
                });
            });

            // Load Countries from the JSON file
            $.getJSON('{{ asset('json/countries.json') }}', function(data) {
                $.each(data, function(key, entry) {
                    $('.countries').append(new Option(entry.name, entry.code));
                });
            });

            // Set Select2 for states and countries
            $('#single').select2();
            $('.countries').select2();
        });
    </script>
@endsection
