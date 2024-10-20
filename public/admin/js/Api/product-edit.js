document.addEventListener("DOMContentLoaded", function () {
    let selectedAttributes = [];
    const productId = 1; // Giả sử bạn có biến productId từ server hoặc URL

    // Lấy danh sách thuộc tính của sản phẩm hiện tại
    fetch(`/admin/get-product-attributes/${productId}`, {
      method: "GET",
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Dữ liệu thuộc tính sản phẩm từ DB:", data); 
        const attributesContainer = document.getElementById("attributes-container");

        // Duyệt qua các thuộc tính đã có của sản phẩm
        data.attributes.forEach((attribute) => {
          addAttributeCard(attribute, attribute.name, attribute.selected_values);
          
          // Không cần xóa thuộc tính khỏi dropdown, chỉ ẩn đi
          const optionToHide = document.querySelector(
            `#val-select2 option[value="${attribute.id}"]`
          );
          if (optionToHide) optionToHide.style.display = "none"; // Ẩn thuộc tính đã chọn
        });
      })
      .catch((error) => {
        console.error("Không thể load thuộc tính sản phẩm:", error);
      });

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
    document.getElementById("val-select2").addEventListener("change", function () {
        const attributeId = this.value;
        const attributeName = this.options[this.selectedIndex].text;

        if (!attributeId) return;

        // Fetch danh sách giá trị của thuộc tính được chọn
        fetch(`/admin/get-attribute-values/${attributeId}`, {
          method: "GET",
        })
          .then((response) => response.json())
          .then((selectedAttribute) => {
            addAttributeCard(selectedAttribute, attributeName, []); // Chỉ thêm giá trị mới

            // Ẩn thuộc tính khỏi dropdown
            const optionToHide = this.querySelector(
              `option[value="${attributeId}"]`
            );
            if (optionToHide) optionToHide.style.display = "none"; // Ẩn thuộc tính đã chọn

            // Reset lại dropdown
            this.value = "";
          })
          .catch((error) => {
            console.error("Không thể lấy giá trị thuộc tính:", error);
          });
      });

    // Hàm thêm card thuộc tính vào DOM
    function addAttributeCard(selectedAttribute, attributeName, selectedValues = []) {
      const attributeCard = `
          <div class="card mb-3" data-attribute-id="${selectedAttribute.id}" data-attribute-name="${attributeName}">
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
                                  <select class="attributes-select form-control" name="attribute_value_ids[${selectedAttribute.id}][]" multiple="multiple" style="width: 100%;">
                                      ${selectedAttribute.attribute_values
                                        .map(
                                          (value) => `<option value="${value.id}" ${selectedValues.includes(value.id) ? "selected" : ""}>${value.value}</option>`
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
      document.getElementById("attributes-container").insertAdjacentHTML("beforeend", attributeCard);

      // Khởi tạo Select2 cho select mới thêm
      const selectElement = document.querySelector(`.attributes-select[name="attribute_value_ids[${selectedAttribute.id}][]"]`);
      $(selectElement).select2();

      // Lắng nghe sự thay đổi của select để cập nhật nút lưu
      $(selectElement).on("change", updateSaveButtonState);

      // Cập nhật trạng thái của nút lưu
      updateSaveButtonState();
    }

    // Xử lý xóa thuộc tính khỏi card
    document.addEventListener("click", function (e) {
      if (e.target.classList.contains("remove-attribute")) {
        e.preventDefault();
        const card = e.target.closest(".card");
        const attributeId = card.getAttribute("data-attribute-id");
        const attributeName = card.querySelector(".card-header h5").textContent;

        // Hiện lại thuộc tính vào dropdown khi xóa card
        const select2 = document.getElementById("val-select2");
        const optionToShow = select2.querySelector(`option[value="${attributeId}"]`);
        if (optionToShow) optionToShow.style.display = "block"; // Hiện lại thuộc tính

        // Xóa card thuộc tính
        card.remove();

        // Cập nhật trạng thái của nút lưu
        updateSaveButtonState();
      }
    });


  
    // Xử lý chọn tất cả giá trị
    document.addEventListener("click", function (e) {
      if (e.target.classList.contains("select_all_attributes")) {
        e.preventDefault(); // Ngăn chặn gửi form khi nhấn nút
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
        e.preventDefault(); // Ngăn chặn gửi form khi nhấn nút
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
      .addEventListener("click", function (event) {
        event.preventDefault(); // Ngăn chặn gửi form khi nhấn nút "Lưu thuộc tính"
        
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
    let productData = {
      selectedAttributes: [],
      variantsData: [],
    }; // Biến chung để lưu cả thuộc tính và biến thể
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
      if (productData.selectedAttributes.length === 0) {
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
  
      const variants = generateCombinations(productData.selectedAttributes);
  
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
                        <label for="image-${index}" class="btn  btn btn-alt-primary me-1 mb-3"> <i class="fa fa-fw fa-upload opacity-50 me-1"></i>Tải ảnh lên</label>
                        <input type="file" id="image-${index}" class="form-control-file hidden-input" accept="image/*" style="display:none;">
                        <div class="col-md-3">
                            <img id="preview-${index}" src="#" alt="Xem trước ảnh" style="display: none; width: 100px; margin-top: 0;">
                        </div>
                    </div>
        
                      <div class="col-md-6">
                          <div class="form-group mb-3">
                              <label>Mã sản phẩm: </label>
                              <input type="text" class="form-control" id="sku-${index}" value="${generatedSKU}">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group mb-3">
                              <label>Giá: </label>
                              <input type="number" class="form-control" id="price_regular-${index}" placeholder="Nhập giá sản phẩm">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group mb-3">
                              <label>Giá khuyến mãi: </label>
                              <input type="number" class="form-control" id="price_sale-${index}" placeholder="Nhập giá khuyến mãi">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group mb-3">
                              <label>Số lượng trong kho</label>
                              <input type="number" class="form-control" id="stock-${index}" value="" placeholder="Nhập vào số lượng">
                          </div>
                      </div>
                  </div>
              </div>
            </div>`;
        
  
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
  
    document.getElementById("save-attributes").addEventListener("click", function (e) {
      e.preventDefault();
      productData.selectedAttributes = []; // Xóa dữ liệu thuộc tính trước đó
  
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
          productData.selectedAttributes.push({
            attribute_id: attributeId,
            attribute_name: attributeName,
            values: selectedValueNames,
          });
        }
      });
  
      console.log("Thuộc tính đã được lưu tạm:", productData.selectedAttributes);
    });
  
    document.getElementById("save-variants").addEventListener("click", function () {
      productData.variantsData = []; // Xóa dữ liệu biến thể trước đó
  
      // Lấy tất cả các item variant
      const items = document.querySelectorAll("#variant-list .variant-item");
      const promises = []; // Tạo mảng lưu trữ các Promise
  
      items.forEach((item, index) => {
          const attributes = Array.from(
              item.querySelectorAll(`input[name="variant_attributes[${index}][]"]`)
          ).map((input) => input.value);
          const attributeIds = Array.from(
              item.querySelectorAll(`input[name="variant_attributes[${index}][attribute_id]"]`)
          ).map((input) => input.value);
          const valueIds = Array.from(
              item.querySelectorAll(`input[name="variant_attributes[${index}][value_id]"]`)
          ).map((input) => input.value);
  
          // Lấy giá trị từ các trường input dựa trên ID
          const sku = document.getElementById(`sku-${index}`).value;
          const priceRegular = document.getElementById(`price_regular-${index}`).value;
          const priceSale = document.getElementById(`price_sale-${index}`).value;
          const stock = document.getElementById(`stock-${index}`).value;
  
          // Lấy file ảnh từ input
          const fileInput = document.getElementById(`image-${index}`);
          const file = fileInput.files[0]; // File ảnh được chọn
  
          const variantPromise = new Promise((resolve) => {
              if (file) {
                  const reader = new FileReader();
  
                  reader.onloadend = function () {
                      // Thêm dữ liệu biến thể vào productData
                      productData.variantsData.push({
                          attributes: attributes,
                          attribute_ids: attributeIds,
                          value_ids: valueIds,
                          sku: sku,
                          price_regular: priceRegular,
                          price_sale: priceSale,
                          stock: stock,
                          image: reader.result, // Lưu đường dẫn URL của ảnh
                      });
                      resolve(); // Giải quyết promise khi đã đọc xong file
                  };
  
                  reader.readAsDataURL(file); // Đọc file ảnh và chuyển đổi thành đường dẫn URL
              } else {
                  // Nếu không có ảnh, đẩy dữ liệu không có ảnh vào productData
                  productData.variantsData.push({
                      attributes: attributes,
                      attribute_ids: attributeIds,
                      value_ids: valueIds,
                      sku: sku,
                      price_regular: priceRegular,
                      price_sale: priceSale,
                      stock: stock,
                      image: null, // Không có ảnh
                  });
                  resolve(); // Giải quyết promise ngay cả khi không có file
              }
          });
  
          promises.push(variantPromise); // Thêm promise vào mảng
      });
  
      // Chờ tất cả promises hoàn thành trước khi cập nhật form
      Promise.all(promises).then(() => {
          updateFormInputs();
          console.log("Biến thể đã được lưu tạm:", productData.variantsData);
          alert("Biến thể đã được lưu tạm thời.");
      });
  });
  
  function updateFormInputs() {
      const variantContainer = document.getElementById("variant-list");
      // Xóa tất cả input cũ
      const existingInputs = variantContainer.querySelectorAll('input[name^="product_data"]');
      existingInputs.forEach(input => input.remove());
  
      // Tạo input mới cho mỗi biến thể
      productData.variantsData.forEach((variant, i) => {
          // Tạo các input cho thuộc tính của biến thể
          for (const key in variant) {
              const input = document.createElement("input");
              input.type = "hidden";
              input.name = `product_data[${i}][${key}]`; // Tạo tên dạng mảng
              // Nếu là mảng, chuyển sang JSON, nếu không thì giữ nguyên giá trị
              input.value = Array.isArray(variant[key]) ? JSON.stringify(variant[key]) : variant[key];
              variantContainer.appendChild(input);
          }
      });
  }
  
  
  
  
  
    
  
  
    // Hiển thị popup khi nhấn nút "Thêm giá"
    document.getElementById("apply-price-to-all").addEventListener("click", function () {
      // Tạo một popup đơn giản bằng cách sử dụng Bootstrap Modal hoặc tạo popup custom
      const popupHtml = `
        <div id="pricePopup" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Nhập giá cho các biến thể</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="input-price-for-all">Giá: </label>
                  <input type="number" id="input-price-regular" class="form-control" placeholder="Nhập giá sản phẩm">
                </div>
                <div class="form-group">
                  <label for="input-price-sale">Giá khuyến mãi: </label>
                  <input type="number" id="input-price-sale" class="form-control" placeholder="Nhập giá khuyến mãi">
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
        document.querySelectorAll(`input[id^="price_regular"]`).forEach(input => {
          input.value = priceRegular;
        });
        document.querySelectorAll(`input[id^="price_sale"]`).forEach(input => {
          input.value = priceSale;
        });
  
        // Ẩn và xóa popup sau khi lưu
        $('#pricePopup').modal('hide');
        document.getElementById("pricePopup").remove();
      });
    });
  });
  
  
  
  
  
  