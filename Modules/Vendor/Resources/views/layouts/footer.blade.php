@if(!Auth::guest())
<footer class="app-footer">
@else
<footer class="app-footer" style="width:100%;margin:0;">
@endif
    <div>
        <a href="https://coreui.io/pro/">Katalog Bersama</a>
        <span>&copy; 2020 Inamart.</span>
    </div>
</footer>