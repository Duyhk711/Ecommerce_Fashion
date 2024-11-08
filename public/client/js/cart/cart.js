document.addEventListener("DOMContentLoaded", function () {
  const checkAll = document.getElementById("checkAll");
  const checkboxes = document.querySelectorAll(".cart-checkbox");
  const totalPriceElement = document.getElementById("totalPrice");
  const cartTable = document.querySelector("tbody");
  const cartContainer = document.querySelector(".main-col");

  // Cập nhật tổng tiền
  function updateTotalPrice() {
    let totalPrice = 0;
    checkboxes.forEach((checkbox) => {
      if (checkbox.checked) {
        const price = parseFloat(checkbox.getAttribute("data-price"));
        const quantity = parseInt(
          checkbox.closest("tr").querySelector(".quantity-input").value
        );
        totalPrice += price * quantity;
      }
    });
    totalPriceElement.textContent = numberFormat(totalPrice * 1000, 0, '.', ',') + " ₫";
  }

  // Chức năng chọn tất cả
  checkAll.addEventListener("change", function () {
    checkboxes.forEach((checkbox) => {
      checkbox.checked = checkAll.checked;
    });
    updateTotalPrice();
  });

  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", updateTotalPrice);
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
          updateTotalPrice(); // Cập nhật tổng giá trị giỏ hàng
        } else {
          // console.error("Cập nhật giỏ hàng thất bại:", data.message);
        }
      })
      .catch((error) => {
        console.error("Lỗi:", error);
      });
  }

  // Xử lý nút xóa sản phẩm
  const removeButtons = document.querySelectorAll(".cart-remove");

  // removeButtons.forEach((button) => {
  //   button.addEventListener("click", function (event) {
  //     event.preventDefault();

  //     const form = this.closest("form");
  //     const formData = new FormData(form);

  //     fetch(form.action, {
  //       method: "POST",
  //       headers: {
  //         "X-CSRF-TOKEN": csrfToken,
  //       },
  //       body: formData,
  //     })
  //       .then((response) => response.json())
  //       .then((data) => {
  //         if (data.success) {
  //           // Xóa hàng sản phẩm đã xóa
  //           form.closest("tr").remove();
  //           updateTotalPrice2(); // Cập nhật lại tổng tiền

  //           // Kiểm tra nếu giỏ hàng trống
  //           if (cartTable.children.length === 0) {
  //             cartContainer.innerHTML = `
  //               <div class="cart-empty">
  //                   <div class="text-center">
  //                       <!-- Hình ảnh giỏ hàng trống -->
  //                       <img src="/client/images/empty-cart.png" alt="Giỏ hàng trống" class="img-fluid" style="max-width: 300px;">
  //                       <h3 class="mt-3">Giỏ hàng của bạn đang trống!</h3>
  //                       <p>Hãy tiếp tục mua sắm và thêm sản phẩm vào giỏ hàng của bạn.</p>
  //                       <!-- Nút tiếp tục mua sắm -->
  //                       <a href="/shop" class="btn btn-primary mt-4">Tiếp tục mua sắm</a>
  //                   </div>
  //               </div>`;
  //           }
  //         } else {
  //           alert("Lỗi: " + data.message);
  //         }
  //       })
  //       .catch((error) => {
  //         console.error("Lỗi:", error);
  //       });
  //   });
  // });
  removeButtons.forEach((button) => {
    button.addEventListener("click", function (event) {
      event.preventDefault();
  
      const form = this.closest("form");
      const formData = new FormData(form);
  
      fetch(form.action, {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": csrfToken,
        },
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Xóa hàng sản phẩm đã xóa
            form.closest("tr").remove();
            updateTotalPrice2(); // Cập nhật lại tổng tiền sau khi xóa sản phẩm
  
            // Kiểm tra nếu giỏ hàng trống
            if (cartTable.children.length === 0) {
              cartContainer.innerHTML = `
                <div class="cart-empty">
                    <div class="text-center">
                        <!-- Hình ảnh giỏ hàng trống -->
                        <img src="/client/images/empty-cart.png" alt="Giỏ hàng trống" class="img-fluid" style="max-width: 300px;">
                        <h3 class="mt-3">Giỏ hàng của bạn đang trống!</h3>
                        <p>Hãy tiếp tục mua sắm và thêm sản phẩm vào giỏ hàng của bạn.</p>
                        <!-- Nút tiếp tục mua sắm -->
                        <a href="/shop" class="btn btn-primary mt-4">Tiếp tục mua sắm</a>
                    </div>
                </div>`;
            }
          } else {
            alert("Lỗi: " + data.message);
          }
        })
        .catch((error) => {
          console.error("Lỗi:", error);
        });
    });
  });
  
});

// Cập nhật lại tổng tiền khi xóa sản phẩm
// function updateTotalPrice2() {
//   const checkboxes = document.querySelectorAll(".cart-checkbox");
//   let totalPrice = 0;

//   checkboxes.forEach((checkbox) => {
//     const price = parseFloat(checkbox.getAttribute("data-price"));
//     const quantity = parseInt(
//       checkbox.closest("tr").querySelector(".quantity-input").value
//     );
//     totalPrice += price * quantity;
//   });

//   document.getElementById("totalPrice").textContent =
//     totalPrice.toLocaleString("vi-VN") + " đ";
// }
function updateTotalPrice2() {
  const checkboxes = document.querySelectorAll(".cart-checkbox");
  let totalPrice = 0;

  checkboxes.forEach((checkbox) => {
    // Chỉ tính vào tổng giá nếu checkbox được chọn
    if (checkbox.checked) {
      const price = parseFloat(checkbox.getAttribute("data-price")) || 0;
      const quantity = parseInt(
        checkbox.closest("tr").querySelector(".quantity-input").value
      ) || 1;
      totalPrice += price * quantity;
    }
  });

  // Hiển thị tổng tiền đã định dạng
  document.getElementById("totalPrice").textContent = 
    totalPrice.toLocaleString("vi-VN") + "₫";
}


function numberFormat(number, decimals, dec_point, thousands_sep) {
  // Chuyển đổi số thành chuỗi với số thập phân
  number = parseFloat(number).toFixed(decimals);
  
  // Phân tách phần nguyên và phần thập phân
  let parts = number.split('.');
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep); // Thêm dấu phân cách hàng nghìn
  
  // Kết hợp lại
  return parts.join(dec_point);
}
