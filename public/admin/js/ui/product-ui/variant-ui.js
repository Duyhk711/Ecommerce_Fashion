// Hàm tạo HTML biến thể
export function generateVariantHtml(variant, index) {
    const collapseId = `collapse-${index}`;
    const variantNumber = index + 1;
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
  
    return `
        <div class="row justify-content-between align-items-center variant-item" style="border: 1px solid rgba(128, 128, 128, 0.318); padding: 10px 0" data-bs-toggle="collapse" data-bs-target="#${collapseId}" aria-expanded="false" aria-controls="${collapseId}">
            <div class="col-8 d-flex">
                <div class="variant-number me-2"><strong>#${variantNumber}</strong></div>
                ${variantInputs}
            </div>
            <div class="col-4 text-end">
                <a href="#" class="text-danger remove-variant">Xoá</a>
            </div>
        </div>
        <div class="collapse mt-3" id="${collapseId}">
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-4">
                        <input type="file" name="image[${index}]" accept="image/*">
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Mã sản phẩm (SKU)</label>
                            <input type="text" class="form-control" name="sku[${index}]">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Giá (₫)</label>
                            <input type="text" class="form-control" name="price_regular[${index}]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Giá ưu đãi (₫)</label>
                            <input type="text" class="form-control" name="price_sale[${index}]">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Số lượng trong kho</label>
                            <input type="number" class="form-control" name="stock[${index}]" value="0" step="any">
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
  }
  