// PRODUCT
document.addEventListener('DOMContentLoaded', function() {
    // Lắng nghe sự kiện submit trên form
    const form = document.getElementById('myForm'); // Thay 'myForm' bằng id của form của bạn
    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Ngăn chặn submit nếu có lỗi
        }
    });

    // Lắng nghe sự kiện nhập (input) trên từng trường
    document.getElementById('name').addEventListener('input', function() {
        validateName();
    });

    document.getElementById('price_regular').addEventListener('input', function() {
        validatePriceRegular();
        validatePriceSale(); // Kiểm tra lại giá sale nếu có thay đổi giá gốc
    });

    document.getElementById('price_sale').addEventListener('input', function() {
        validatePriceSale();
    });

    document.getElementById('description').addEventListener('input', function() {
        validateDescription();
    });

    document.getElementById('catalogue-select').addEventListener('change', function() {
        validateCatalogue();
    });

    // Hàm kiểm tra toàn bộ form
    function validateForm() {
        let isValid = true;

        if (!validateName()) isValid = false;
        if (!validatePriceRegular()) isValid = false;
        if (!validatePriceSale()) isValid = false;
        if (!validateDescription()) isValid = false;
        if (!validateCatalogue()) isValid = false;

        return isValid;
    }

    // Các hàm kiểm tra từng trường

    function validateName() {
        const name = document.getElementById('name');
        clearError(name);
        if (!name.value.trim()) {
            showError(name, 'Tên sản phẩm không được để trống');
            return false;
        }
        return true;
    }

    function validatePriceRegular() {
        const priceRegular = document.getElementById('price_regular');
        clearError(priceRegular);
        if (!priceRegular.value.trim() || isNaN(priceRegular.value) || Number(priceRegular.value) <= 0) {
            showError(priceRegular, 'Giá gốc phải là số và lớn hơn 0');
            return false;
        }
        return true;
    }

    function validatePriceSale() {
        const priceRegular = document.getElementById('price_regular');
        const priceSale = document.getElementById('price_sale');
        clearError(priceSale);
        
        if (priceSale.value.trim()) {
            const saleValue = Number(priceSale.value);
            const regularValue = Number(priceRegular.value);
            
            // Kiểm tra giá khuyến mãi có phải số âm hoặc 0 trước
            if (saleValue <= 0) {
                showError(priceSale, 'Giá khuyến mãi phải lớn hơn 0');
                return false;
            }

            // Kiểm tra giá khuyến mãi phải nhỏ hơn giá gốc
            if (isNaN(saleValue) || saleValue >= regularValue) {
                showError(priceSale, 'Giá khuyến mãi phải nhỏ hơn giá gốc');
                return false;
            }
        }
        return true;
    }


    function validateDescription() {
        const description = document.getElementById('description');
        clearError(description);
        if (!description.value.trim()) {
            showError(description, 'Mô tả không được để trống');
            return false;
        }
        return true;
    }

    function validateCatalogue() {
        const catalogueSelect = document.getElementById('catalogue-select');
        clearError(catalogueSelect);
        if (catalogueSelect.value === 'Chọn danh mục') {
            showError(catalogueSelect, 'Vui lòng chọn danh mục');
            return false;
        }
        return true;
    }

    // Hàm hiển thị lỗi
    function showError(input, message) {
        const error = document.createElement('div');
        error.className = 'invalid-feedback';
        error.style.color = 'red';
        error.textContent = message;
        input.classList.add('is-invalid');
        input.parentElement.appendChild(error);
    }

    // Hàm xóa lỗi cũ
    function clearError(input) {
        const error = input.parentElement.querySelector('.invalid-feedback');
        if (error) {
            error.remove();
        }
        input.classList.remove('is-invalid');
    }
});

