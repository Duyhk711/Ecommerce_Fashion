// resources/js/app.js

import './bootstrap';

window.Echo.channel('orders')
    .listen('OrderUpdated', (event) => {
        console.log(event);

        // Update the order status in the DOM
        const orderStatusElement = document.getElementById(`orderStatus-${event.order.id}`);
        if (orderStatusElement) {
            const currentStatus = event.order.status;
            orderStatusElement.innerHTML = `${event.order.statusMapping[currentStatus] ?? currentStatus}`;
            orderStatusElement.className = `badge rounded-pill ${event.order.badgeColor[currentStatus]}`;
        }

        const paymentStatusElement = document.getElementById(`paymentStatus-${event.order.id}`);
        if (paymentStatusElement) {
            const currentPaymentStatus = event.order.payment_status;
            paymentStatusElement.innerHTML = `${event.order.statusPaymentMapping[currentPaymentStatus] ?? currentPaymentStatus}`;
            paymentStatusElement.className = `badge rounded-pill ${event.order.badgeColorPayment[currentPaymentStatus]}`;
        }
  
        // Display real-time toastr notification using the success message from the event
        toastr.success(event.success, 'Thành công', {
            positionClass: 'toast-top-right',
            timeOut: 3000
        });
    });
