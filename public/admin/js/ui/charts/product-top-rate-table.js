document.addEventListener("DOMContentLoaded", function () {
  const storageUrl = document.querySelector('meta[name="storage-url"]').getAttribute("content");
  fetch("/api/products/top-rated?filter=last_7_days")
    .then((response) => response.json())
    .then((data) => {
      const tableProductTopRate = document.getElementById("products-top-rate");
      const productTopRate = data.data;
      console.log("product rate: ", productTopRate);
      tableProductTopRate.innerHTML = "";

      productTopRate.forEach((product) => {
        console.log(product);
        const row = document.createElement("tr");
        row.innerHTML = `
                    <td style="width: 250px; word-wrap: break-word;">
                      <div class="d-flex" >
                          <div class=" bg-light rounded p-1 me-2">
                              <img src="${storageUrl}${product.img_thumbnail}" alt="" class="" style="width: 60px" />
                          </div>
                          <div>
                              <h5 class="fs-sm mt-2" >
                                  <a href="#" class="text-reset">${product.name}</a>
                              </h5>
                          </div>
                      </div>
                  </td>
                  <td class="text-center">
                      <p class="mb-0">${product.total_comments}</p>
                  </td>
                  <td class="text-center">
                      <p class="mb-0">${Number(product.average_rating).toFixed(1)}<i class=" mx-1 mb-1 fa-solid fa-star text-warning"></i></p>
                  </td>
                `;
            tableProductTopRate.appendChild(row);
      });
      function formatPriceVND(price) {
        return new Intl.NumberFormat("vi-VN", {
          style: "currency",
          currency: "VND",
        }).format(price * 1000);
      }
    });
});
