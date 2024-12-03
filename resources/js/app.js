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

        // const paymentStatusElement = document.getElementById(`paymentStatus-${event.order.id}`);
        // if (paymentStatusElement) {
        //     const currentPaymentStatus = event.order.payment_status;
        //     paymentStatusElement.innerHTML = `${event.order.statusPaymentMapping[currentPaymentStatus] ?? currentPaymentStatus}`;
        //     paymentStatusElement.className = `badge rounded-pill ${event.order.badgeColorPayment[currentPaymentStatus]}`;
        // }
        const updatedOrderId = event.order.id;
        const updatedStatus = event.order.status;
        if (!['1'].includes(updatedStatus)) {
            const cancelButton = document.querySelector(`#cancelOrderForm-${updatedOrderId}`);
            if (cancelButton) {
                cancelButton.closest('.cancel-item').style.display = 'none';
            }
        }
        // Display real-time toastr notification using the success message from the event
        toastr.success(event.success, 'Thành công', {
            positionClass: 'toast-top-right',
            timeOut: 3000
        });
    });
