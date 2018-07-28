<div id="notification" class="notification {{$class}}">
    <button class="delete" onclick="{document.getElementById('notification').style.display = 'none';}"></button>
    @if($class === 'is-warning')
        <i class="fas fa-exclamation-triangle"></i>
    @elseif ($class === 'is-success')
        <i class="far fa-check-circle"></i>
    @endif
    {{$message}}
</div>