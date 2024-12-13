<div>
    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
    <div class="form-group">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input 
        type="{{ $type }}" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        class="form-control @error($name) is-invalid @enderror" 
        placeholder="{{ $placeholder }}" 
        value="{{ old($name, $value) }}" 
    />
    @if ($errorMessage)
        <p class="error-message">{{ $errorMessage }}</p>
    @endif
    @error($name)
        <p class="error-message">{{ $message }}</p>
    @enderror
</div>

</div>