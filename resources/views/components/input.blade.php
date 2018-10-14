<div class="field">
    @if($label)
    <label class="label" for="{{$name}}">{{$label}}</label>
    @endif
    <div class="control">
        <input id="{{$name}}" type="{{$type}}" name="{{$name}}"
               class="input {{ $errors->has($name) ? ' is-danger' : '' }}"
               value="{{ old($name) }}" required autofocus>
        @if ($errors->has($name))
            <p class="help" role="alert">
                <strong class="has-text-danger">{{ $errors->first($name) }}</strong>
            </p>
        @endif
    </div>
</div>