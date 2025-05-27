@extends('header')

@section('content')
<div class="content-wrapper">

<div class="breadcrumb-wrap bg-f br-1">
<div class="container">
<div class="breadcrumb-title">
<h2>Contact Us</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="{{url('/')}}">Home </a></li>
<li>Contact Us</li>
</ul>
</div>
</div>
</div>


<section class="contact-us-wrap ptb-100">
<div class="container">
<div class="row justify-content-center">
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="contact-item">
<span class="contact-icon">
<i class="ri-map-pin-line"></i>
</span>
<div class="contact-info">
<h3>Our Location</h3>
<p>No 8 Temidire Street Iyana Bodija Express Road Ibadan</p>
</div>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="contact-item">
<span class="contact-icon">
<i class="ri-mail-send-line"></i>
</span>
<div class="contact-info">
<h3>Email Us</h3>
<a href="mailto:support@waveplus.com.ng" target="_blank"><span class="__cf_email__" data-cfemail="">support@waveplus.com.ng</span></a>
</div>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="contact-item">
<span class="contact-icon">
<i class="ri-phone-line"></i>
</span>
<div class="contact-info">
<h3>Phone</h3>
<a href="tel:+2347045836730">07045836730</a>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-7">
<div class="contact-form">
<form class="form-wrap" id="contactForm">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<input type="text" name="name" placeholder="Name*" id="name" required data-error="Please enter your name">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<input type="email" name="email" id="email" required placeholder="Email*" data-error="Please enter your email">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<input type="text" name="phone_number" placeholder="Phone*" id="phone_number" required data-error="Please enter your phone number">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<input type="text" name="msg_subject" placeholder="Subject*" id="msg_subject" required data-error="Please enter your subject">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-md-12">
<div class="form-group v1">
<textarea name="message" id="message" placeholder="Your Messages.." cols="30" rows="10" required data-error="Please enter your message"></textarea>
<div class="help-block with-errors"></div>
</div>
</div>
<div class="form-group">
<!--<div class="form-check checkbox">-->
<!--<input name="gridCheck" value="I agree to the terms and privacy policy." class="form-check-input" type="checkbox" id="gridCheck" required>-->
<!--<label class="form-check-label" for="gridCheck">-->
<!--I agree to the <a class="link style1" href="terms-of-service.html">Terms &amp; Conditions</a> and <a class="link style1" href="privacy-policy.html">Privacy Policy</a>-->
<!--</label>-->
<!--<div class="help-block with-errors gridCheck-error"></div>-->
<!--</div>-->
</div>
<div class="col-md-12">
<button type="submit" class="btn style1">SEND MESSAGE<i class="ri-arrow-right-s-line"></i></button>
<div id="msgSubmit" class="h3 text-center hidden"></div>
<div class="clearfix"></div>
</div>
</div>
</form>
</div>
</div>
<div class="col-lg-5">
<div class="comp-map">
<iframe width="100%" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=500&amp;hl=en&amp;q=No%208%20Temidire%20Street%20Iyana%20Bodija%20Express%20Road%20Ibadan+(waveplus)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/population/">Calculate population in area</a></iframe>
</div>
</div>
</div>
</div>
</section>

</div>

@endsection