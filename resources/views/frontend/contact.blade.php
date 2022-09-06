@extends('frontend.layouts.app')



@section('content')

<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-15">
                    <h2 class="title text-dark text-capitalize">Contact Us</h2>
                </div>
            </div>
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->
<!-- product tab start -->
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3604.8954945725313!2d83.00409716448797!3d25.37481873069938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398e2e96fc14b6ef%3A0xd3f7a8756de54594!2sKalpnath%20Vihar%20Colony%2C%20Danganj%2C%20Varanasi%2C%20Uttar%20Pradesh%20221007!5e0!3m2!1sen!2sin!4v1617085196518!5m2!1sen!2sin"></iframe>

</div>

<section class="contact-section pt-80 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 mb-30">
                <!--  contact page side content  -->
                <div class="contact-page-side-content">
                    <!--<h3 class="contact-page-title">Contact Us</h3>-->
                    <!--<p class="contact-page-message mb-30">Claritas est etiam processus dynamicus, qui sequitur-->
                    <!--    mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum-->
                    <!--    claram anteposuerit litterarum formas human.</p>-->
                    <!--  single contact block  -->

                    <div class="single-contact-block">
                        <h4><i class="fa fa-fax"></i> Address</h4>
                        <p><strong>STITCHDEAL OPC PRIVATE LIMITED</strong><br>
81/2 , Kalpnath Vihar, Near Raj English School
Akhtha, Pahariya, Varanasi, UP
Pin- 221007
</p>
                    </div>

                    <!--  End of single contact block -->

                    <!--  single contact block -->

                    <div class="single-contact-block">
                        <h4><i class="fa fa-phone"></i> Phone</h4>
                        <p>
                            <a href="tel:+918858025450">Mobile: +91-8858025450</a>
                        </p>
                    </div>

                    <!-- End of single contact block -->

                    <!--  single contact block -->

                    <div class="single-contact-block">
                        <h4><i class="fas fa-envelope"></i> Email</h4>
                        <p>
                            <a href="mailto:info@stitchdeal.com">info@stitchdeal.com</a>
                        </p>
                        <p> <a href="mailto:support@stitchdeal.com">support@stitchdeal.com</a></p>
                    </div>

                    <!--=======  End of single contact block  =======-->
                </div>

                <!--=======  End of contact page side content  =======-->

            </div>
            <div class="col-lg-6 col-12 mb-30">
                <!--  contact form content -->
                <div class="contact-form-content">
                    <h3 class="contact-page-title">Tell Us Your Message</h3>
                    <div class="contact-form">
                        <form id="contact-form" action="{{ route('contact.send_email') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Your Name <span class="required">*</span></label>
                                <input type="text" name="customerName" id="customername" required="">
                            </div>
                            <div class="form-group">
                                <label>Your Email <span class="required">*</span></label>
                                <input type="email" name="customerEmail" id="customerEmail" required="">
                            </div>
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" name="contactSubject" id="contactSubject" required="">
                            </div>
                            <div class="form-group">
                                <label>Your Message</label>
                                <textarea name="contactMessage" class="pb-10" id="contactMessage"
                                    required=""></textarea>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" value="submit" id="submit" class="btn theme-btn--dark1 btn--lg"
                                    name="submit">submit</button>
                            </div>
                        </form>
                    </div>
                    <p class="form-messegemt-10"></p>
                </div>
                <!-- End of contact -->
            </div>
        </div>
    </div>
</section>
<!-- product tab end -->


@endsection