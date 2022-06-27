
<footer class="sticky-footer p-0">
    <section id="footer" class="footer-area pt-75">
        <hr class="my-4">
        <div class="container ">
            <div class="footer-widget  pb-120 ">
                <div class="d-flex flew-row justify-content-center">
                    <div class="mx-auto col-md-5 text-center ">
                        <div class="footer-logo text-left mt-40 ">
                            <h3>Get Our Newsletter</h3>
                            <p class="mt-10 mb-4">Subscribe to our newsletter and stay updated on the latest developments and special offers!</p>
                            <form method="post" action="{{ url('/subscribe') }}">
                                @csrf
                                <input type="text" name="email" class="w-75" placeholder="Enter your email" required="">
                                <button class="fa fa-chevron-right newslettericon ml-2"
                                    type="submit"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class=" bg-grey pl-3 w-100">
                <div class="container">
                    <div class="row  bg-grey w-100">
                        <div class="mx-auto col-xs-12">
                            <ul class="nav nav-inline ">
                                <li class="nav-item">
                                    <a class="nav-link active" href="https://www.standardmedia.co.ke/">THE STANDARD |</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="https://www.standardmedia.co.ke/ktnnews">
        KTN NEWS |</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="https://www.standardmedia.co.ke/radiomaisha">
        RADIO MAISHA |</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://vas.standardmedia.co.ke/">VAS |</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="http://tutorsoma.standardmedia.co.ke/">TUTORSOMA |</a>
                                </li>
                                <li class="nav-item border-0">
                                    <a class="nav-link" href="https://www.standardmedia.co.ke/corporate">CORPORATE |</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" py-3 " style="background: black;">
                <div class="container">
                    <div class="d-md-flex align-items-center">
                        <span class="text-white">©<script>2020</script> Standard Group PLC</span>
                        <ul class="nav ml-lg-auto">
                            <li class="nav-item"><a class="text-white" href="https://new.standardmedia.co.ke/privacy-policy">Privacy policy</a></li>
                            <li class="nav-item ml-5"><a class="text-white" href=" https://new.standardmedia.co.ke/terms-and-conditions">Terms &amp; Conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </section>
</footer>
</div>

</div>


    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

  

    
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendor/owl-carousel/owl.carousel.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/custom.js') }}" type="text/javascript"></script>
   
    @include('home.includes.js')
    @yield('footer')
</body>


</html>