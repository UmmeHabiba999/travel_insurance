@extends('layouts.website.website-default')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Quote your Travel Insurance</h5>
                <div class="card-body">
                   <form id="addBooking" method="POST" action="{{ route('add.booking') }}">
                        @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">State of Residence*</label>
                            <select name="state_of_residence" id="single" class="js-states form-control form1-input required">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Destination Country*</label>
                            <select name="destination_country" id="countries" class="js-states form-control form1-input required">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Travel Date*</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label-sm">Departure Date</label>
                                    <input type="date" name="departure_date" class="form1-input required">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-sm">Return Date</label>
                                    <input type="date" name="return_date" class="form1-input required">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <label class="form-label">First Deposit Date*</label>
                            <input type="date" name="first_deposit_date" class="form1-input required">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Total Trip Cost*</label>
                            <div class="d-flex position-relative">
                                <img src="{{ asset('assets/images/dollar-currency-sign.png') }}" width="30px" height="30px" alt=""
                                    class="position-absolute" style="z-index: 12; top:15px;left: 10px;">
                                <input type="number" name="total_trip_cost" class="form1-input ps-5 required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Number of Travelers*</label>
                            <select name="number_of_travelers" id="" class="form1-input form-select required">
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
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Age of Travelers*</label>
                            <input type="number" name="age_of_travelers" class="form1-input required">
                        </div>
                        <div class="col-md-12">
                            <button class="btn quote-now-btn mt-3"  type="submit" id="submitBooking">GET A QUOTE NOW</button>
                        </div>
                    </div>
                </form>
                {{-- <a href="{{ route('get.quote')}}">Get Quote</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('insertjavascript')
{{-- <script>
    $(document).ready(function () {
            $('#submitBooking').click(function () {
                var isValid = true;
                $('.required').each(function () {
                    if ($(this).val() === '') {
                        $(this).addClass('border-danger');
                        isValid = false;
                    } else {
                        $(this).removeClass('border-danger');
                    }
                });

                $('#single, #countries').each(function() {
                    var select2SelectionElement = $(this).next('.select2').find('.select2-selection');

                    if ($(this).val() === '') {
                        select2SelectionElement.addClass('border-danger');
                        isValid = false;
                    } else {
                        select2SelectionElement.removeClass('border-danger');
                    }
                });

            //     if (isValid) {
            //         var form_data = $('#addBooking').serialize();
            //     //    showLoader();
            //         $.ajax({
            //             type: 'POST',
            //             url: "{{ route('add.booking') }}",
            //             data: form_data,
            //             success: function (data) {
            //                 // hideLoader();
            //     Swal.fire({
            //         icon: 'success',
            //         title: 'Success!',
            //         text: 'Quote  saved successfully.',
            //     }).then((result) => {
            //         if (result.isConfirmed || result.isDismissed) {
            //             location.reload();
            //         }
            //     });
            // },
            // error: function (error) {
            //     // hideLoader();
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Error!',
            //         text: 'There was an error saving the information. Please try again.',
            //     });
            //     console.error('There was a problem with the AJAX request:', error);
            // }
            //         });
            //     }
            });
            $('.required').on('input', function () {
            if ($(this).val() !== '') {
                $(this).removeClass('border-danger');
            } else {
                $(this).addClass('border-danger');
            }
        });
        $('#single, #countries').on('change', function() {
            var select2SelectionElement = $(this).next('.select2').find('.select2-selection');
            if ($(this).val() !== '') {
                select2SelectionElement.removeClass('border-danger');
            } else {
                select2SelectionElement.addClass('border-danger');
            }
        });

        });

</script> --}}
@endsection
