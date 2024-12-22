document.addEventListener("DOMContentLoaded", function () {
    function toggleLoader(loaderId, contentId, showLoader) {
        const loader = document.getElementById(loaderId);
        const content = document.getElementById(contentId);

        if (loader && content) {
            if (showLoader) {
                loader.style.display = "block"; // Show loader
                content.style.display = "none"; // Hide content
            } else {
                loader.style.display = "none"; // Hide loader
                content.style.display = "block"; // Show content
            }
        }
    }

    window.fetchCartItems = function () {
        toggleLoader("cart-loader", "cart-item-list", true);
        fetch("/get-cart-items", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    renderCartItems(data.cartItems, data.subtotal);
                    if (window.location.pathname === "/cart") {
                        renderCartPage(data.cartItems, data.subtotal);
                    }
                    renderOrderSummary(data.cartItems, data.subtotal);

                    updateCartCount(data.cartItems.length);
                } else {
                    showAlert("warning", "Failed to fetch cart items.");
                }
            })
            .catch((error) => {
                showAlert(
                    "danger",
                    "Unable to load cart items. Please try again." + error
                );
            })
            .finally(() => {
                toggleLoader("cart-loader", "cart-item-list", false);
            });
    };

    function renderCartPage(cartItems, subtotal) {
        toggleLoader("cartPageContentLoader", "cartPageContent", true);
        const cartTableBody = document.querySelector(
            "table.axil-cart-table tbody"
        );
        const cartLoader = document.getElementById("cart-loader");
        const cartSubtotalElement = document.getElementById(
            "cart-page-cart-subtotal"
        );
        const cartSubtotalElement1 = document.getElementById(
            "cart-page-cart-subtotal1"
        );

        // Clear the table body before rendering
        cartTableBody.innerHTML = "";

        cartItems.forEach((item) => {
            const variants = item.variants
                .map(
                    (variant) =>
                        `<li style="list-style: circle; margin: 0;">Variant: ${variant.type} - <span class="text-primary">${variant.value} KG</span></li>`
                )
                .join("");

            const cartRow = `
                <tr class="cart-item tf-cart-item file-delete" data-cart-id="${
                    item.id
                }">

                    <td class="tf-cart-item_product">
                        <a href="/product/${item.slug}" class="img-box">
                            <img src="/storage/${item.product_image}" alt="${
                item.product_name
            }">
                        </a>
                        <div class="cart-info">
                            <a href="/product/${
                                item.slug
                            }" class="cart-title link">${item.product_name}</a>
                            <ul class="variant-details">${variants}</ul>
                        </div>
                    </td>
                    <td class="tf-cart-item_price text-center" data-cart-title="Price">
                        <div class="cart-price text-button price-on-sale">
                            ${formatCurrency(item.price_per_item)}
                        </div>
                    </td>

                    <td class="tf-cart-item_quantity product-quantity" data-cart-title="Quantity">
                            <div class="wg-quantity mx-md-auto pro-qty item-quantity"   data-cart-id="${
                                item.id
                            }">
                                <span class="btn-quantity btn-decrease dec qtybtn">-</span>
                                <input type="number" class="quantity-input quantity-product" value="${
                                    item.quantity
                                }" min="1" >
                                <span class="btn-quantity btn-increase inc qtybtn">+</span>
                            </div>
                        </td>


                        <td class="tf-cart-item_total text-center" data-title="Subtotal" data-cart-title="Total">
                            <div class="cart-total text-button total-price">${formatCurrency(
                                item.price_per_item * item.quantity
                            )}</div>
                        </td> <td data-cart-title="Remove" class="remove-cart product-remove">
                        <span class="close-btn remove-wishlist remove icon icon-close"></span>
                    </td>
                    </tr>
                `;

            cartTableBody.insertAdjacentHTML("beforeend", cartRow);
        });

        // Update subtotal
        cartSubtotalElement.textContent = `${formatCurrency(subtotal)}`;
        cartSubtotalElement1.textContent = `${formatCurrency(subtotal)}`;

        toggleLoader("cartPageContentLoader", "cartPageContent", false);
        attachQuantityHandlers();
    }

    function renderCartItems(cartItems, subtotal) {
        const cartItemList = document.getElementById("cart-item-list");
        const cartLoader = document.getElementById("cart-loader");

        // Clear the cart item list before rendering
        cartItemList.innerHTML = "";

        cartItems.forEach((item) => {
            const variants = item.variants
                .map((variant) => `${variant.type}/${variant.value}`)
                .join(", ");

            const cartItem = `
                <div class="tf-mini-cart-item cart-item file-delete" data-cart-id="${
                    item.id
                }">
                    <div class="tf-mini-cart-image">
                        <img class="lazyload"
                            data-src="/storage/${item.product_image}"
                            src="/storage/${item.product_image}"
                            alt="${item.product_name}" />
                    </div>
                    <div class="tf-mini-cart-info flex-grow-1">
                        <div class="mb_12 d-flex align-items-center justify-content-between flex-wrap gap-12">
                            <div class="text-title">
                                <a href="/product/${
                                    item.slug
                                }" class="link text-line-clamp-1">
                                    ${item.product_name}
                                </a>
                            </div>
                            <div class="text-button close-btn tf-btn-remove remove">
                                Remove
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-12">
                            <div class="text-secondary-2">${variants}</div>
                            <div class="text-button">
                                ${item.quantity} X ${formatCurrency(
                item.price_per_item
            )}
                            </div>
                        </div>
                    </div>
                </div>`;
            cartItemList.insertAdjacentHTML("beforeend", cartItem);
        });

        // Update subtotal
        updateSubtotal(subtotal);

        // Hide loader and show item list
        cartLoader.style.display = "none";
        cartItemList.style.display = "block";

        // Attach event listeners for quantity buttons and inputs
        // attachQuantityHandlers();
    }

    function attachQuantityHandlers() {
        document.querySelectorAll(".qtybtn").forEach((btn) => {
            btn.addEventListener("click", function () {
                const $quantityInput =
                    this.closest(".item-quantity").querySelector(
                        ".quantity-input"
                    );
                const cartId =
                    this.closest(".item-quantity").getAttribute("data-cart-id");
                const previousQuantity =
                    parseInt(
                        $quantityInput.getAttribute("data-previous-value")
                    ) || parseInt($quantityInput.value);
                let currentQuantity = parseInt($quantityInput.value);

                if (this.classList.contains("inc")) {
                    currentQuantity++;
                } else if (
                    this.classList.contains("dec") &&
                    currentQuantity > 1
                ) {
                    currentQuantity--;
                } else {
                    currentQuantity = 1;
                }

                $quantityInput.value = currentQuantity;
                updateCartQuantity(cartId, currentQuantity, previousQuantity);

                // Update the data attribute with the new value
                $quantityInput.setAttribute(
                    "data-previous-value",
                    currentQuantity
                );
            });
        });

        document.querySelectorAll(".quantity-input").forEach((input) => {
            input.addEventListener("focus", function () {
                // Save the previous value on focus
                this.setAttribute("data-previous-value", this.value);
            });

            input.addEventListener("change", function () {
                const cartId =
                    this.closest(".item-quantity").getAttribute("data-cart-id");
                const previousQuantity =
                    parseInt(this.getAttribute("data-previous-value")) ||
                    parseInt(this.value);
                const newQuantity = parseInt(this.value);

                if (newQuantity > 0) {
                    updateCartQuantity(cartId, newQuantity, previousQuantity);
                } else {
                    alert("Quantity must be at least 1.");
                    this.value = 1; // Reset to minimum
                }

                // Update the data attribute with the new value
                this.setAttribute("data-previous-value", this.value);
            });
        });
    }

    function renderOrderSummary(cartItems, subtotal) {
        // Check if required DOM elements exist
        const $orderTableBody = $("#summery-table-body");
        const $totalElement = $("#order-total-amount");
        if (
            $(".axil-order-summery").length == 0 ||
            $(".order-checkout-summery").length == 0
        ) {
            console.log("Required DOM elements are missing.");
            return;
        }

        toggleLoader("loader", "summery-table", true);

        // Clear the order summary table before rendering
        $orderTableBody.empty();

        cartItems.forEach((item) => {
            const productRow = `
                <tr class="order-product">
                    <td>
                        ${item.product_name}
                        <span class="quantity">x${item.quantity}</span>
                        <ul class="variant-details">
                            ${item.variants
                                .map(
                                    (variant) =>
                                        `<li style="list-style: circle" class="m-0">${variant.type}: <span class="text-primary">${variant.value}</span></li>`
                                )
                                .join("")}
                        </ul>
                    </td>
                    <td>${formatCurrency(item.total_price)}</td>
                </tr>
            `;
            $orderTableBody.append(productRow);
        });

        // Add subtotal row
        const subtotalRow = `
            <tr class="order-subtotal">
                <td>Subtotal</td>
                <td>${formatCurrency(subtotal)}</td>
            </tr>
        `;
        $orderTableBody.append(subtotalRow);

        toggleLoader("loader", "summery-table", false);

        // Update the total
        const totalPrice = subtotal + 50; // Example adding fixed shipping cost
        $totalElement.text(formatCurrency(totalPrice));
    }

    window.updateCartQuantity = function (
        cartId,
        newQuantity,
        previousQuantity
    ) {
        toggleLoader("cart-loader", "cart-item-list", true);
        toggleLoader("cartPageContentLoader", "cartPageContent", true);
        sendAjaxRequest("/update-cart-quantity", "POST", {
            cart_id: cartId,
            quantity: newQuantity,
        })
            .then((data) => {
                if (data.success) {
                    console.log("Quantity updated successfully.");
                    showAlert("success", "Cart quantity updated successfully!");
                    fetchCartItems(); // Refresh the cart UI
                } else {
                    showAlert(
                        "danger",
                        data.details ||
                            "Failed to update cart quantity. Please try again."
                    );
                    revertQuantity(cartId, previousQuantity); // Revert to previous quantity
                }
            })
            .catch((error) => {
                // console.error("Error updating quantity:", error);
                showAlert(
                    "danger",
                    "An error occurred while updating the cart. Please try again."
                );
                revertQuantity(cartId, previousQuantity); // Revert to previous quantity
            })
            .finally(() => {
                toggleLoader("cart-loader", "cart-item-list", false);
                toggleLoader("cartPageContentLoader", "cartPageContent", false);
            });
    };

    function revertQuantity(cartId, previousQuantity) {
        const inputField = document.querySelector(
            `.item-quantity[data-cart-id="${cartId}"] .quantity-input`
        );
        if (inputField) {
            inputField.value = 1; // Revert to the previous value
        }
    }

    function deleteCartItem(cartId) {
        toggleLoader("cart-loader", "cart-item-list", true);
        $.ajax({
            url: "/delete-cart-item",
            type: "POST",
            data: {
                cart_id: cartId,
                _token: $('meta[name="csrf-token"]').attr("content"), // CSRF token for security
            },
            success: function (response) {
                if (response.success) {
                    showAlert(
                        "success",
                        "Item removed from cart successfully!"
                    );
                    $(`[data-cart-id="${cartId}"]`).remove();

                    updateCartCount(response.cartCount);
                    fetchCartItems();
                } else {
                    showAlert(
                        "danger",
                        "Failed to remove item from cart. Please try again."
                    );
                }
            },
            error: function (xhr, status, error) {
                console.error("Error deleting cart item:", error);
                showAlert(
                    "danger",
                    "An error occurred while removing the item from the cart."
                );
            },
            complete: function () {
                toggleLoader("cart-loader", "cart-item-list", false); // Hide loader after deleting
            },
        });
    }

    window.updateSubtotal = function (subtotal) {
        const cartSubtotal = document.getElementById("cart-subtotal");
        cartSubtotal.textContent = formatCurrency(subtotal);
    };

    $(document).on("click", ".close-btn", function () {
        const cartId = $(this).closest(".cart-item").data("cart-id");
        if (cartId) {
            deleteCartItem(cartId);
        }
    });

    function sendAjaxRequest(url, method, body = {}) {
        return fetch(url, {
            method: method,
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify(body),
        }).then((response) => response.json());
    }

    function showAlert(type, message) {
        const cartBody = document.querySelector(".cart-body");

        // Check if an alert already exists and remove it
        const existingAlert = cartBody.querySelector(".alert");
        if (existingAlert) {
            existingAlert.remove();
        }

        const alertId = `alert-${Date.now()}`;

        // Create the alert HTML
        const alertHtml = `
            <div id="${alertId}" class="mx-4 alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

        // Insert the alert at the top of the cart body
        cartBody.insertAdjacentHTML("afterbegin", alertHtml);

        // Auto-dismiss the alert after 5 seconds
        setTimeout(() => {
            const alertElement = document.getElementById(alertId);
            if (alertElement) {
                alertElement.classList.remove("show");
                alertElement.addEventListener("transitionend", () =>
                    alertElement.remove()
                );
            }
        }, 5000);
    }

    window.updateCartCount = function (itemCount) {
        const cartCountElement = document.querySelector(".cart-count");
        if (cartCountElement) {
            cartCountElement.textContent = itemCount;
        }
    };
    fetchCartItems();
});

window.formatCurrency = function (amount) {
    return new Intl.NumberFormat("en-PK", {
        style: "currency",
        currency: "PKR",
        minimumFractionDigits: 2,
    })
        .format(amount)
        .replace("₨", "Rs.");
};

// function toggleLoader(className, show) {
//     const loader = document.querySelector(`.${className}`);
//     if (!loader) {
//         console.log(`Loader with class "${className}" not found.`);
//         return;
//     }

//     loader.style.display = show ? "block" : "none";
// }
