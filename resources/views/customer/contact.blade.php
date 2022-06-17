@extends('customer.layout')
@section('content')
<div class="site-blocks-cover inner-page" style="background-image: url({{asset('user_assets/images/hero_bg_1.jpg')}});" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-7">
          <span class="sub-text">Get In Touch</span>
          <h1><strong>Contact</strong> Us</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="site-section bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-6 mb-5 mb-lg-0">

          <h2 class="site-heading text-black mb-5"><strong>Appointment</strong></h2>

          <form action="#" class="p-5 bg-white mb-5 mb-lg-0">

            <div class="row form-group">
              <div class="col-md-6 mb-3 mb-md-0">
                <label class="font-weight-bold" for="fname">First Name</label>
                <input type="text" id="fname" class="form-control" placeholder="First Name">
              </div>
              <div class="col-md-6">
                <label class="font-weight-bold" for="lname">Last Name</label>
                <input type="text" id="lname" class="form-control" placeholder="Last Name">
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-6 mb-3 mb-md-0">
                <label class="font-weight-bold" for="date">Date</label>
                <input type="text" id="date" class="form-control datepicker px-2" placeholder="Date of visit">
              </div>
              <div class="col-md-6">
                <label class="font-weight-bold" for="email">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Email">
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="treatment">Treatment Needed</label>
                <select name="treatment" id="treatment" class="form-control">
                  <option value="">Dental exam and teeth cleaning</option>
                  <option value="">Dental emergency</option>
                  <option value="">Dental implants</option>
                </select>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="note">Notes</label>
                <textarea name="note" id="note" cols="30" rows="5" class="form-control" placeholder="Write your notes or questions here..."></textarea>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <input type="submit" value="Send" class="btn btn-primary">
              </div>
            </div>


          </form>
        </div>
        <div class="col-md-12 col-lg-6">

          <h2 class="site-heading text-black mb-5">Say  <strong>Hello</strong></h2>

          <form action="#" class="p-5 bg-white">

            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="font-weight-bold" for="fullname">Full Name</label>
                <input type="text" id="fullname" class="form-control" placeholder="Full Name">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="email">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Email Address">
              </div>
            </div>



            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Say hello to us"></textarea>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <input type="submit" value="Send" class="btn btn-primary">
              </div>
            </div>


          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection
