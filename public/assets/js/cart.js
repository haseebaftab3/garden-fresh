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
                    "Unable to load cart items. Please try again."
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

        // Clear the table body before rendering
        cartTableBody.innerHTML = "";

        cartItems.forEach((item) => {
            const variants = item.variants
                .map(
                    (variant) =>
                        `<li style="list-style: circle; margin: 0;">Variant: ${variant.type} - <span class="text-primary">${variant.value}</span></li>`
                )
                .join("");

            const cartRow = `
                    <tr class="cart-item" data-cart-id="${item.id}">
                        <td class="product-remove">
                            <button class="close-btn remove-wishlist"><i class="fal fa-times"></i></button>
                        </td>
                        <td class="product-thumbnail">
                            <a href="/product/${item.slug}">
                                <img src="/storage/${
                                    item.product_image
                                }" alt="${item.product_name}">
                            </a>
                        </td>
                        <td class="product-title">
                            <a href="/product/${item.slug}">${
                item.product_name
            }</a>
                            <ul class="variant-details">${variants}</ul>
                        </td>
                        <td class="product-price" data-title="Price">
                            <span class="currency-symbol"></span>${formatCurrency(
                                item.price_per_item
                            )}
                        </td>
                        <td class="product-quantity" data-title="Qty">
                            <div class="pro-qty item-quantity" data-cart-id="${
                                item.id
                            }">
                                <span class="dec qtybtn">-</span>
                                <input type="number" class="quantity-input" value="${
                                    item.quantity
                                }">
                                <span class="inc qtybtn">+</span>
                            </div>
                        </td>
                        <td class="product-subtotal" data-title="Subtotal">
                            <span class="currency-symbol"></span>${formatCurrency(
                                item.price_per_item * item.quantity
                            )}
                        </td>
                    </tr>
                `;

            cartTableBody.insertAdjacentHTML("beforeend", cartRow);
        });

        // Update subtotal
        cartSubtotalElement.textContent = `${formatCurrency(subtotal)}`;

        toggleLoader("cartPageContentLoader", "cartPageContent", false);
        attachQuantityHandlers();
    }

    function renderCartItems(cartItems, subtotal) {
        const cartItemList = document.getElementById("cart-item-list");
        const cartLoader = document.getElementById("cart-loader");

        // Clear the cart item list before rendering
        cartItemList.innerHTML = "";

        cartItems.forEach((item) => {
            const variants = `
                <ul class="variant-details">
                    ${item.variants
                        .map((variant) => {
                            return `<li style="list-style: circle" class="m-0">Variant: ${variant.type} - <span class="text-primary">${variant.value}</span></li>`;
                        })
                        .join("")}
                </ul>
            `;

            const cartItem = `
                <li class="cart-item" data-cart-id="${item.id}">
                    <div class="item-img">
                        <a href="/product/${item.slug}">
                            <img src="/storage/${item.product_image}" alt="${
                item.product_name
            }">
                        </a>
                        <button class="close-btn"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="item-content">
                        <h3 class="item-title">
                            <a href="single-product.html">${
                                item.product_name
                            }</a>
                        </h3>
                        ${variants}
                        <div class="item-price">
                            <span class="currency-symbol"></span>
                            ${formatCurrency(item.price_per_item)}
                        </div>
                        <div class="pro-qty item-quantity" data-cart-id="${
                            item.id
                        }">
                            <span class="dec qtybtn">-</span>
                            <input type="number" class="quantity-input" value="${
                                item.quantity
                            }">
                            <span class="inc qtybtn">+</span>
                        </div>
                    </div>
                </li>`;
            cartItemList.insertAdjacentHTML("beforeend", cartItem);
        });

        // Update subtotal
        updateSubtotal(subtotal);

        // Hide loader and show item list
        cartLoader.style.display = "none";
        cartItemList.style.display = "block";

        // Attach event listeners for quantity buttons and inputs
        attachQuantityHandlers();
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
                    updateSubtotal(response.subtotal);
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
            <div id="${alertId}" class="alert alert-${type} alert-dismissible fade show" role="alert">
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
