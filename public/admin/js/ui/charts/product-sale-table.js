document.addEventListener("DOMContentLoaded", function () {
  const storageUrl = document.querySelector('meta[name="storage-url"]').getAttribute("content");
  fetch("/api/sales-statistics?filter=today")
    .then((response) => response.json())
    .then((data) => {
      const tableProductSale = document.getElementById(
        "products-sale-statistics"
      );
      const productSale = data;
      console.log("product sale: ", productSale);
      tableProductSale.innerHTML = "";

      productSale.forEach((product) => {
        console.log(product);
        const priceToDisplay =
          product.price_sale === null ||
          product.price_sale === 0 ||
          product.price_sale === product.price_regular
            ? formatPriceVND(product.price_regular)
            : formatPriceVND(product.price_sale);
        const row = document.createElement("tr");
        row.innerHTML = `
                    <td>
                      <div class="d-flex">
                          <div class=" bg-light rounded p-1 me-2">
                              <img src="${storageUrl}${product.img_thumbnail}" alt="" class="" style="width: 60px" />
                          </div>
                          <div class="">
                              <h5 class="fs-sm mt-2"><a href="#" class="text-reset ">${product.name}</a></h5>
                          </div>
                      </div>
                  </td>
                  <td>
                      <h5 class="fs-sm my-1 fw-normal">${priceToDisplay}</h5>
                  </td>
                  <td>
                      <h5 class="fs-sm my-1 fw-normal">${product.total_quantity_sold}</h5>
                  </td>
                  <td>
                      <h5 class="fs-sm my-1 fw-normal">${formatPriceVND(product.total_revenue)}</h5>
                  </td>
                `;
        tableProductSale.appendChild(row);
      });
      function formatPriceVND(price) {
        return new Intl.NumberFormat("vi-VN", {
          style: "currency",
          currency: "VND",
        }).format(price * 1000);
      }
    });
});
