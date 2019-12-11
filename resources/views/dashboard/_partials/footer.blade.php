<footer class="main-footer">
    <div class="footer-left">
        <i class="fas fa-copyright"></i> {{ date('Y') }} {{ config('app.name') }}
        <div class="bullet"></div>
        Developed by <a href="https://waveitsolution.com/">{{ config('app.developer') }}</a>
    </div>
    <div class="footer-right">
        <div class="text-dark" data-toggle="tooltip" data-placement="top" data-html="true" title="<em>LastUpdate:</em><br> {{ config('app.lastupdate') }}">
            version: {{ config('app.version') }}
        </div>
    </div>
</footer>
