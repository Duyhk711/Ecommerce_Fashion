document.addEventListener("DOMContentLoaded", function () {
  let selectedAttributes = [];

  // Lấy danh sách thuộc tính từ server
  fetch("/admin/get-attributes", {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      const selectElement = document.getElementById("val-select2");
      // Render danh sách thuộc tính ra dropdown
      data.forEach((attribute) => {
        const option = document.createElement("option");
        option.value = attribute.id;
        option.textContent = attribute.name;
        selectElement.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Không thể lấy dữ liệu thuộc tính từ server:", error);
    });

  // Khi chọn thuộc tính từ dropdown
  document
    .getElementById("val-select2")
    .addEventListener("change", function () {
      const attributeId = this.value;
      const attributeName = this.options[this.selectedIndex].text; // Lấy tên thuộc tính đã chọn

      if (!attributeId) return;

      // Fetch danh sách giá trị của thuộc tính được chọn
      fetch(`/admin/get-attribute-values/${attributeId}`, {
        method: "GET",
      })
        .then((response) => response.json())
        .then((selectedAttribute) => {
          // Thêm card thuộc tính
          addAttributeCard(selectedAttribute, attributeName);

          // Xóa thuộc tính khỏi dropdown
          const optionToRemove = this.querySelector(
            `option[value="${attributeId}"]`
          );
          if (optionToRemove) optionToRemove.remove();

          // Reset lại dropdown
          this.value = "";
        })
        .catch((error) => {
          console.error("Không thể lấy giá trị thuộc tính:", error);
        });
    });

  // Hàm thêm card thuộc tính vào DOM
  function addAttributeCard(selectedAttribute, attributeName) {
    const attributeCard = `
        <div class="card mb-3" data-attribute-id="${
          selectedAttribute.id
        }" data-attribute-name="${attributeName}">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">${selectedAttribute.name}</h5>
                <a href="#" class="text-danger remove-attribute">Xoá</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="attribute_name">
                                <label>Tên:</label>
                                <strong>${selectedAttribute.name}</strong>
                            </td>
                            <td>
                                <label for="attributes">Chọn giá trị:</label>
                                <select class="attributes-select form-control" name="attribute_value_ids[${
                                  selectedAttribute.id
                                }][]" multiple="multiple" style="width: 100%;">
                                    ${selectedAttribute.attribute_values
                                      .map(
                                        (value) =>
                                          `<option value="${value.id}" data-value-name="${value.value}">${value.value}</option>`
                                      )
                                      .join("")}
                                </select>
                                <div class="mt-2">
                                    <button class="btn btn-alt-secondary btn-sm select_all_attributes">Chọn tất cả</button>
                                    <button class="btn btn-alt-secondary btn-sm select_no_attributes">Không chọn</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>`;

    // Thêm card vào container
    document
      .getElementById("attributes-container")
      .insertAdjacentHTML("beforeend", attributeCard);

    // Khởi tạo Select2 cho select mới thêm
    const selectElement = document.querySelector(
      `.attributes-select[name="attribute_value_ids[${selectedAttribute.id}][]"]`
    );
    $(selectElement).select2();

    // Lắng nghe sự thay đổi của select để cập nhật nút lưu
    $(selectElement).on("change", updateSaveButtonState);

    // Cập nhật trạng thái của nút lưu
    updateSaveButtonState();
  }

  // Xử lý xóa thuộc tính
  document.addEventListener("click", function (e) {
    if (e.target.classList.contains("remove-attribute")) {
      e.preventDefault();
      const card = e.target.closest(".card");
      const attributeId = card.getAttribute("data-attribute-id");
      const attributeName = card.querySelector(".card-header h5").textContent;

      // Thêm lại thuộc tính vào dropdown khi xóa card
      const select2 = document.getElementById("val-select2");
      const newOption = document.createElement("option");
      newOption.value = attributeId;
      newOption.textContent = attributeName;
      select2.appendChild(newOption);

      // Xóa card thuộc tính
      card.remove();

      // Cập nhật trạng thái của nút lưu
      updateSaveButtonState();
    }
  });

  // Xử lý chọn tất cả giá trị
  document.addEventListener("click", function (e) {
    if (e.target.classList.contains("select_all_attributes")) {
      e.preventDefault();
      const select = e.target
        .closest(".card-body")
        .querySelector(".attributes-select");
      Array.from(select.options).forEach((option) => (option.selected = true));
      $(select).trigger("change");

      // Cập nhật trạng thái của nút lưu
      updateSaveButtonState();
    }
  });

  // Xử lý không chọn giá trị
  document.addEventListener("click", function (e) {
    if (e.target.classList.contains("select_no_attributes")) {
      e.preventDefault();
      const select = e.target
        .closest(".card-body")
        .querySelector(".attributes-select");
      Array.from(select.options).forEach((option) => (option.selected = false));
      $(select).trigger("change");

      // Cập nhật trạng thái của nút lưu
      updateSaveButtonState();
    }
  });

  // Xử lý nút lưu thuộc tính
  document
    .getElementById("save-attributes")
    .addEventListener("click", function () {
      selectedAttributes = []; // Xóa dữ liệu cũ

      // Thu thập dữ liệu thuộc tính đã chọn
      document
        .querySelectorAll("#attributes-container .card")
        .forEach((card) => {
          const attributeId = card.getAttribute("data-attribute-id");
          const attributeName = card.getAttribute("data-attribute-name");
          const selectedValues = $(card).find(".attributes-select").val();

          const selectedValueNames = [];
          $(card)
            .find(".attributes-select option:selected")
            .each(function () {
              selectedValueNames.push($(this).attr("data-value-name"));
            });

          if (selectedValues && selectedValues.length > 0) {
            selectedAttributes.push({
              attribute_id: attributeId,
              attribute_name: attributeName,
              values: selectedValues,
              value_names: selectedValueNames,
            });
          }
        });

      // Kiểm tra nếu không có thuộc tính nào được chọn
      if (selectedAttributes.length === 0) {
        alert("Vui lòng chọn ít nhất một giá trị thuộc tính.");
        return;
      }

      // Lưu tạm dữ liệu vào biến (không gửi đến server)
      console.log("Thuộc tính đã được lưu tạm:", selectedAttributes);
      alert("Thuộc tính đã được lưu tạm. Bạn có thể thao tác với dữ liệu này.");
    });

  // Cập nhật trạng thái của nút lưu
  function updateSaveButtonState() {
    const saveButton = document.getElementById("save-attributes");
    let hasSelectedValues = false;

    // Kiểm tra nếu có ít nhất một thuộc tính có giá trị được chọn
    document.querySelectorAll("#attributes-container .card").forEach((card) => {
      const selectedValues = $(card).find(".attributes-select").val();
      if (selectedValues && selectedValues.length > 0) {
        hasSelectedValues = true;
      }
    });

    // Nếu có ít nhất một thuộc tính có giá trị được chọn, kích hoạt nút lưu
    saveButton.disabled = !hasSelectedValues;
  }

  // Khởi tạo: nút lưu ban đầu bị vô hiệu hóa
  updateSaveButtonState();
});

document.addEventListener("DOMContentLoaded", function () {
  let selectedAttributes = [];
  let variantsData = []; // Biến để lưu tạm biến thể, cần được định nghĩa ở phạm vi toàn cục
  const maxVariants = 50; // Giới hạn tạo tối đa 50 biến thể

  // Khởi tạo CKEditor cho phần mô tả chi tiết
  if (typeof ClassicEditor !== "undefined") {
    ClassicEditor.create(document.querySelector("#editor"))
      .then((editor) => {
        window.editorInstance = editor;
      })
      .catch((error) => {
        console.error("Lỗi khi khởi tạo CKEditor:", error);
      });
  }

  // Ẩn nút "Thêm giá" ban đầu
  document.getElementById("apply-price-to-all").style.display = "none";

  // Khi nhấn nút "Tạo ra các biến thể"
  document.getElementById("generate-variants").addEventListener("click", function () {
    if (selectedAttributes.length === 0) {
      alert("Vui lòng chọn ít nhất một thuộc tính trước khi tạo biến thể!");
      return;
    }

    function generateCombinations(arr, index = 0, current = [], result = []) {
      if (index === arr.length) {
        result.push([...current]);
        return result;
      }
      arr[index].values.forEach((value) => {
        current.push({
          attribute_id: arr[index].attribute_id,
          attribute_name: arr[index].attribute_name,
          value_id: value.id,
          value_name: value.value_name,
        });
        generateCombinations(arr, index + 1, current, result);
        current.pop();
      });
      return result;
    }

    const variants = generateCombinations(selectedAttributes);

    if (variants.length > maxVariants) {
      alert(`Bạn chỉ có thể tạo tối đa ${maxVariants} biến thể.`);
      return;
    }

    document.getElementById("variant-list").innerHTML = "";

    variants.forEach((variant, index) => {
      const collapseId = `collapse-${index}`;
      const variantNumber = index + 1;
      
      // Tạo SKU tự động
      const generatedSKU = `PRD-${Math.random().toString(36).substring(2, 8).toUpperCase()}-${variantNumber}`;

      const variantInputs = variant
        .map((attr) => {
          const attributeId = attr.attribute_id || "Không xác định";
          const valueId = attr.value_id || "Không xác định";
          const valueName = attr.value_name || "Không xác định";

          return `
                  <input type="text" class="form-control me-2" name="variant_attributes[${index}][]" value="${valueName}" readonly>
                  <input type="hidden" name="variant_attributes[${index}][attribute_id]" value="${attributeId}">
                  <input type="hidden" name="variant_attributes[${index}][value_id]" value="${valueId}">
              `;
        })
        .join("");

      const variantHtml = `
              <div class="row justify-content-between align-items-center variant-item " style="border: 1px solid rgba(128, 128, 128, 0.318); padding: 10px 0" data-bs-toggle="collapse" data-bs-target="#${collapseId}" aria-expanded="false" aria-controls="${collapseId}">
                  <div class="col-8 d-flex">
                      <div class="variant-number me-2"><strong>#${variantNumber}</strong></div>
                      ${variantInputs}
                  </div>
                  <div class="col-4 text-end">
                      <a href="#" class="text-danger remove-variant">Xoá</a>
                  </div>
              </div>
              <div class="collapse mt-3" id="${collapseId}">
                  <div class="card card-body mb-3">
                        <div class="row mb-3">
                         <div class="col-md-6 d-flex align-items-center">
                            <label for="image-${index}" class="btn  me-2">Tải ảnh lên</label>
                            <input type="file" id="image-${index}" class="form-control-file hidden-input" name="image[${index}]" accept="image/*" style="display:none;">
                            <div class="col-md-3">
                                <img id="preview-${index}" src="#" alt="Xem trước ảnh" style="display: none; width: 100px; margin-top: 0;">
                            </div>
                        </div>

                          <div class="col-md-6">
                              <div class="form-group mb-3">
                                  <label>Mã sản phẩm:</label>
                                  <input type="text" class="form-control" name="sku[${index}]" value="${generatedSKU}">
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group mb-3">
                                  <label>Giá (₫)</label>
                                  <input type="text" class="form-control" name="price_regular[${index}]">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group mb-3">
                                  <label>Giá ưu đãi (₫)</label>
                                  <input type="text" class="form-control" name="price_sale[${index}]">
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group mb-3">
                                  <label>Số lượng trong kho</label>
                                  <input type="number" class="form-control" name="stock[${index}]" value="0" step="any">
                              </div>
                          </div>
                      </div>
                  </div>
              </div >`;

      document.getElementById("variant-list").insertAdjacentHTML("beforeend", variantHtml);
      document.getElementById(`image-${index}`).addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            const previewImage = document.getElementById(`preview-${index}`);
            previewImage.src = e.target.result;
            previewImage.style.display = "block";
          };
          reader.readAsDataURL(file);
        }
      });
   
    });

    // Hiển thị nút "Thêm giá" sau khi tạo biến thể
    document.getElementById("apply-price-to-all").style.display = "block";
  });

  // Nút xóa biến thể
  document.addEventListener("click", function (e) {
    if (e.target.classList.contains("remove-variant")) {
      e.preventDefault();
      e.target.closest(".variant-item").nextElementSibling.remove();
      e.target.closest(".variant-item").remove();
    }
  });

  document.getElementById("save-attributes").addEventListener("click", function () {
    selectedAttributes = [];

    document.querySelectorAll("#attributes-container .card").forEach((card) => {
      const attributeId = card.getAttribute("data-attribute-id");
      const attributeName = card.getAttribute("data-attribute-name");
      const selectedValues = $(card).find(".attributes-select").val();

      const selectedValueNames = [];
      $(card)
        .find(".attributes-select option:selected")
        .each(function () {
          selectedValueNames.push({
            id: $(this).val(),
            value_name: $(this).attr("data-value-name"),
          });
        });

      if (selectedValues && selectedValues.length > 0) {
        selectedAttributes.push({
          attribute_id: attributeId,
          attribute_name: attributeName,
          values: selectedValueNames,
        });
      }
    });

    console.log("Thuộc tính đã được lưu tạm:", selectedAttributes);
  });

  document.getElementById("save-variants").addEventListener("click", function () {
    variantsData = [];

    document.querySelectorAll("#variant-list .variant-item").forEach((item, index) => {
      const variantIndex = index;
      const attributes = Array.from(
        item.querySelectorAll(`input[name="variant_attributes[${variantIndex}][]"]`)
      ).map((input) => input.value);
      const attributeIds = Array.from(
        item.querySelectorAll(`input[name="variant_attributes[${variantIndex}][attribute_id]"]`)
      ).map((input) => input.value);
      const valueIds = Array.from(
        item.querySelectorAll(`input[name="variant_attributes[${variantIndex}][value_id]"]`)
      ).map((input) => input.value);

      const sku = document.querySelector(`input[name="sku[${variantIndex}]"]`).value;
      const priceRegular = document.querySelector(`input[name="price_regular[${variantIndex}]"]`).value;
      const priceSale = document.querySelector(`input[name="price_sale[${variantIndex}]"]`).value;
      const stock = document.querySelector(`input[name="stock[${variantIndex}]"]`).value;

      const imageInput = document.querySelector(`input[name="image[${variantIndex}]"]`);
      const imageFile = imageInput.files.length > 0 ? imageInput.files[0] : null;

      variantsData.push({
        attributes: attributes,
        attribute_ids: attributeIds,
        value_ids: valueIds,
        sku: sku,
        price_regular: priceRegular,
        price_sale: priceSale,
        stock: stock,
        image: imageFile, // Lưu đối tượng file thay vì chỉ lưu tên file
      });
    });

    console.log("Biến thể đã được lưu tạm:", variantsData);
    alert("Biến thể đã được lưu tạm thời.");
  });

  // Hiển thị popup khi nhấn nút "Thêm giá"
  document.getElementById("apply-price-to-all").addEventListener("click", function () {
    // Tạo một popup đơn giản bằng cách sử dụng Bootstrap Modal hoặc tạo popup custom
    const popupHtml = `
      <div id="pricePopup" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Nhập giá chung cho các biến thể</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="input-price-for-all">Giá gốc (₫)</label>
                <input type="text" id="input-price-regular" class="form-control" placeholder="Nhập giá gốc">
              </div>
              <div class="form-group">
                <label for="input-price-sale">Giá ưu đãi (₫)</label>
                <input type="text" id="input-price-sale" class="form-control" placeholder="Nhập giá ưu đãi">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="save-price-for-all" class="btn btn-primary">Lưu</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
          </div>
        </div>
      </div>`;

    // Thêm popup vào body
    document.body.insertAdjacentHTML('beforeend', popupHtml);

    // Hiển thị popup
    $('#pricePopup').modal('show');

    // Khi ấn nút "Lưu" trong popup
    document.getElementById("save-price-for-all").addEventListener("click", function () {
      const priceRegular = document.getElementById("input-price-regular").value;
      const priceSale = document.getElementById("input-price-sale").value;

      // Áp dụng giá gốc và giá sale cho tất cả biến thể
      document.querySelectorAll(`input[name^="price_regular"]`).forEach(input => {
        input.value = priceRegular;
      });
      document.querySelectorAll(`input[name^="price_sale"]`).forEach(input => {
        input.value = priceSale;
      });

      // Ẩn và xóa popup sau khi lưu
      $('#pricePopup').modal('hide');
      document.getElementById("pricePopup").remove();
    });
  });
});



  // document
  //   .getElementById("save-product")
  //   .addEventListener("click", function () {
  //     const name = document.getElementById("name").value;
  //     const sku = document.getElementById("sku").value;
  //     const priceRegular = document.getElementById("price_regular").value;
  //     const priceSale = document.getElementById("price_sale").value;
  //     const description = document.getElementById("description").value;
  //     const catalogue = document.getElementById("catalogue-select").value;
  //     const content = window.editorInstance
  //       ? window.editorInstance.getData()
  //       : "";

  //     const isActive = document.querySelector(
  //       'input[name="is_active"]'
  //     ).checked;
  //     const isNew = document.querySelector('input[name="is_new"]').checked;
  //     const isHotDeal = document.querySelector(
  //       'input[name="is_hot_deal"]'
  //     ).checked;
  //     const isShowHome = document.querySelector(
  //       'input[name="is_show_home"]'
  //     ).checked;

  //     // Lấy ảnh chính
  //     const mainImage = document.getElementById("main_image").files[0];

  //     // Lấy ảnh phụ
  //     const galleryImages = document.getElementById("gallery_images").files;

  //     if (variantsData.length === 0) {
  //       alert("Vui lòng tạo biến thể trước khi gửi sản phẩm!");
  //       return;
  //     }

  //     const productData = {
  //       name: name,
  //       sku: sku,
  //       price_regular: priceRegular,
  //       price_sale: priceSale,
  //       description: description,
  //       content: content,
  //       catalogue: catalogue,
  //       is_active: isActive,
  //       is_new: isNew,
  //       is_hot_deal: isHotDeal,
  //       is_show_home: isShowHome,
  //       variants: variantsData.map((variant) => ({
  //         ...variant,
  //         image: null, // Chuyển đối tượng file thành null để gửi qua FormData
  //       })),
  //     };

  //     console.log("Dữ liệu sản phẩm:", productData);

  //     const formData = new FormData();
  //     formData.append("productData", JSON.stringify(productData));

  //     // Gửi ảnh chính
  //     if (mainImage) {
  //       formData.append("main_image", mainImage);
  //     }

  //     // Gửi ảnh phụ (gallery_images[])
  //     Array.from(galleryImages).forEach((file, index) => {
  //       formData.append(`gallery_images[]`, file);
  //     });

  //     // Gửi ảnh biến thể (variant_images[index])
  //     variantsData.forEach((variant, index) => {
  //       const variantImageInput = document.querySelector(
  //         `input[name="image[${index}]"]`
  //       );

  //       if (variantImageInput && variantImageInput.files.length > 0) {
  //         const variantImageFile = variantImageInput.files[0]; // Lấy file ảnh biến thể

  //         // Kiểm tra và thêm ảnh biến thể vào FormData
  //         formData.append(`variant_images[${index}]`, variantImageFile); // Gửi file ảnh biến thể qua FormData
  //       }
  //     });

  //     // Gửi dữ liệu lên server
  //     fetch("/admin/products/add", {
  //       method: "POST",
  //       headers: {
  //         "X-CSRF-TOKEN": csrfToken,
  //       },
  //       body: formData,
  //     })
  //       .then((response) => response.json())
  //       .then((data) => {
  //         console.log("Thành công:", data);
  //         alert("Sản phẩm đã được thêm thành công!");
  //       })
  //       .catch((error) => {
  //         console.error("Lỗi:", error);
  //         alert("Có lỗi xảy ra khi thêm sản phẩm.");
  //       });
  //   });
