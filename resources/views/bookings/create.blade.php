@extends('layouts.app')

@section('content')

<div style="max-width:1450px;margin:40px auto;padding:20px;">

    <!-- HERO -->

    <div style="
        background:linear-gradient(135deg,#2c6e63,#4d9c88);
        border-radius:25px;
        padding:45px;
        color:white;
        box-shadow:0 20px 45px rgba(0,0,0,.12);
        margin-bottom:35px;
    ">

        <h1 style="font-size:42px;font-weight:bold;margin-bottom:10px;">
            Book Your Spa Experience
        </h1>

        <p style="font-size:18px;opacity:.9;">
            Relax • Refresh • Rejuvenate
        </p>

    </div>


    <div style="display:grid;
                grid-template-columns:2.3fr 1fr;
                gap:35px;">

        <!-- LEFT -->

        <div style="
            background:white;
            padding:40px;
            border-radius:22px;
            box-shadow:0 15px 35px rgba(0,0,0,.08);
        ">

            <form
                action="{{ route('bookings.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <!-- CUSTOMER -->

                <div style="margin-bottom:28px;">

                    <label style="font-weight:bold;font-size:15px;">
                        👤 Customer Name
                    </label>

                    <input
                        type="text"
                        name="customer_name"
                        value="{{ old('customer_name') }}"
                        required
                        class="booking-input">

                </div>

                <!-- BOOKING ID -->

                <div style="margin-bottom:28px;">

                    <label style="font-weight:bold;font-size:15px;">
                        🎫 Booking ID
                    </label>

                    <input
                        type="text"
                        name="booking_id"
                        value="{{ old('booking_id') }}"
                        required
                        class="booking-input">

                </div>

                <!-- EVENT -->

                <div style="margin-bottom:28px;">

                    <label style="font-weight:bold;font-size:15px;">
                        🧖 Spa Service
                    </label>

                    <select
                        name="event_id"
                        required
                        class="booking-input">

                        <option value="">Choose Spa Service</option>

                        @foreach($events as $event)

                            <option
                                value="{{ $event->id }}">

                                {{ $event->event_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- DATE -->

                <div style="margin-bottom:28px;">

                    <label style="font-weight:bold;font-size:15px;">
                        📅 Booking Date & Time
                    </label>

                    <input
                        type="datetime-local"
                        name="booking_time"
                        value="{{ old('booking_time', request('date')) }}"
                        required
                        class="booking-input">

                </div>

                <!-- PERSONS -->

                <div style="margin-bottom:30px;">

                    <label style="font-weight:bold;font-size:15px;">
                        👥 Number of Persons
                    </label>

                    <input
                        type="number"
                        min="1"
                        name="number_of_persons"
                        value="{{ old('number_of_persons',1) }}"
                        required
                        class="booking-input">

                </div>

                <!-- PAYMENT -->

                <div style="margin-bottom:35px;">

                    <label style="font-weight:bold;font-size:15px;">
                        💳 Proof of Payment
                    </label>

                    <div style="
                        margin-top:12px;
                        border:2px dashed #2c6e63;
                        border-radius:18px;
                        padding:45px;
                        text-align:center;
                        background:#f7fbfa;
                    ">

                        <div style="font-size:55px;">
                            📤
                        </div>

                        <h3 style="margin-top:10px;">
                            Upload Receipt
                        </h3>

                        <p style="color:#666;">
                            JPG, PNG or PDF
                        </p>

                        <input
                            type="file"
                            name="confirmation_file"
                            required
                            style="margin-top:20px;">

                    </div>

                </div>

                <button
                    type="submit"
                    style="
                        width:100%;
                        height:60px;
                        border:none;
                        border-radius:15px;
                        background:linear-gradient(135deg,#2c6e63,#4d9c88);
                        color:white;
                        font-size:19px;
                        font-weight:bold;
                        cursor:pointer;
                        box-shadow:0 12px 25px rgba(44,110,99,.3);
                    ">

                    Confirm Booking

                </button>

            </form>

        </div>


        <!-- RIGHT -->

        <div>

            <!-- SUMMARY -->

            <div style="
                background:white;
                border-radius:22px;
                padding:30px;
                box-shadow:0 15px 35px rgba(0,0,0,.08);
                margin-bottom:25px;
            ">

                <h2 style="color:#2c6e63;margin-bottom:20px;">
                    Booking Summary
                </h2>

                <hr>

                <p style="margin-top:20px;">

                    <strong>Status</strong>

                </p>

                <span style="
                    display:inline-block;
                    padding:8px 20px;
                    border-radius:30px;
                    background:#ffc107;
                    font-weight:bold;
                    margin-bottom:25px;
                ">

                    Pending Approval

                </span>

                <hr>

                <div style="line-height:35px;margin-top:20px;">

                    ✔ Select a spa service

                    <br>

                    ✔ Choose an available schedule

                    <br>

                    ✔ Upload payment receipt

                    <br>

                    ✔ Wait for approval

                </div>

            </div>

            <!-- CONTACT -->

            <div style="
                background:#2c6e63;
                color:white;
                border-radius:22px;
                padding:30px;
                box-shadow:0 15px 35px rgba(0,0,0,.08);
            ">

                <h3>

                    Need Assistance?

                </h3>

                <hr style="margin:18px 0;border-color:rgba(255,255,255,.2);">

                <p>

                    📞 0912-345-6789

                </p>

                <p>

                    ✉ spa@email.com

                </p>

                <p>

                    📍 Dagupan City

                </p>

            </div>

        </div>

    </div>

</div>

@endsection

@push('styles')

<style>

.booking-input{

    width:100%;

    height:55px;

    border:1px solid #d8d8d8;

    border-radius:12px;

    padding:0 18px;

    margin-top:10px;

    font-size:15px;

    box-sizing:border-box;

    transition:.25s;

    background:#fff;

}

.booking-input:focus{

    outline:none;

    border-color:#2c6e63;

    box-shadow:0 0 12px rgba(44,110,99,.18);

}

button:hover{

    transform:translateY(-2px);

    transition:.25s;

}

</style>

@endpush