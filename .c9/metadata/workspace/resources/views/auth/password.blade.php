{"filter":false,"title":"password.blade.php","tooltip":"/resources/views/auth/password.blade.php","ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":0,"column":0},"end":{"row":21,"column":7},"isBackwards":true},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":56,"mode":"ace/mode/php"}},"hash":"729a7e5f16d00365fe19d61fc643b67c407455c8","undoManager":{"mark":0,"position":0,"stack":[[{"start":{"row":0,"column":0},"end":{"row":21,"column":7},"action":"insert","lines":["<form method=\"POST\" action=\"/password/email\">","    {!! csrf_field() !!}","","    @if (count($errors) > 0)","        <ul>","            @foreach ($errors->all() as $error)","                <li>{{ $error }}</li>","            @endforeach","        </ul>","    @endif","","    <div>","        Email","        <input type=\"email\" name=\"email\" value=\"{{ old('email') }}\">","    </div>","","    <div>","        <button type=\"submit\">","            Send Password Reset Link","        </button>","    </div>","</form>"],"id":1}]]},"timestamp":1450544641000}