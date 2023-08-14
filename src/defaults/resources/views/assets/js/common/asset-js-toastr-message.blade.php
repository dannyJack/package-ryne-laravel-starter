<script>
    let TOASTR_MESSAGES = [];

    @foreach(session()->get('_flash.new', []) as $sessionFlash)
        @if(in_array($sessionFlash, ['message', 'success', 'info', 'error']))
            TOASTR_MESSAGES[TOASTR_MESSAGES.length] = ["{{ $sessionFlash }}", "{{ session()->get($sessionFlash) }}"];
        @endif
    @endforeach
</script>
<script src="{{ _vers('js/toastr-message.js') }}" defer></script>
