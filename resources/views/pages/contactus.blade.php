@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/contactus.css') }}">

@section('content')
<section class="contact-hero">
    <div class="contact-hero-content">
        <div class="contact-title-box">
            <h1>Contact Us</h1>
        </div>
    </div>
</section>
<section class="contact-divider"></section>
<section class="contact-form-section">
    <div class="contact-form-container">

        <h2 class="contact-title">
            Get in Touch <span>With Our Teams</span>
        </h2>

        <form class="contact-form" method="POST" action="#">
            @csrf

            <div class="form-group">
                <label>Full Name<span>*</span></label>
                <input type="text" name="full_name" required>
            </div>

            <div class="form-group">
                <label>Job Title / Position</label>
                <input type="text" name="job_title">
            </div>

            <div class="form-group">
                <label>Email Address<span>*</span></label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Company<span>*</span></label>
                <input type="text" name="company" required>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" name="phone">
            </div>

            <div class="form-group">
                <label>How can we help?<span>*</span></label>
                <textarea name="message" rows="6" required></textarea>
            </div>

            <button type="submit" class="contact-submit">
                Submit
            </button>
        </form>

    </div>
</section>



@endsection