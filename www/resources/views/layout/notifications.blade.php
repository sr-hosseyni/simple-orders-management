<!-- if there are creation errors, they will show here -->
<ul class="notifications">
    @foreach($errors->all() as $error)
        <li class="error">{{ $error }}</li>
    @endforeach
</ul>
