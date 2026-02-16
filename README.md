# Product Title Embed for GHL Forms

This JavaScript script automatically fetches the product title from WooCommerce product pages or product grids and injects it into a **GoHighLevel (GHL) form** product title field.

It supports single product pages, loop/grid product listings, and dynamically loaded Elementor popups.

---

## Features

- Works on **single product pages**.
- Detects product titles in **WooCommerce grids** or **Elementor product cards**.
- Injects the product title into the GHL form automatically.
- Updates the **parent page URL** with the product title query parameter.
- Supports **iframe-based GHL forms** and dynamically reloads the iframe for the title.

---

## Installation

1. Download the script or copy the code from `product-title-embed.js`.
2. Include it in your website:

```html
<script src="product-title-embed.js"></script>

Update the following variables if needed:

var PARAM_KEY = 'product_title'; // Query parameter key
var FORM_ID   = 'YOUR_GHL_FORM_ID'; // Replace with your GHL form ID

How It Works

Detects product clicks in a loop/grid or the current product page.

Retrieves the product title from the page or clicked card.

Adds the product title as a query parameter to the parent page URL.

Finds the GHL form iframe and reloads it so the title is populated automatically.

Clears the cached title after 1.5 seconds to avoid conflicts.