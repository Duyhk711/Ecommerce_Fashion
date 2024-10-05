// Hàm thêm card thuộc tính vào DOM
export function addAttributeCard(selectedAttribute, attributeName) {
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
                                        (value) =>
                                          `<option value="${value.id}" data-value-name="${value.value}">${value.value}</option>`
                                      )
                                      .join('')}
                                </select>
                                <div class="mt-2">
                                    <button class="btn btn-secondary btn-sm select_all_attributes">Chọn tất cả</button>
                                    <button class="btn btn-secondary btn-sm select_no_attributes">Không chọn</button>
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
  
  // Cập nhật trạng thái của nút lưu thuộc tính
  export function updateSaveButtonState() {
    const saveButton = document.getElementById("save-attributes");
    let hasSelectedValues = false;
  
    document.querySelectorAll("#attributes-container .card").forEach((card) => {
      const selectedValues = $(card).find(".attributes-select").val();
      if (selectedValues && selectedValues.length > 0) {
        hasSelectedValues = true;
      }
    });
  
    saveButton.disabled = !hasSelectedValues;
  }
  