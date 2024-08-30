@extends('layouts.website.website-default')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
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

                            <select name="state_of_residence" id="single"  class="js-states form-control form1-input" required>
                                <option value="" disabled selected>Select your state</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Destination Country*</label>
                            <select name="destination_country" id="countries" class="js-states form-control form1-input" required>
                                <option value="" disabled selected>Select Destination Country</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Travel Date*</label>
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <label class="form-label-sm">Departure Date</label>
                                    <input type="date" name="departure_date" class="form1-input" required>
                                </div> --}}

                                <div class="col-md-6">
                                    <label class="form-label-sm">Departure Date</label>
                                    <input
                                        type="date"
                                        name="departure_date"
                                        class="form1-input"
                                        id="departure-date"
                                        required
                                    >
                                    <small id="date-message" style="color: red; display: none;">Please select a date at least 6 months from today.</small>
                                </div>


                                {{-- <div class="col-md-6">
                                    <label class="form-label-sm">Departure Date</label>
                                    <input
                                        type="date"
                                        name="departure_date"
                                        class="form1-input"
                                        required
                                        id="departure-date"
                                    >
                                </div> --}}


                                {{-- <div class="col-md-6">
                                    <label class="form-label-sm">Return Date</label>
                                    <input type="date" name="return_date" class="form1-input" required>
                                </div> --}}

                                <div class="col-md-6">
                                    <label class="form-label-sm">Return Date</label>
                                    <input
                                        type="date"
                                        name="return_date"
                                        class="form1-input"
                                        id="return-date"
                                        required
                                    >
                                    <small id="return-date-message" style="color: red; display: none;">
                                        Return Date cannot be earlier than Departure Date.
                                    </small>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <label class="form-label">Booking Date*</label>
                            <input type="date" name="first_deposit_date" class="form1-input" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Total Trip Cost*</label>
                            <div class="d-flex position-relative">
                                <img src="{{ asset('assets/images/dollar-currency-sign.png') }}" width="30px" height="30px" alt=""
                                    class="position-absolute" style="z-index: 12; top:15px;left: 10px;">
                                <input type="text" name="total_trip_cost" class="form1-input ps-5" required>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <label class="form-label">Number of Travelers*</label>
                            <select name="number_of_travelers" id="" class="form1-input form-select" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div> --}}
                        <div class="col-md-6">
                            <label class="form-label">Number of Adults*</label>
                            <input type="text" name="adults" class="form1-input" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Number of Children*</label>
                            <input type="text" name="children" class="form1-input" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Number of Infants*</label>
                            <input type="text" name="infants" class="form1-input" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Age of Travelers*</label>
                            {{-- <input type="text" name="ages[]"  class="form1-input" required multiple> --}}

                            <select name="ages[]" id="age-select" class="form1-input" required multiple>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>

                            </select>
                        </div>

                        <div class="col-md-12">
                            <button class="btn quote-now-btn mt-3"  type="submit" id="submitBooking">GET A QUOTE NOW</button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/booking.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#age-select').select2({
            placeholder: "Select ages",
            allowClear: true
        });
    });
</script>





<script>
    $(document).ready(function() {

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
            });
        @endif


        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
            });
        @endif
    });
</script>


@endsection
