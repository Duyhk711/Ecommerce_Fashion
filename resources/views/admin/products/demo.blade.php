@extends('layouts.backend')
@section('css')
<style>
    .image-preview {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
    }
    .image-preview img {
        max-width: 200px;
        margin-bottom: 10px;
    }
    .sub-images {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .sub-image-container {
        position: relative;
        display: inline-block;
    }
    .sub-image-container img {
        max-width: 100px;
    }
    .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: red;
        color: white;
        border: none;
        padding: 2px 5px;
        cursor: pointer;
        font-size: 12px;
    }
    /* Ẩn input file */
    .hidden-input {
        display: none;
    }
    /* Nút tải lên */
    .upload-btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 10px;
    }
    .upload-btn:hover {
        background-color: #0056b3;
    }
</style>
@endsection

@section('content')
<div class="upload-container">
    <h1>Upload Ảnh Chính và Ảnh Phụ</h1>

    <!-- Khu vực Ảnh Chính -->
    <div class="image-preview" id="main-image-preview">
        <h3>Ảnh Chính</h3>
        <button class="upload-btn" id="main-image-upload-btn">Tải lên Ảnh Chính</button>
        <input type="file" id="main-image-input" class="hidden-input">
        <div id="main-image-display"></div>
    </div>

    <!-- Khu vực Ảnh Phụ -->
    <div class="image-preview" id="sub-images-preview">
        <h3>Ảnh Phụ</h3>
        <button class="upload-btn" id="sub-image-upload-btn">Tải lên Ảnh Phụ</button>
        <input type="file" id="sub-image-input" class="hidden-input" multiple>
        <div class="sub-images" id="sub-images-display"></div>
    </div>
@endsection

@section('js')
<script>
    // Nút tải lên ảnh chính và ảnh phụ
    const mainImageUploadBtn = document.getElementById('main-image-upload-btn');
    const mainImageInput = document.getElementById('main-image-input');
    const mainImageDisplay = document.getElementById('main-image-display');

    const subImageUploadBtn = document.getElementById('sub-image-upload-btn');
    const subImageInput = document.getElementById('sub-image-input');
    const subImagesDisplay = document.getElementById('sub-images-display');

    // Khi nhấn nút tải lên ảnh chính
    mainImageUploadBtn.addEventListener('click', function () {
        mainImageInput.click(); // Mở input file để chọn ảnh
    });

    // Hiển thị ảnh chính sau khi chọn
    mainImageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                mainImageDisplay.innerHTML = `<img src="${e.target.result}" alt="Ảnh chính">`;
            };
            reader.readAsDataURL(file);
        }
    });

    // Khi nhấn nút tải lên ảnh phụ
    subImageUploadBtn.addEventListener('click', function () {
        subImageInput.click(); // Mở input file để chọn nhiều ảnh
    });

    // Hiển thị ảnh phụ sau khi chọn
    subImageInput.addEventListener('change', function () {
        const files = this.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            reader.onload = function (e) {
                const subImageContainer = document.createElement('div');
                subImageContainer.classList.add('sub-image-container');
                
                subImageContainer.innerHTML = `
                    <img src="${e.target.result}" alt="Ảnh phụ">
                    <button class="remove-btn">X</button>
                `;

                // Nút xóa ảnh phụ
                const removeBtn = subImageContainer.querySelector('.remove-btn');
                removeBtn.addEventListener('click', function () {
                    subImagesDisplay.removeChild(subImageContainer);
                });

                subImagesDisplay.appendChild(subImageContainer);
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
