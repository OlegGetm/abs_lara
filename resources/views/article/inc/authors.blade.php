@if (count($authors) > 0)
    <ul class="author-list">
    @foreach($authors as $author)
        <li>{{ $author->fullName }}</li>
    @endforeach
    </ul>
@endif