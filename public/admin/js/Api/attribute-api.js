// Lấy danh sách thuộc tính từ server
export function fetchAttributes() {
    return fetch("/admin/get-attributes", {
      method: "GET",
    }).then((response) => response.json());
  }
  
  // Lấy danh sách giá trị của thuộc tính được chọn
  export function fetchAttributeValues(attributeId) {
    return fetch(`/admin/get-attribute-values/${attributeId}`, {
      method: "GET",
    }).then((response) => response.json());
  }
  