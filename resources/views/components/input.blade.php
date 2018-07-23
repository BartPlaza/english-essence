<div class="field">
    <label class="label" for="{{$name}}">{{$label}}</label>
    <div class="control">
        <input id="{{$name}}}" type="{{$type}}" name="{{$name}}"
               class="input {{ $errors->has($name) ? ' is-danger' : '' }}"
               value="{{ old($name) }}" required autofocus>
        @if ($errors->has($name))
            <p class="help is danger" role="alert">
                <strong>{{ $errors->first($name) }}</strong>
            </p>
        @endif
    </div>
</div>