// CHỈNH SỬA HÀNG LOẠT VALIDATE
$(document).ready(function () {
  // Hàm kiểm tra tính hợp lệ của từng trường
  function validateFields() {
    const bulkPrice = $("#bulk_price").val();
    const bulkPriceSale = $("#bulk_price_sale").val();
    const bulkStock = $("#bulk_stock").val();
    let isValid = true; // Biến kiểm tra tính hợp lệ

    // Reset lại thông báo lỗi và trạng thái input
    $("#bulk_price, #bulk_price_sale, #bulk_stock").removeClass("is-invalid");
    $("#error-bulk-price, #error-bulk-price-sale, #error-bulk-stock").text("");

    // Kiểm tra "Giá bán lẻ" nếu có nhập
    if (bulkPrice !== "") {
      if (isNaN(bulkPrice) || parseFloat(bulkPrice) <= 0) {
        $("#bulk_price").addClass("is-invalid");
        $("#error-bulk-price").text("Giá bán lẻ phải lớn hơn 0");
        isValid = false;
      }
    }

    // Kiểm tra "Giá khuyến mãi" nếu có nhập
    if (bulkPriceSale !== "") {
      if (isNaN(bulkPriceSale) || parseFloat(bulkPriceSale) <= 0) {
        $("#bulk_price_sale").addClass("is-invalid");
        $("#error-bulk-price-sale").text("Giá khuyến mãi phải lớn hơn 0");
        isValid = false;
      } else if (
        bulkPrice !== "" &&
        parseFloat(bulkPriceSale) >= parseFloat(bulkPrice)
      ) {
        $("#bulk_price_sale").addClass("is-invalid");
        $("#error-bulk-price-sale").text(
          "Giá khuyến mãi phải nhỏ hơn giá bán lẻ"
        );
        isValid = false;
      }
    }

    // Kiểm tra "Số lượng" nếu có nhập
    if (bulkStock !== "") {
      if (isNaN(bulkStock) || parseFloat(bulkStock) <= 0) {
        $("#bulk_stock").addClass("is-invalid");
        $("#error-bulk-stock").text("Số lượng phải lớn hơn 0");
        isValid = false;
      }
    }

    // Nếu không có lỗi, bật nút "Áp dụng"
    if (isValid) {
      $("#apply-bulk-edit").prop("disabled", false);
    } else {
      $("#apply-bulk-edit").prop("disabled", true);
    }

    return isValid; // Trả về trạng thái hợp lệ
  }

  // Lắng nghe sự kiện input trên các trường để kiểm tra ngay khi nhập
  $("#bulk_price, #bulk_price_sale, #bulk_stock").on("input", function () {
    validateFields(); // Kiểm tra lại tất cả các trường khi người dùng nhập
  });

  // Khi nhấn nút "Áp dụng"
  $("#apply-bulk-edit").on("click", function () {
    if (validateFields()) {
      const bulkPrice = $("#bulk_price").val();
      const bulkPriceSale = $("#bulk_price_sale").val();
      const bulkStock = $("#bulk_stock").val();
      const applyTo = $("#apply_to").val(); // Lấy giá trị của tùy chọn áp dụng

      // Thực hiện áp dụng nếu không có lỗi
      if (applyTo === "all") {
        // Áp dụng cho tất cả các biến thể
        $(".variant").each(function () {
          if (bulkPrice) {
            $(this)
              .find(
                'input[name="variant_prices[]"], input[name="new_variant_prices[]"]'
              )
              .val(bulkPrice);
          }
          if (bulkPriceSale) {
            $(this)
              .find(
                'input[name="variant_sale_prices[]"], input[name="new_variant_sale_prices[]"]'
              )
              .val(bulkPriceSale);
          }
          if (bulkStock) {
            $(this)
              .find(
                'input[name="variant_stocks[]"], input[name="new_variant_stocks[]"]'
              )
              .val(bulkStock);
          }
        });
      } else if (applyTo === "new") {
        // Áp dụng cho chỉ biến thể mới
        $(".variant-new").each(function () {
          if (bulkPrice) {
            $(this).find('input[name="new_variant_prices[]"]').val(bulkPrice);
          }
          if (bulkPriceSale) {
            $(this)
              .find('input[name="new_variant_sale_prices[]"]')
              .val(bulkPriceSale);
          }
          if (bulkStock) {
            $(this).find('input[name="new_variant_stocks[]"]').val(bulkStock);
          }
        });
      }
    } else {
      alert("Vui lòng kiểm tra lại các giá trị đã nhập.");
    }
  });
});

