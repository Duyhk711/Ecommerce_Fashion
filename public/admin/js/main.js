import { fetchAttributes, fetchAttributeValues } from './Api/attribute-api';
import { addAttributeCard } from './ui/product-ui/attribute-ui';
import { generateVariantHtml } from './ui/product-ui/variant-ui';
import { handleSaveProduct } from './ui/product-ui/form-ui';

let selectedAttributes = [];
let variantsData = [];

document.addEventListener("DOMContentLoaded", function () {
  fetchAttributes()
    .then((data) => {
      const selectElement = document.getElementById("val-select2");
      data.forEach((attribute) => {
        const option = document.createElement("option");
        option.value = attribute.id;
        option.textContent = attribute.name;
        selectElement.appendChild(option);
      });
    })
    .catch((error) => console.error("Không thể lấy dữ liệu thuộc tính từ server:", error));

  document.getElementById("val-select2").addEventListener("change", function () {
    const attributeId = this.value;
    const attributeName = this.options[this.selectedIndex].text;
    if (!attributeId) return;

    fetchAttributeValues(attributeId)
      .then((selectedAttribute) => {
        addAttributeCard(selectedAttribute, attributeName);

        const optionToRemove = this.querySelector(`option[value="${attributeId}"]`);
        if (optionToRemove) optionToRemove.remove();
        this.value = "";
      })
      .catch((error) => console.error("Không thể lấy giá trị thuộc tính:", error));
  });

  document.getElementById("save-product").addEventListener("click", () => handleSaveProduct(variantsData));
});
