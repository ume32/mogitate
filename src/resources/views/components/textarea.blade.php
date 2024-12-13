<div>
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
    <div class="form-group">
        <label for="{{ $name }}">{{ $label }}</label>
        <textarea id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" rows="4">{{ $value }}</textarea>
        @if($helperText)
        <p class="helper-text error-text">{{ $helperText }}</p> <!-- クラスを追加 -->
        @endif
        @error($name)
        <p class="error" style="color: red;">{{ $message }}</p>
        @enderror
    </div>
</div>