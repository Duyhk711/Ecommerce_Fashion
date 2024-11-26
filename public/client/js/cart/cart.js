document.addEventListener("DOMContentLoaded", function () {
  const checkAll = document.getElementById("checkAll");
  const checkboxes = document.querySelectorAll(".cart-checkbox");
  const totalPriceElement = document.getElementById("totalPrice");
  
  // Chức năng chọn tất cả
  checkAll.addEventListener("change", function () {
    // Lọc ra tất cả các checkbox không thuộc sản phẩm đã xóa
    const checkboxesToCheck = Array.from(checkboxes).filter((checkbox) => {
      const cartItemRow = checkbox.closest("tr");
      // Kiểm tra nếu dòng sản phẩm không bị xóa
      return !cartItemRow.classList.contains("deleted");
    });

    // Đánh dấu tất cả các checkbox còn lại là checked
    checkboxesToCheck.forEach((checkbox) => {
      checkbox.checked = checkAll.checked;
    });

    // Cập nhật tổng tiền sau khi thay đổi trạng thái checkbox
    updateTotalPrice2();
  });

  // Cập nhật tổng tiền khi thay đổi trạng thái checkbox
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", updateTotalPrice2);
  });

  // Cập nhật số lượng
  window.changeQuantity = function (button, change) {
    const quantityInput = button.parentElement.querySelector(".quantity-input");
    const maxStock = parseInt(
      button.closest("tr").querySelector(".max-stock").value
    ); // Lấy số lượng tồn kho
    let currentQuantity = parseInt(quantityInput.value);

    // Kiểm tra nếu số lượng hiện tại + thay đổi không vượt quá số lượng tồn kho
    currentQuantity = Math.max(1, Math.min(currentQuantity + change, maxStock)); // Giới hạn số lượng giữa 1 và tồn kho
    quantityInput.value = currentQuantity;

    // Vô hiệu hóa nút "-" khi số lượng bằng 1
    const decreaseButton =
      button.parentElement.querySelector(".decrease-quantity");
    if (currentQuantity === 1) {
      decreaseButton.disabled = true;
    } else {
      decreaseButton.disabled = false;
    }

    // Vô hiệu hóa nút "+" khi đạt tồn kho
    const increaseButton =
      button.parentElement.querySelector(".increase-quantity");
    if (currentQuantity >= maxStock) {
      increaseButton.disabled = true;
    } else {
      increaseButton.disabled = false;
    }

    let itemId;
    const cartItemInput = button
      .closest("tr")
      .querySelector('input[name="cart_item_id"]');
    const variantInput = button
      .closest("tr")
      .querySelector('input[name="product_variant_id"]');

    if (cartItemInput) {
      itemId = cartItemInput.value;
    } else if (variantInput) {
      itemId = variantInput.value;
    } else {
      alert("Không tìm thấy thông tin sản phẩm");
      return;
    }

    updateCart(
      itemId,
      currentQuantity,
      cartItemInput ? "cart_item_id" : "product_variant_id"
    );
  };

  document.querySelectorAll(".quantity-input").forEach((input) => {
    // Lưu trữ số lượng hiện tại trước khi thay đổi
    let previousQuantity = parseInt(input.value);

    // Kiểm tra khi người dùng rời khỏi ô input (blur)
    input.addEventListener("blur", function () {
      const maxStock = parseInt(
        this.closest("tr").querySelector(".max-stock").value
      ); // Lấy số lượng tồn kho
      let currentQuantity = parseInt(this.value);

      // Nếu ô trống, không làm gì, đợi người dùng nhập xong
      if (!this.value) {
        return;
      }

      // Kiểm tra nếu người dùng nhập số hợp lệ
      if (isNaN(currentQuantity) || currentQuantity < 1) {
        this.value = previousQuantity;
        return;
      }

      // Nếu số lượng vượt quá tồn kho, hiển thị popup và đặt lại giá trị trước đó
      if (currentQuantity > maxStock) {
        showPopup(`Mặt hàng này chỉ còn ${maxStock} số lượng.`);
        this.value = previousQuantity; // Đặt lại về giá trị trước đó
        return;
      }

      // Cập nhật số lượng hợp lệ và lưu lại số lượng mới
      previousQuantity = currentQuantity;

      // Cập nhật nút tăng/giảm số lượng
      const increaseButton =
        this.parentElement.querySelector(".increase-quantity");
      const decreaseButton =
        this.parentElement.querySelector(".decrease-quantity");

      if (currentQuantity >= maxStock) {
        increaseButton.disabled = true;
      } else {
        increaseButton.disabled = false;
      }

      if (currentQuantity <= 1) {
        decreaseButton.disabled = true;
      } else {
        decreaseButton.disabled = false;
      }

      // Lấy thông tin sản phẩm để cập nhật giỏ hàng
      let itemId;
      const cartItemInput = this.closest("tr").querySelector(
        'input[name="cart_item_id"]'
      );
      const variantInput = this.closest("tr").querySelector(
        'input[name="product_variant_id"]'
      );

      if (cartItemInput) {
        itemId = cartItemInput.value;
      } else if (variantInput) {
        itemId = variantInput.value;
      } else {
        console.error("Không tìm thấy thông tin sản phẩm");
        return;
      }

      // Gửi request cập nhật giỏ hàng ngay sau khi người dùng nhập số hợp lệ
      updateCart(
        itemId,
        currentQuantity,
        cartItemInput ? "cart_item_id" : "product_variant_id"
      );
    });

    // Cho phép xóa số khi đang nhập, không ép buộc hiện số ngay lập tức
    input.addEventListener("input", function () {
      if (!this.value || this.value < 1) {
        this.value = ""; // Xóa giá trị khi đang chỉnh sửa
      }
    });
  });

  // Hàm hiển thị popup
  function showPopup(message) {
    const modal = document.getElementById("quantityPopup");
    const messageElement = document.getElementById("popupMessage");
    messageElement.textContent = message;
    modal.style.display = "block";
  }

  // Đóng popup khi nhấn nút close (X)
  document.querySelector(".close").addEventListener("click", function () {
    document.getElementById("quantityPopup").style.display = "none";
  });

  // Đóng popup khi nhấn bên ngoài modal
  window.addEventListener("click", function (event) {
    const modal = document.getElementById("quantityPopup");
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });

  // Hàm gửi AJAX request để cập nhật giỏ hàng
  function updateCart(itemId, quantity, itemType) {
    // console.log(`${itemType}:`, itemId);
    // console.log("quantity:", quantity);

    let data = {};
    data[itemType] = itemId;
    data["quantity"] = quantity;

    fetch(updateUrl, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": csrfToken,
      },
      body: JSON.stringify(data),
    })
      .then((response) => {
        // console.log("Response status:", response.status);
        if (!response.ok) {
          throw new Error(
            "Cập nhật giỏ hàng thất bại với mã lỗi " + response.status
          );
        }
        return response.json();
      })
      .then((data) => {
        if (data.success) {
          // console.log("Giỏ hàng đã được cập nhật");
          updateTotalPrice2(); // Cập nhật tổng giá trị giỏ hàng
        } else {
          // console.error("Cập nhật giỏ hàng thất bại:", data.message);
        }
      })
      .catch((error) => {
        console.error("Lỗi:", error);
      });
  }

  function updateTotalPrice2() {
    const checkboxes = document.querySelectorAll(".cart-checkbox");
    let totalPrice = 0;

    checkboxes.forEach((checkbox) => {
      // Chỉ tính vào tổng giá nếu checkbox được chọn
      if (checkbox.checked) {
        const price = parseFloat(checkbox.getAttribute("data-price")) || 0;
        const quantity =
          parseInt(
            checkbox.closest("tr").querySelector(".quantity-input").value
          ) || 1;
        totalPrice += price * quantity;
      }
    });

    // Hiển thị tổng tiền đã định dạng
    document.getElementById("totalPrice").textContent =
      numberFormat(totalPrice * 1000, 0, ".", ",") + " ₫";
  }
  // XOA
  const removeButtons = document.querySelectorAll(".cart-remove");

  // Lưu trạng thái checkbox đã chọn
  let checkedItems = [];

  // Lưu lại trạng thái của các checkbox đã chọn
  function saveCheckedItems() {
    checkedItems = [];
    document.querySelectorAll(".cart-checkbox:checked").forEach((checkbox) => {
      checkedItems.push(checkbox.value); // Lưu giá trị của checkbox (ID sản phẩm, cart_item_id hoặc product_variant_id)
    });
  }

  // Khôi phục trạng thái checkbox đã chọn
  function restoreCheckedItems() {
    document.querySelectorAll(".cart-checkbox").forEach((checkbox) => {
      if (checkedItems.includes(checkbox.value)) {
        checkbox.checked = true;
      }
    });
  }

  removeButtons.forEach((button) => {
    button.addEventListener("click", function (event) {
      event.preventDefault(); // Ngừng hành động mặc định

      // Lưu lại trạng thái checkbox đã chọn trước khi xóa
      saveCheckedItems();

      const cartItemId = this.getAttribute("data-cart-item-id");
      const productVariantId = this.getAttribute("data-product-variant-id");

      // Gửi yêu cầu AJAX để xóa sản phẩm
      const data = cartItemId
        ? { cart_item_id: cartItemId }
        : { product_variant_id: productVariantId };
        const tooltipInstance = bootstrap.Tooltip.getInstance(this); // Lấy tooltip đã được gắn
        if (tooltipInstance) {
          tooltipInstance.dispose(); // Hủy tooltip
        }
      fetch(removeUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify(data),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Xóa sản phẩm khỏi giao diện
            const cartItemRow = this.closest("tr");
            if (cartItemRow) {
              cartItemRow.remove();
            }

            // Khôi phục trạng thái checkbox đã chọn
            restoreCheckedItems();

            // Cập nhật lại tổng tiền
            updateTotalPrice2(); // Cập nhật tổng tiền
            updateCartCount();
            // setTimeout(() => {
            //   checkEmptyCart();  // Kiểm tra giỏ hàng trống sau khi cập nhật DOM
            // }, 50); 
          } else {
            alert("Lỗi: " + data.message);
          }
        })
        .catch((error) => {
          console.error("Lỗi:", error);
          alert("Không thể kết nối đến server!");
        });
        function updateCartCount() {
          $.ajax({
              url: '/cart/count', // Thay đổi đường dẫn này
              type: 'GET',
              success: function(data) {
                  $('.cart-count').text(data.count); // Cập nhật số lượng vào phần tử .cart-count
              },
              error: function(xhr) {
                  console.error('Error:', xhr);
              }
          });
      }
    });
  });
  // check gio hang trong
  function checkEmptyCart() {
    const cartItems = document.querySelectorAll(".cart-item"); // Lấy tất cả các phần tử sản phẩm trong giỏ
    const emptyCartMessage = document.querySelector(".cart-empty");
  
    if (cartItems.length === 0) {
      emptyCartMessage.style.display = "block"; // Hiển thị thông báo giỏ hàng trống
    } else {
      emptyCartMessage.style.display = "none"; // Ẩn thông báo giỏ hàng trống
    }
  }
});

function numberFormat(number, decimals, dec_point, thousands_sep) {
  // Chuyển đổi số thành chuỗi với số thập phân
  number = parseFloat(number).toFixed(decimals);

  // Phân tách phần nguyên và phần thập phân
  let parts = number.split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep); // Thêm dấu phân cách hàng nghìn

  // Kết hợp lại
  return parts.join(dec_point);
}
