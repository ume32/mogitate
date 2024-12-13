<div>
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
    <div class="file-upload">
        <label for="{{ $id ?? 'file-upload' }}" class="file-upload-label">
            {{ $label ?? 'ファイルを選択' }}
            <input 
            type="file" 
            id="{{ $id ?? 'file-upload' }}" 
            name="{{ $name ?? 'file' }}" 
            accept="{{ $accept ?? 'image/*' }}" 
            onchange="previewFile(event, '{{ $id ?? 'preview' }}')">
        </label>
        <img id="{{ $id ?? 'preview' }}" src="{{ $previewSrc ?? '#' }}" alt="プレビュー画像" style="display: none;">
        @error($name)
        <p class="file-upload-error">{{ $message }}</p>
        @enderror
    </div>
    <script>
    function previewFile(event, previewId) {
        const file = event.target.files[0];
        const preview = document.getElementById(previewId);

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(file);
        }
    }
    </script>
</div>