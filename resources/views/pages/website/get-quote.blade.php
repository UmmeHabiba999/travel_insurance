@extends('layouts.website.website-default')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

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
            font-family: Source Sans Pro;
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
        }

        .stepper .step-1 .stepper-counter {
            border-color: #138636;
            color: #138636;
        }

        .stepper .HeaderStep_step__\+nBPI .stepper-counter {
            border: 2px solid;
            border-radius: 50%;
            font-size: 16px;
            line-height: 24px;
            margin-right: 5px;
            max-height: 25px;
            max-width: 25px;
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
    </style>

    <body style="background: #f6f8fb;">
        <nav
            class="navbar sticky-top navbar-light navbar-expand-md navbar-expand-lg w-100
    d-md-flex d-inherit justify-content-between align-items-center px-0 px-md-5">
            <a class="navbar-brand" href="./form.html">
                <img alt="logo_" src="{{ asset('assets/images/company_logo.png') }}">
            </a>
            <div>
                <div class="stepper d-md-flex">
                    <div class="step-1 HeaderStep_step__+nBPI">
                        <span class="stepper-counter">1</span>
                        <span class="HeaderStep_clickable__7QCmS">Plan</span>
                    </div>
                    <hr class="stepper-line">
                    <div class="HeaderStep_stepBlocked__wALuM HeaderStep_step__+nBPI">
                        <span class="stepper-counter">2</span>
                        Checkout
                    </div>
                    <hr class="stepper-line">
                    <div class="HeaderStep_stepBlocked__wALuM HeaderStep_step__+nBPI">
                        <span class="stepper-counter">3</span>
                        Trip Insured!
                    </div>
                </div>
            </div>
        </nav>

        {{-- <div class="container-fluid">
        <div class="row py-5" style="background: #00008f;">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">State of Residence*</label>
                        <select name="" id="single" class="js-states form-control form1-input">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Destination Country*</label>
                        <select name="" id="countries" class="js-states form-control form1-input">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Total Trip Cost*</label>
                        <div class="d-flex position-relative">
                            <img src="{{ asset('assets/images/dollar-currency-sign.png') }}"  width="30px" height="30px" alt=""
                                class="position-absolute" style="z-index: 12; top:15px;left: 10px;">
                            <input type="number" class="form1-input ps-5">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Departure Date</label>
                        <input type="date" class="form1-input">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Return Date</label>
                        <input type="date" class="form1-input">
                    </div>


                    <div class="col-md-4">
                        <label class="form-label">First Deposit Date*</label>
                        <input type="date" class="form1-input">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Number of Travelers*</label>
                        <select name="" id="" class="form1-input form-select">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Age of Travelers*</label>
                        <input type="number" class="form1-input">
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-2 align-items-end h-100">
                            <input type="checkbox" class="mb-2">
                            <p class="mb-0 fw-bold form-label">If all travelers are under 18 years old, please click
                                here.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="d-flex ">
                            <button class="btn quote-now-btn mt-5">GET A QUOTE NOW</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
        <div class="container">



            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center py-5">Choose the best plan for you</h1>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="Plans_boxPlans">
                                        <center>
                                            <div class="Plans_planName__hK-eU">
                                                <h1 class="text-center">Platinum. </h1>
                                            </div>
                                            <h5 class="eligible text-center"><strong>Schengen Eligible</strong></h5>
                                            <div class="description-link">
                                                <a href="https://zaasatspcmdpranc1sto.blob.core.windows.net/uploaded-documents/c485c7b1_6749_4370_a2f9_3e783d2ac58c.pdf?sv=2022-11-02&amp;se=2025-07-02T02%3A20%3A13Z&amp;sr=b&amp;sp=r&amp;sig=njJqz7xdwpz7sxflg8Trd7Z9cRnKz2DWmWpXUhj6yO8%3D"
                                                    target="_blank" rel="noopener noreferrer">Coverage Description</a>
                                            </div>
                                            <button class="man-benift-btn">
                                                Main benefits
                                            </button>
                                        </center>

                                        <ul class="plans-benefits">
                                            <li>
                                                <div class="border-dashed"></div>
                                                <div class="plans-benefits-title">
                                                    <h2>Trip Cancellation</h2>
                                                    <h3>{{ $platinumQuote->trip_cancallation }} of Trip Cost</h3>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="border-dashed"></div>
                                                <div class="plans-benefits-title">
                                                    <h2>Trip Interruption</h2>
                                                    <h3>{{ $platinumQuote->trip_interuption }} of Trip Cost</h3>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="border-dashed"></div>
                                                <div class="plans-benefits-title">
                                                    <h2>Emergency Accident and Sickness Medical Expense</h2>
                                                    <h3>{{ $platinumQuote->medical_expenses }}</h3>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="border-dashed"></div>
                                                <div class="plans-benefits-title">
                                                    <h2>Emergency Evacuation/Repatriation</h2>
                                                    <h3>{{ $platinumQuote->emergency_evacuation }}</h3>
                                                </div>
                                            </li>
                                        </ul>
                                        <div>
                                            <h2 class="text-center">${{ $platinumQuote->price_after_discount_incl_tax }}
                                            </h2>
                                        </div>
                                        <center>

                                            <button class="btn btn-select-benefits" data-bs-toggle="modal"
                                                data-bs-target="#platinum-modal">
                                                Select
                                            </button>


                                        </center>
                                        <h5 class="more-benefits">
                                            See more Benefits
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="Plans_boxPlans">
                                        <center>
                                            <div class="Plans_planName__hK-eU">
                                                <h1 class="text-center">Gold.</h1>
                                            </div>
                                            <h5 class="eligible text-center"><strong>Schengen Eligible</strong></h5>
                                            <div class="description-link">
                                                <a href="https://zaasatspcmdpranc1sto.blob.core.windows.net/uploaded-documents/c485c7b1_6749_4370_a2f9_3e783d2ac58c.pdf?sv=2022-11-02&amp;se=2025-07-02T02%3A20%3A13Z&amp;sr=b&amp;sp=r&amp;sig=njJqz7xdwpz7sxflg8Trd7Z9cRnKz2DWmWpXUhj6yO8%3D"
                                                    target="_blank" rel="noopener noreferrer">Coverage Description</a>
                                            </div>
                                            <button class="man-benift-btn">
                                                Main benefits
                                            </button>
                                        </center>

                                        <ul class="plans-benefits">
                                            <li>
                                                <div class="border-dashed"></div>
                                                <div class="plans-benefits-title">
                                                    <h2>Trip Cancellation</h2>
                                                    <h3>{{ $goldQuote->trip_cancallation }} of Trip Cost</h3>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="border-dashed"></div>
                                                <div class="plans-benefits-title">
                                                    <h2>Trip Interruption</h2>
                                                    <h3>{{ $goldQuote->trip_interuption }} of Trip Cost</h3>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="border-dashed"></div>
                                                <div class="plans-benefits-title">
                                                    <h2>Emergency Accident and Sickness Medical Expense</h2>
                                                    <h3>{{ $goldQuote->medical_expenses }}</h3>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="border-dashed"></div>
                                                <div class="plans-benefits-title">
                                                    <h2>Emergency Evacuation/Repatriation</h2>
                                                    <h3>{{ $goldQuote->emergency_evacuation }}</h3>
                                                </div>
                                            </li>
                                        </ul>
                                        <div>
                                            <h2 class="text-center">${{ $goldQuote->price_after_discount_incl_tax }}</h2>
                                        </div>
                                        <center>

                                            <button class="btn btn-select-benefits" data-bs-toggle="modal"
                                                data-bs-target="#gold-modal">
                                                Select
                                            </button>


                                        </center>
                                        <h5 class="more-benefits">
                                            See more Benefits
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="Plans_boxPlans">
                                        <center>
                                            <div class="Plans_planName__hK-eU">
                                                <h1 class="text-center">Silver.</h1>
                                            </div>
                                            <h5 class="eligible text-center"><strong>Schengen Eligible</strong></h5>
                                            <div class="description-link">
                                                <a href="https://zaasatspcmdpranc1sto.blob.core.windows.net/uploaded-documents/c485c7b1_6749_4370_a2f9_3e783d2ac58c.pdf?sv=2022-11-02&amp;se=2025-07-02T02%3A20%3A13Z&amp;sr=b&amp;sp=r&amp;sig=njJqz7xdwpz7sxflg8Trd7Z9cRnKz2DWmWpXUhj6yO8%3D"
                                                    target="_blank" rel="noopener noreferrer">Coverage Description</a>
                                            </div>
                                            <button class="man-benift-btn">
                                                Main benefits
                                            </button>
                                        </center>

                                        <ul class="plans-benefits">
                                            <li>
                                                <div class="border-dashed"></div>
                                                <div class="plans-benefits-title">
                                                    <h2>Trip Cancellation</h2>
                                                    <h3>{{ $silverQuote->trip_cancallation }} of Trip Cost</h3>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="border-dashed"></div>
                                                <div class="plans-benefits-title">
                                                    <h2>Trip Interruption</h2>
                                                    <h3>{{ $silverQuote->trip_interuption }} of Trip Cost</h3>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="border-dashed"></div>
                                                <div class="plans-benefits-title">
                                                    <h2>Emergency Accident and Sickness Medical Expense</h2>
                                                    <h3>{{ $silverQuote->medical_expenses }}</h3>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="border-dashed"></div>
                                                <div class="plans-benefits-title">
                                                    <h2>Emergency Evacuation/Repatriation</h2>
                                                    <h3>{{ $silverQuote->emergency_evacuation }}</h3>
                                                </div>
                                            </li>
                                        </ul>
                                        <div>
                                            <h2 class="text-center">${{ $silverQuote->price_after_discount_incl_tax }}
                                            </h2>
                                        </div>
                                        <center>

                                            {{-- <a href="./checkoutpage.html">
                                            <button class="btn btn-select-benefits">
                                                Select
                                            </button>
                                        </a> --}}
                                            <button class="btn btn-select-benefits" data-bs-toggle="modal"
                                                data-bs-target="#silver-modal">
                                                Select
                                            </button>


                                        </center>
                                        <h5 class="more-benefits">
                                            See more Benefits
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


        <!--Modal -->
        <div class="modal fade" id="platinum-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-xl  modal-dialog-centered">
                <div class="modal-content">
                    <div class="d-flex align-items-center justify-content-between border-0 px-4 py-4">
                        <p></p>
                        <h5 class="modal-title" id="exampleModalLabel">Improve Your Travel by adding these optional
                            benefits
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card" style="border:2px solid #010090;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="Plans_boxPlans">
                                                    <center>
                                                        {{-- <button class="btn btn-select-benefits text-white"
                                                        data-bs-toggle="modal" data-bs-target="#adons-modal"
                                                        style="background: #010090;">
                                                        Select
                                                    </button> --}}
                                                        <div class="Plans_planName__hK-eU">
                                                            <h1 class="text-center">Platinum. </h1>
                                                        </div>
                                                        <h5 class="eligible text-center"><strong>Schengen Eligible</strong>
                                                        </h5>
                                                        <div class="description-link">
                                                            <a href="https://zaasatspcmdpranc1sto.blob.core.windows.net/uploaded-documents/c485c7b1_6749_4370_a2f9_3e783d2ac58c.pdf?sv=2022-11-02&amp;se=2025-07-02T02%3A20%3A13Z&amp;sr=b&amp;sp=r&amp;sig=njJqz7xdwpz7sxflg8Trd7Z9cRnKz2DWmWpXUhj6yO8%3D"
                                                                target="_blank" rel="noopener noreferrer">Coverage
                                                                Description</a>
                                                        </div>
                                                        <button class="man-benift-btn">
                                                            Main benefits
                                                        </button>
                                                    </center>

                                                    <ul class="plans-benefits">
                                                        <li>
                                                            <div class="border-dashed"></div>
                                                            <div class="plans-benefits-title">
                                                                <h2>Trip Cancellation</h2>
                                                                <h3>100% of Trip Cost</h3>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="border-dashed"></div>
                                                            <div class="plans-benefits-title">
                                                                <h2>Trip Interruption</h2>
                                                                <h3>150% of Trip Cost</h3>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="border-dashed"></div>
                                                            <div class="plans-benefits-title">
                                                                <h2>Emergency Accident and Sickness Medical Expense</h2>
                                                                <h3>$250,000</h3>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="border-dashed"></div>
                                                            <div class="plans-benefits-title">
                                                                <h2>Emergency Evacuation/Repatriation</h2>
                                                                <h3>$1,000,000</h3>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div>
                                                        <h2 class="text-center">
                                                            ${{ $platinumQuote->price_after_discount_incl_tax }}</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="d-flex align-items-center justify-content-between addon-div">
                                    <div>
                                        <h3>Rental Car Damage</h3>
                                        <h5>$50,000</h5>
                                    </div>
                                    <img src="{{ asset('assets/images/add-icon.png') }}" width="60px" height="60px"
                                        alt="">
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between py-4">
                                <p></p>
                                <p></p>
                                <h5 class="text-center mb-0">$89.96</h5>

                                <a href="{{ url('/checkout?quote_name=' . $platinumQuote->name) }}"
                                    class="btn continue-btn">CONTINUE</a>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="gold-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-xl  modal-dialog-centered">
                <div class="modal-content">
                    <div class="d-flex align-items-center justify-content-between border-0 px-4 py-4">
                        <p></p>
                        <h5 class="modal-title" id="exampleModalLabel">Improve Your Travel by adding these optional
                            benefits
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card" style="border:2px solid #010090;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="Plans_boxPlans">
                                                    <center>
                                                        {{-- <button class="btn btn-select-benefits text-white"
                                                        data-bs-toggle="modal" data-bs-target="#adons-modal"
                                                        style="background: #010090;">
                                                        Select
                                                    </button> --}}
                                                        <div class="Plans_planName__hK-eU">
                                                            <h1 class="text-center">Gold. </h1>
                                                        </div>
                                                        <h5 class="eligible text-center"><strong>Schengen Eligible</strong>
                                                        </h5>
                                                        <div class="description-link">
                                                            <a href="https://zaasatspcmdpranc1sto.blob.core.windows.net/uploaded-documents/c485c7b1_6749_4370_a2f9_3e783d2ac58c.pdf?sv=2022-11-02&amp;se=2025-07-02T02%3A20%3A13Z&amp;sr=b&amp;sp=r&amp;sig=njJqz7xdwpz7sxflg8Trd7Z9cRnKz2DWmWpXUhj6yO8%3D"
                                                                target="_blank" rel="noopener noreferrer">Coverage
                                                                Description</a>
                                                        </div>
                                                        <button class="man-benift-btn">
                                                            Main benefits
                                                        </button>
                                                    </center>

                                                    <ul class="plans-benefits">
                                                        <li>
                                                            <div class="border-dashed"></div>
                                                            <div class="plans-benefits-title">
                                                                <h2>Trip Cancellation</h2>
                                                                <h3>100% of Trip Cost</h3>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="border-dashed"></div>
                                                            <div class="plans-benefits-title">
                                                                <h2>Trip Interruption</h2>
                                                                <h3>150% of Trip Cost</h3>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="border-dashed"></div>
                                                            <div class="plans-benefits-title">
                                                                <h2>Emergency Accident and Sickness Medical Expense</h2>
                                                                <h3>$250,000</h3>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="border-dashed"></div>
                                                            <div class="plans-benefits-title">
                                                                <h2>Emergency Evacuation/Repatriation</h2>
                                                                <h3>$1,000,000</h3>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div>
                                                        <h2 class="text-center">$64.00</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="d-flex align-items-center justify-content-between addon-div">
                                    <div>
                                        <h3>Rental Car Damage</h3>
                                        <h5>$50,000</h5>
                                    </div>
                                    <img src="{{ asset('assets/images/add-icon.png') }}" width="60px" height="60px"
                                        alt="">
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between py-4">
                                <p></p>
                                <p></p>
                                <h5 class="text-center mb-0">${{ $goldQuote->price_after_discount_incl_tax }}</h5>

                                <a href="{{ url('/checkout?quote_name=' . $goldQuote->name) }}"
                                    class="btn continue-btn">CONTINUE</a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="silver-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-xl  modal-dialog-centered">
                <div class="modal-content">
                    <div class="d-flex align-items-center justify-content-between border-0 px-4 py-4">
                        <p></p>
                        <h5 class="modal-title" id="exampleModalLabel">Improve Your Travel by adding these optional
                            benefits
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card" style="border:2px solid #010090;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="Plans_boxPlans">
                                                    <center>
                                                        {{-- <button class="btn btn-select-benefits text-white"
                                                        data-bs-toggle="modal" data-bs-target="#adons-modal"
                                                        style="background: #010090;">
                                                        Select
                                                    </button> --}}
                                                        <div class="Plans_planName__hK-eU">
                                                            <h1 class="text-center">Silver. </h1>
                                                        </div>
                                                        <h5 class="eligible text-center"><strong>Schengen Eligible</strong>
                                                        </h5>
                                                        <div class="description-link">
                                                            <a href="https://zaasatspcmdpranc1sto.blob.core.windows.net/uploaded-documents/c485c7b1_6749_4370_a2f9_3e783d2ac58c.pdf?sv=2022-11-02&amp;se=2025-07-02T02%3A20%3A13Z&amp;sr=b&amp;sp=r&amp;sig=njJqz7xdwpz7sxflg8Trd7Z9cRnKz2DWmWpXUhj6yO8%3D"
                                                                target="_blank" rel="noopener noreferrer">Coverage
                                                                Description</a>
                                                        </div>
                                                        <button class="man-benift-btn">
                                                            Main benefits
                                                        </button>
                                                    </center>

                                                    <ul class="plans-benefits">
                                                        <li>
                                                            <div class="border-dashed"></div>
                                                            <div class="plans-benefits-title">
                                                                <h2>Trip Cancellation</h2>
                                                                <h3>100% of Trip Cost</h3>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="border-dashed"></div>
                                                            <div class="plans-benefits-title">
                                                                <h2>Trip Interruption</h2>
                                                                <h3>150% of Trip Cost</h3>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="border-dashed"></div>
                                                            <div class="plans-benefits-title">
                                                                <h2>Emergency Accident and Sickness Medical Expense</h2>
                                                                <h3>$250,000</h3>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="border-dashed"></div>
                                                            <div class="plans-benefits-title">
                                                                <h2>Emergency Evacuation/Repatriation</h2>
                                                                <h3>$1,000,000</h3>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div>
                                                        <h2 class="text-center">
                                                            ${{ $silverQuote->price_after_discount_incl_tax }}</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="d-flex align-items-center justify-content-between addon-div">
                                    <div>
                                        <h3>Rental Car Damage</h3>
                                        <h5>$50,000</h5>
                                    </div>
                                    <img src="{{ asset('assets/images/add-icon.png') }}" width="60px" height="60px"
                                        alt="">
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between py-4">
                                <p></p>
                                <p></p>
                                <h5 class="text-center mb-0">$89.96</h5>

                                <a href="{{ url('/checkout?quote_name=' . $silverQuote->name) }}"
                                    class="btn continue-btn">CONTINUE</a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('js/booking.js') }}"></script>
    </body>
@endsection


@section('insertjavascript')
@endsection
