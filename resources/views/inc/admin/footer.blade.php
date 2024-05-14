    <footer>
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                        <i class="fa-solid fa-shop"></i>
                    </a>
                    <span class="mb-3 mb-md-0 text-muted">© {{ Carbon\Carbon::now()->year }} {{ config('app.name') }}</span>
                </div>
            </footer>
        </div>
    </footer>
</body>
</html>
