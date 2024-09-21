document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('checkAll');
    const checkboxes = document.querySelectorAll('.cart-checkbox');
    const totalPriceElement = document.getElementById('totalPrice');
    const cartTable = document.querySelector('tbody');
    const cartContainer = document.querySelector('.main-col'); // Khung chính của giỏ hàng

    // Cập nhật tổng tiền
    function updateTotalPrice() {
        let totalPrice = 0;
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const price = parseFloat(checkbox.getAttribute('data-price'));
                const quantity = parseInt(checkbox.closest('tr').querySelector('.quantity-input').value);
                totalPrice += price * quantity;
            }
        });
        totalPriceElement.textContent = totalPrice.toLocaleString('vi-VN') + ' VND'; // Thêm VND vào chuỗi hiển thị
    }

    // Chức năng chọn tất cả
    checkAll.addEventListener('change', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = checkAll.checked;
        });
        updateTotalPrice();
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateTotalPrice);
    });

    // Cập nhật số lượng
    window.changeQuantity = function(button, change) {
        const quantityInput = button.parentElement.querySelector('.quantity-input');
        let currentQuantity = parseInt(quantityInput.value);
        currentQuantity = Math.max(1, currentQuantity + change); // Đảm bảo số lượng không nhỏ hơn 1
        quantityInput.value = currentQuantity;

        let itemId;
        const cartItemInput = button.closest('tr').querySelector('input[name="cart_item_id"]');
        const variantInput = button.closest('tr').querySelector('input[name="variant_id"]');

        if (cartItemInput) {
            itemId = cartItemInput.value;
        } else if (variantInput) {
            itemId = variantInput.value;
        } else {
            alert('Không tìm thấy thông tin sản phẩm');
            return;
        }

        updateCart(itemId, currentQuantity, cartItemInput ? 'cart_item_id' : 'variant_id');
    };

    // Hàm gửi AJAX request để cập nhật giỏ hàng
    function updateCart(itemId, quantity, itemType) {
        console.log(`${itemType}:`, itemId);
        console.log('quantity:', quantity);

        let data = {};
        data[itemType] = itemId;
        data['quantity'] = quantity;

        fetch(updateUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error('Cập nhật giỏ hàng thất bại với mã lỗi ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                console.log('Giỏ hàng đã được cập nhật');
                updateTotalPrice(); // Gọi lại hàm để cập nhật tổng tiền
            } else {
                console.error('Cập nhật giỏ hàng thất bại:', data.message);
            }
        })
        .catch(error => {
            console.error('Lỗi:', error);
        });
    }

    // Xử lý nút xóa sản phẩm
    const removeButtons = document.querySelectorAll('.btn-danger');

    removeButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn không cho form gửi theo cách truyền thống

            const form = this.closest('form');
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hiển thị thông báo nếu cần
                    alert(data.message);
                    // Xóa hàng sản phẩm đã xóa
                    form.closest('tr').remove();
                    updateTotalPrice(); // Cập nhật lại tổng tiền

                    // Kiểm tra nếu giỏ hàng trống
                    if (cartTable.children.length === 0) {
                        // Cập nhật giao diện giỏ hàng trống thay vì reload
                        cartContainer.innerHTML = '<p>Giỏ hàng của bạn đang trống.</p>';
                    }
                } else {
                    alert('Lỗi: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
            });
        });
    });
});

// Cập nhật lại tổng tiền khi xóa sản phẩm
function updateTotalPrice() {
    const checkboxes = document.querySelectorAll('.cart-checkbox');
    let totalPrice = 0;

    checkboxes.forEach(checkbox => {
        const price = parseFloat(checkbox.getAttribute('data-price'));
        const quantity = parseInt(checkbox.closest('tr').querySelector('.quantity-input').value);
        totalPrice += price * quantity;
    });

    document.getElementById('totalPrice').textContent = totalPrice.toLocaleString('vi-VN') + ' VND';
}
