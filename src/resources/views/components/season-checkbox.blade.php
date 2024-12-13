<div>
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
    <div>
    <div class="form-group">
        <div class="checkbox-group">
            @foreach(['春', '夏', '秋', '冬'] as $season)
            <label class="checkbox-item">
                <input type="checkbox" name="{{ $name }}[]" value="{{ $season }}"
                    {{ in_array($season, old($name, $selectedSeasons ?? [])) ? 'checked' : '' }}>
                <span class="checkbox-circle"></span> <!-- 丸型のスタイルを適用 -->
                {{ $season }}
            </label>
            @endforeach
        </div>
        @error($name)
        <p class="checkbox-error" style="color: red;">{{ $message }}</p>
        @enderror
    </div>
</div>

</div>