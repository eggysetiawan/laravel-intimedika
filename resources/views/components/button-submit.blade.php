<button type="submit" class="btn bg-teal" @if (!$errors->isEmpty()) disabled @endif>{{ $slot }}</button>
