<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-left">
                <p class="mb-0">
                    &copy; <a href="https://www.standardmedia.co.ke" target="_blank" class="text-muted">Standard Group PLC</a>
                </p>
            </div>
            <div class="col-6 text-right">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">About us</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Help</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Contact</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Terms & Conditions</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>
</div>

<script src="{{ asset('assets/js/app.js?t='.time()) }}"></script>
@include('cms.includes.js');
@yield('footer')

</body>

</html>
