document.addEventListener('DOMContentLoaded', function () {
    const mainImageUploadBtn = document.getElementById('main-image-upload-btn');
    const mainImageInput = document.getElementById('main-image-input');
    const mainImageDisplay = document.getElementById('main-image-display');

    const subImageUploadBtn = document.getElementById('sub-image-upload-btn');
    const subImageInput = document.getElementById('sub-image-input');
    const subImagesDisplay = document.getElementById('sub-images-display');

    // console.log(mainImageUploadBtn, mainImageInput, mainImageDisplay, subImageUploadBtn, subImageInput, subImagesDisplay);

    if (mainImageUploadBtn && mainImageInput && mainImageDisplay &&
        subImageUploadBtn && subImageInput && subImagesDisplay) {

        // Khi nhấn nút tải lên ảnh chính
        mainImageUploadBtn.addEventListener('click', function (event) {
            event.preventDefault();
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
        subImageUploadBtn.addEventListener('click', function (event) {
            event.preventDefault();
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

    } else {
        console.error("Không tìm thấy các phần tử HTML cần thiết.");
    }
});
