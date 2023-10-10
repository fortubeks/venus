@auth
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
@endauth

<!-- Scripts -->
<script src="{{ url('js/manifest.js') }}"></script>
<script src="{{ url('js/vendor.js') }}"></script>