import { saveProduct } from '../api/product-api';

// Xử lý gửi form sản phẩm
export function handleSaveProduct(variantsData) {
  const name = document.getElementById("name").value;
  const sku = document.getElementById("sku").value;
  const priceRegular = document.getElementById("price_regular").value;
  const priceSale = document.getElementById("price_sale").value;
  const description = document.getElementById("description").value;
  const catalogue = document.getElementById("catalogue-select").value;
  const content = window.editorInstance ? window.editorInstance.getData() : "";
  const isActive = document.querySelector('input[name="is_active"]').checked;
  const isNew = document.querySelector('input[name="is_new"]').checked;
  const isHotDeal = document.querySelector('input[name="is_hot_deal"]').checked;
  const isShowHome = document.querySelector('input[name="is_show_home"]').checked;
  const mainImage = document.getElementById("main_image").files[0];
  const galleryImages = document.getElementById("gallery_images").files;

  const productData = {
    name, sku, price_regular: priceRegular, price_sale: priceSale, description, content, catalogue,
    is_active: isActive, is_new: isNew, is_hot_deal: isHotDeal, is_show_home: isShowHome,
    variants: variantsData.map((variant) => ({ ...variant, image: null }))
  };

  const formData = new FormData();
  formData.append("productData", JSON.stringify(productData));

  if (mainImage) formData.append("main_image", mainImage);
  Array.from(galleryImages).forEach((file) => formData.append("gallery_images[]", file));

  saveProduct(formData)
    .then(data => alert("Sản phẩm đã được thêm thành công!"))
    .catch(error => alert("Có lỗi xảy ra khi thêm sản phẩm."));
}
