<button type="submit" {{ $attributes->merge(['class' => 'btn bg-teal']) }}>{{ $slot }}</button>
{{-- <button type="submit" {{ $attributes->merge(['class' => 'btn bg-teal disabled']) }} @if ($errors->any()) disabled @endif>{{ $slot }}</button> --}}
