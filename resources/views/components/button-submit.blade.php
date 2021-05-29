<button type="submit" {{ $attributes->merge(['class' => 'btn bg-teal']) }} @if (!$errors->isEmpty()) disabled @endif>{{ $slot }}</button>
