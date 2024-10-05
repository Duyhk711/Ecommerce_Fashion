// Gửi sản phẩm lên server
export function saveProduct(formData) {
    return fetch("/admin/products/add", {
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": csrfToken,
      },
      body: formData,
    }).then((response) => response.json());
  }
  