<div class="mt-10 text-black text-lg">
    @foreach($tweets as $tweet)
        <div>
            {{ $tweet->body }}
        </div>
    @endforeach
</div>