// VALIDATE VARIANT OLD
$(document).ready(function () {
  // Hàm kiểm tra giá trị của từng trường và hiển thị lỗi nếu có
  function validateField(field) {
    const variantId = $(field).closest("tr").data("variant-id");
    const fieldName = $(field).attr("name");

    if (fieldName === "variant_prices[]") {
      const price = $(field).val();
      if (price === "" || isNaN(price) || parseFloat(price) <= 0) {
        $(field).addClass("is-invalid");
        $("#error-variant-price-" + variantId).text(
          "Giá bán lẻ phải lớn hơn 0"
        );
      } else {
        $(field).removeClass("is-invalid");
        $("#error-variant-price-" + variantId).text("");
      }
    }

    if (fieldName === "variant_sale_prices[]") {
      const salePrice = $(field).val();
      const regularPrice = $(field)
        .closest("tr")
        .find('input[name="variant_prices[]"]')
        .val();

      // Kiểm tra nếu trường trống
      if (salePrice === "") {
        $(field).addClass("is-invalid");
        $("#error-variant-sale-price-" + variantId).text(
          "Giá khuyến mãi không được để trống"
        );
      }
      // Kiểm tra nếu giá không phải số hoặc <= 0
      else if (isNaN(salePrice) || parseFloat(salePrice) <= 0) {
        $(field).addClass("is-invalid");
        $("#error-variant-sale-price-" + variantId).text(
          "Giá khuyến mãi phải lớn hơn 0"
        );
      }
      // Kiểm tra nếu giá khuyến mãi lớn hơn hoặc bằng giá gốc
      else if (parseFloat(salePrice) >= parseFloat(regularPrice)) {
        $(field).addClass("is-invalid");
        $("#error-variant-sale-price-" + variantId).text(
          "Giá khuyến mãi phải nhỏ hơn giá gốc"
        );
      }
      // Nếu không có lỗi
      else {
        $(field).removeClass("is-invalid");
        $("#error-variant-sale-price-" + variantId).text("");
      }
    }

    if (fieldName === "variant_stocks[]") {
      const stock = $(field).val();
      if (stock === "" || isNaN(stock) || parseFloat(stock) <= 0) {
        $(field).addClass("is-invalid");
        $("#error-variant-stock-" + variantId).text("Số lượng phải lớn hơn 0");
      } else {
        $(field).removeClass("is-invalid");
        $("#error-variant-stock-" + variantId).text("");
      }
    }
  }

  // Lắng nghe sự kiện input để kiểm tra ngay khi người dùng nhập
  $(
    'input[name="variant_prices[]"], input[name="variant_sale_prices[]"], input[name="variant_stocks[]"]'
  ).on("input", function () {
    validateField(this); // Kiểm tra trường đang nhập
  });

  // Kiểm tra tất cả các trường khi submit form
  $("#myForm").on("submit", function (event) {
    let isValid = true;

    // Kiểm tra tất cả các trường
    $(
      'input[name="variant_prices[]"], input[name="variant_sale_prices[]"], input[name="variant_stocks[]"]'
    ).each(function () {
      validateField(this);
      if ($(this).hasClass("is-invalid")) {
        isValid = false;
      }
    });

    // Nếu có lỗi, ngăn không cho phép submit form
    if (!isValid) {
      event.preventDefault(); // Ngăn chặn submit form nếu có lỗi
    }
  });
});

// VARIANT NEW
$(document).ready(function() {
    // Hàm kiểm tra tính hợp lệ của từng trường
    function validateField(field) {
        const fieldName = $(field).attr('name');
        
        // Kiểm tra giá bán lẻ (new_variant_prices[])
        if (fieldName === 'new_variant_prices[]') {
            const price = $(field).val();
            if (price === '' || isNaN(price) || parseFloat(price) <= 0) {
                $(field).addClass('is-invalid');
                $(field).siblings('.error-message').text('Giá bán lẻ phải lớn hơn 0');
            } else {
                $(field).removeClass('is-invalid');
                $(field).siblings('.error-message').text('');
            }
        }

        // Kiểm tra giá khuyến mãi (new_variant_sale_prices[])
        if (fieldName === 'new_variant_sale_prices[]') {
            const salePrice = $(field).val();
            const regularPrice = $(field).closest('tr').find('input[name="new_variant_prices[]"]').val();
            if (salePrice === '') {
                $(field).addClass('is-invalid');
                $(field).siblings('.error-message').text('Giá khuyến mãi không được để trống');
            } else if (isNaN(salePrice) || parseFloat(salePrice) <= 0) {
                $(field).addClass('is-invalid');
                $(field).siblings('.error-message').text('Giá khuyến mãi phải lớn hơn 0');
            } else if (parseFloat(salePrice) >= parseFloat(regularPrice)) {
                $(field).addClass('is-invalid');
                $(field).siblings('.error-message').text('Giá khuyến mãi phải nhỏ hơn giá bán lẻ');
            } else {
                $(field).removeClass('is-invalid');
                $(field).siblings('.error-message').text('');
            }
        }

        // Kiểm tra số lượng (new_variant_stocks[])
        if (fieldName === 'new_variant_stocks[]') {
            const stock = $(field).val();
            if (stock === '' || isNaN(stock) || parseFloat(stock) <= 0) {
                $(field).addClass('is-invalid');
                $(field).siblings('.error-message').text('Số lượng phải lớn hơn 0');
            } else {
                $(field).removeClass('is-invalid');
                $(field).siblings('.error-message').text('');
            }
        }
    }

    // Lắng nghe sự kiện input cho các trường biến thể mới và kiểm tra ngay lập tức khi người dùng nhập
    $(document).on('input', 'input[name="new_variant_prices[]"], input[name="new_variant_sale_prices[]"], input[name="new_variant_stocks[]"]', function() {
        validateField(this); // Kiểm tra trường đang nhập ngay lập tức
    });

    // Kiểm tra toàn bộ khi submit form
    $('#myForm').on('submit', function(event) {
        let isValid = true;

        // Kiểm tra tất cả các trường biến thể mới
        $('input[name="new_variant_prices[]"], input[name="new_variant_sale_prices[]"], input[name="new_variant_stocks[]"]').each(function() {
            validateField(this); // Kiểm tra từng trường
            if ($(this).hasClass('is-invalid')) {
                isValid = false; // Nếu có lỗi, ngăn không cho submit
            }
        });

        // Ngăn chặn submit nếu có lỗi
        if (!isValid) {
            event.preventDefault();
        }
    });
});
