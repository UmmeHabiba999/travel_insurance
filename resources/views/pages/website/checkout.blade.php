@extends('layouts.website.website-default')
@section('content')
<style>
    .form-label {
        color: white;
    }

    .sticky-top {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        z-index: 1020;
        background: #f6f8fb;
        padding: 30px 100px;
    }

    .navbar-light .navbar-brand {
        color: rgba(0, 0, 0, .9);
    }

    .navbar-brand {
        padding-top: .3125rem;
        padding-bottom: .3125rem;
        margin-right: 1rem;
        font-size: 1.25rem;
        text-decoration: none;
        white-space: nowrap;
    }

    .stepper {
        -ms-flex-align: center;
        align-items: center;
        display: -ms-flexbox;
        font-family: "Source Sans 3", sans-serif;
        font-style: normal;
    }

    .stepper .HeaderStep_step__\+nBPI {
        color: #343c3d;
        font-size: 13px;
        font-weight: 600;
        line-height: 17px;
        text-decoration: underline;
    }

    .stepper .step-1 {
        text-decoration: none !important;
    }

    .stepper .HeaderStep_step__\+nBPI {
        color: #343c3d;
        font-size: 13px;
        font-weight: 600;
        line-height: 17px;
        text-decoration: underline;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .step-1-checked .stepper-counter,
    .stepper .step-1 .stepper-counter {
        border-color: #138636;
        color: #138636;
    }


    .stepper .HeaderStep_step__\+nBPI .stepper-counter {
        border: 2px solid;
        border-radius: 50%;
        font-size: 16px;
        /* line-height: 24px; */
        margin-right: 5px;
        max-height: 25px;
        max-width: 25px;
        height: 35px;
        width: 35px;
        padding: 2px 8px;
    }

    .stepper .HeaderStep_step__\+nBPI .HeaderStep_clickable__7QCmS {
        cursor: pointer;
        text-decoration: underline;
    }

    .stepper .HeaderStep_barBlocked__10\+8M {
        opacity: .3;
    }

    .stepper .stepper-line {
        border-top: 3px solid #ccc;
        -ms-flex: 1 1;
        flex: 1 1;
        margin: 0 5px;
        min-width: 220px;
    }

    .checkout-form-label {
        color: #343c3d;
        font-family: Source Sans, sans-serif;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 24px;
        margin: .5em 0 0;
    }

    .checkout-input {
        border: 1px solid #ccc;
        border-radius: 0 !important;
        color: #757575;
        font-family: "Source Sans 3", sans-serif;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        height: 40px;
        letter-spacing: 1.5px;
        line-height: 24px;
        margin: 0;
        padding: 0 0 0 12px;
        width: 100%;
    }

    .HeaderStep_barDone__\+b3am {
        border-color: #138636 !important;
        opacity: 1;
    }

    .step-1-checked .stepper-counter {
        background-image: url('../assets/imgs/CheckCircle.svg');
        background-position: 50%;
        background-size: cover;
        border-color: #138636;
        color: transparent;
        background-repeat: no-repeat;
    }

    .btn-purchase {
        background: #d75d3d;
        border: none;
        color: #fff;
        font-size: 14px;
        font-style: normal;
        font-weight: 600;
        gap: 8px;
        height: 48px;
        justify-content: center;
        letter-spacing: 1px;
        line-height: 16px;
        max-width: none !important;
        text-transform: uppercase;
        width: 100%;
    }
</style>

<body style="background: #f6f8fb;">
    <nav class="navbar sticky-top navbar-light navbar-expand-md navbar-expand-lg w-100
    d-md-flex d-inherit justify-content-between align-items-center px-0 px-md-5">
        <a class="navbar-brand" href="./form.html">
            <img alt="logo_" src="{{ asset('assets/images/company_logo.png') }}"   >
        </a>
        <div>
            <div class="stepper d-md-flex">
                <a href="./bestPlanpage.html">
                    <div class="step-1-checked HeaderStep_step__+nBPI">
                        <div class="stepper-counter"></div>
                        <span class="HeaderStep_clickable__7QCmS">Plan</span>
                    </div>
                </a>
                <hr class="stepper-line HeaderStep_barDone__+b3am">
                <div class="step-1 HeaderStep_stepBlocked__wALuM HeaderStep_step__+nBPI">
                    <div class="stepper-counter">2</div>
                    Checkout
                </div>
                <hr class="stepper-line">
                <div class="HeaderStep_stepBlocked__wALuM HeaderStep_step__+nBPI">
                    <div class="stepper-counter">3</div>
                    Trip Insured!
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row px-md-5">
            <div class="col-md-12">
                <h1>Traveler Info & Payment</h1>
            </div>

            <div class="col-md-7">
                <h6 class="sm-heading mt-4">TRIP DESTINATION</h6>
                <div class="Plans_boxPlans px-5 py-3">
                    <div>
                        <label class="checkout-form-label">Country *</label>
                        <select class="checkout-input form-select"></select>
                    </div>
                </div>

                <h6 class="sm-heading mt-4">TRAVELER 1 (POLICY HOLDER)</h6>
                <div class="Plans_boxPlans px-5 py-3">
                    <div>
                        <label class="checkout-form-label">First Name *</label>
                        <input type="text" class="checkout-input form-control">
                    </div>
                    <div>
                        <label class="checkout-form-label">Middle Name</label>
                        <input type="text" class="checkout-input form-control">
                    </div>
                    <div>
                        <label class="checkout-form-label">Last Name *</label>
                        <input type="text" class="checkout-input form-control">
                    </div>
                    <div>
                        <label class="checkout-form-label">Address *</label>
                        <input type="text" class="checkout-input form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="checkout-form-label">City *</label>
                            <input type="text" class="checkout-input form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="checkout-form-label">Zip Code *</label>
                            <input type="text" class="checkout-input form-control">
                        </div>
                    </div>

                    <div>
                        <label class="checkout-form-label">State of Residence *</label>
                        <input type="text" class="checkout-input form-control">
                    </div>
                    <div>
                        <label class="checkout-form-label">Phone Number *</label>
                        <input type="number" class="checkout-input form-control">
                    </div>
                    <div>
                        <label class="checkout-form-label">Email *</label>
                        <input type="text" class="checkout-input form-control">
                    </div>
                    <div>
                        <label class="checkout-form-label">Email Confirmation *</label>
                        <input type="text" class="checkout-input form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="checkout-form-label">Birth Date *</label>
                            <input type="date" class="checkout-input form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="checkout-form-label">Age *</label>
                            <input type="number" class="checkout-input form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div>
                    <h6 class="sm-heading mt-4">TRIP SUMMARY</h6>
                    <div class="Plans_boxPlans px-5 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0">Departure date:</p>
                            <p class="mb-0">07/03/2024</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0">Return date:</p>
                            <p class="mb-0">07/03/2024</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3"
                            style="border-top: 1px dashed gray;">
                            <p class="mt-2 mb-0">Return date:</p>
                            <p class="mt-2 mb-0">07/03/2024</p>
                        </div>
                    </div>
                    <div>
                        <h6 class="sm-heading mt-4">PURCHASE SUMMARY</h6>
                        <div class="Plans_boxPlans px-5 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-0">Silver</p>
                                <p class="mb-0">$24.00USD</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3"
                                style="border-top: 1px dashed gray;">
                                <h6 class="mt-2 mb-0"><b>TOTAL TO PAY</b></h6>
                                <h6 class="mt-2 mb-0"><b>$24.00USD</b></h6>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <h6 class="sm-heading mt-4">PAYMENT</h6>
                        <div class="p-5" style="background: #00008f;">
                            <img src="../assets/imgs/card.png" alt="">
                            <div>
                                <label class="checkout-form-label text-white mt-3">Full Name (as displayed on Card)
                                    *</label>
                                <input type="text" class="checkout-input form-control">
                            </div>
                            <div>
                                <label class="checkout-form-label text-white mt-3">Card Number *</label>
                                <input type="number" class="checkout-input form-control">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="checkout-form-label text-white mt-3">Expiration Date *</label>
                                    <input type="date" class="checkout-input form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="checkout-form-label text-white mt-3">CVC *</label>
                                    <input type="date" class="checkout-input form-control">
                                </div>
                            </div>
                            <div>
                                <label class="checkout-form-label text-white mt-3">Address *</label>
                                <input type="text" class="checkout-input form-control">
                            </div>
                            <div>
                                <label class="checkout-form-label text-white mt-3">City *</label>
                                <input type="text" class="checkout-input form-control">
                            </div>
                            <div>
                                <label class="checkout-form-label text-white mt-3">Zip Code *</label>
                                <input type="text" class="checkout-input form-control">
                            </div>
                            <div>
                                <label class="checkout-form-label text-white mt-3">Country *</label>
                                <input type="text" class="checkout-input form-control">
                            </div>
                            <div>
                                <label class="checkout-form-label text-white mt-3">State of Residence *</label>
                                <select class="checkout-input form-select">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center gap-2 mt-4">
                                <input type="checkbox" class="checkout-input" style="width: 3%">
                                <p class="text-white mb-0">Please, uncheck this box if billing address is not the same
                                    as
                                    policy holder address</p>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <input type="checkbox" class="checkout-input" style="width: 3%">
                                <p class="text-white mb-0"> Yes, I would like to receive promotional information
                                    occasionally</p>
                            </div>

                            <div class="d-flex gap-2">
                                <input type="checkbox" class="checkout-input" style="width: 3%">
                                <p class="text-white mb-0" style="width: 97%;">By checking here you agree to our Terms
                                    and Conditions,
                                    Nationwide Disclosure and acknowledge that you have read the Privacy Policy</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-center text-white mt-5 gap-2">

                                <h5 class="mb-0">TOTAL TO PAY</h5>
                                <h3 class="mb-0">$24.00USD</h3>
                            </div>
                            <button class="btn btn-purchase mt-4">COMPLETE PURCASE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
@endsection
@section('insertjavascript')

@endsection
